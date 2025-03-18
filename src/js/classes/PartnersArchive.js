import Archive from "./Archive";

class PartnersArchive extends Archive {
	constructor(element, options) {
		super(element);
		this.options = __.lang.extend(true, Archive.DEFAULTS, PartnersArchive.DEFAULTS, typeof options == 'object' && options);
	}

	start(tags) {
		// sets template
		this.element.innerHTML = __.template.supplant(this.options.templates.body, {});

		// sets global varibles
		this.results = __.dom.findOne('.partners-archive-list', this.element);
		this.message = __.dom.findOne('.message', this.element);

		this.toggleFilters = __.dom.findOne('.toggle-filters', this.element);
		this.moreFilters = __.dom.findOne('.more-filters', this.element);

		this.searchInput = __.dom.findOne('[data-filter-option="search"]', this.element);
		this.pagination = __.dom.findOne('.pagination-wrapper', this.element);

		// archive loader
		this.archiveLoader = __.dom.findOne('.archive-loader');

		// search
		const urlParams = new URLSearchParams(window.location.search);
		const searchQuery = urlParams.get('search');
		if (searchQuery) {
			this.searchInput.value = searchQuery;
		}

		// sets events
		__.event.on(this.toggleFilters, 'click', (event) => {
			this.showMoreFilters(tags)

			// toggle button
			let toggleSpan = this.toggleFilters.querySelector('span');
    		toggleSpan.textContent = toggleSpan.textContent === 'Show filters' ? 'Hide Filters' : 'Show filters';

			// tags
			this.tagsSelect = __.dom.find('[data-filter-option="tag"]', this.element);
			this.tagsSelect.forEach((element) => {
				__.event.on(element, 'click', (event) => this.switchTag(event));
			});

		});

		__.event.on(this.pagination, 'click', 'a', (event) => {
			this.nextPage(event.delegateTarget.dataset.page);

			// scroll
			this.element.scrollIntoView();
		});

		__.event.on(this.pagination, 'click', 'button', (event) => {
			this.showAll();

			// scroll
			this.element.scrollIntoView();
		});

		this.searchInput.addEventListener('keyup', (event) => {
			if (event.keyCode === 13) {
				event.preventDefault();
				this.search();
			}
		});

		// sets default url params
		this.updateUrlParams({});
	
		this.loadData();
	}

	loadData() {
		const urlParams = this.getUrlParams();
		let page = parseInt(urlParams.page);
		let perPage = parseInt(urlParams.per_page);
		let tag = urlParams.tag;
		let search = urlParams.search;

		let queryParams = {
			'action': 'get_partners',
			'page': page,
			'per_page': perPage
		};

		if (tag && tag != -1) {
			queryParams['tag'] = tag;
		}

		if (search && search != '') {
			queryParams['search'] = search;
		}

		__.dom.show(this.archiveLoader);

		fetch(ajaxurl + '?' + new URLSearchParams(queryParams))
			.then(response => response.json())
			.then(response => {
				__.dom.hide(this.archiveLoader);

				let totalPages = response.numPages;

				// no results message and pagination display
				this.setMessage('');
				__.dom.show(this.pagination);

				if (response.items.length == 0 && page == 1) {
					this.setMessage('No results found');
					__.dom.hide(this.pagination);
					return;
				}

				// get and display data
				let html = '';
				if (response.items) {
					for (let i = 0; i < response.items.length; i++) {
						let item = response.items[i];

						html += __.template.supplant(this.options.templates.post, {
							image: item.thumbnail,
							alt: item.alt,
							title: item.title,
							link: item.link
						});
					}
				}

				this.results.innerHTML = html;

				if (perPage === -1) {
					__.dom.hide(this.pagination);
				}

				this.updatePaging(page, totalPages);

				this.matchHeight();
			})
			.catch(error => {
				if (error.responseJSON.code == 'rest_post_invalid_page_number') {
					this.pagination.style.display = 'none';
				}
			});

	}

	nextPage(page) {
		this.updateUrlParams({
			page: parseInt(page),
		});

		this.loadData();
	}

	switchTag(event) {
		let slug = event.target.value;
		let isChecked = event.target.checked;
	
		this.results.innerHTML = '';

		let selectedTagsBefore = this.getSelectedTags();
		isChecked ? [...selectedTagsBefore, slug] : this.removeTag(slug);
	
		let tagParam = (selectedTagsBefore.length > 0) ? selectedTagsBefore : '';

		this.updateUrlParams({
			page: 1,
			tag: tagParam
		});
	
		this.loadData();
	}

	getSelectedTags() {
		return Array.from(this.tagsSelect)
			.filter(element => element.checked)
			.map(element => element.value);
	}
	
	removeTag(id) {
		let selectedTags = this.getSelectedTags();
		let updatedTag = selectedTags.filter(value => value !== id);
	
		return (updatedTag.length > 0) ? updatedTag : '';
	}

	showMoreFilters(tags) {
		let urlParams = this.getUrlParams();
		
		__.dom.toggle(this.moreFilters);

		let html = __.template.supplant(this.options.templates.filters, {
			tags: tags,
			tagName: urlParams.tag
		});

		this.moreFilters.innerHTML = html;
	}

	search() {
		this.updateUrlParams({
			page: 1,
			search: this.searchInput.value
		});

		this.results.innerHTML = '';

		this.loadData();
	}

	updatePaging(page, totalPages) {
		let html = __.template.supplant(this.options.templates.paging, {
			page: parseInt(page),
			totalPages: totalPages
		});

		this.pagination.innerHTML = html;
	}

	showAll() {
		this.updateUrlParams({
			per_page: -1,
		});

		this.loadData();
	}
}

PartnersArchive.DEFAULTS = {
	properties: {
		page : 1,
		tag: '',
		search : '',
		per_page: 9
	},
	preRequests: [
		{
			endpoint: '/wp-json/wp/v2/partner-tags',
			params: {
				per_page : 50
			}
		}
	],
	templates: {
		body: `
			<div class="row">
				<div class="col-lg-5">
					<div class="input-group">
						<input type="text" class="form-control" name="search-partners" placeholder="Search partners" aria-label="Search partners" data-filter-option="search" title="Search partners">
					</div>
				</div>
			</div>

			<div class="archive-filter archive-filter-resources">
				<button class="btn btn-primary toggle-filters">
					<i class="icon icon-filter"></i>
					<span>Show filters</span>
				</button>

				<div class="archive-filter-radios">
					
				</div>
			</div>

			<div class="row">
				<div class="col-lg-3 more-filters" style="display: none;"></div>
				<div class="col-lg">
					<div class="archive-loader" style="display: none;">
						<img src="/wp-content/themes/hha/img/loading.gif" alt="Loading archive spinner..." />
					</div>

					<div class="row partners-archive-list"></div>

					<div class="message"></div>
		
					<div class="pagination-wrapper"></div>
				</div>
			</div>
		`,
		post: `
			<div class="col-md-6 col-lg-4">
				<a href="{{link}}" target="_self" class="card card-flush mb-3">
					{{if (image)}}
						<img src="{{image}}" class="img-fluid" alt="{{alt}}" />
					{{endif}}

					<div class="card-body">
						<h3 class="card-title">{{& title}}</h3>
					</div>
				</a>
			</div>
		`,
		filters: `
			<p class="text-black fw-bold">FILTER BY</p>

			<div class="row">
				{{if (tags)}}
					<div class="col-sm-6 col-md-4 col-lg-12">
						<p class="text-dark-green fw-bold">Tags</p>

						<div class="inner-options">
							<div class="form-check">
								{{for (let i = 0; i < tags.length; i++)}}
									<div class="form-check">
										<input 
											class="form-check-input" 
											type="checkbox" 
											id="tag-{{& tags[i].slug}}" 
											data-filter-option="tag"
											value="{{tags[i].slug}}" 
											name="tags-filter" 
											{{if (tagName == tags[i].slug)}} checked{{endif}}
										>

										<label class="form-check-label" for="tag-{{& tags[i].slug}}">
											{{& tags[i].name}}
										</label>
									</div>
								{{endfor}}
							</div>
						</div>
					</div>
				{{endif}}
			</div>
		`,
		paging: `
			<nav aria-label="Partners Pagination">
				<ul class="pagination mb-0">
					<li class="page-item page-first {{if (page == 1)}}disabled{{endif}}">
						<a data-page="1" class="page-link link-icon" href="javascript:void(0)">
							<span class="text">First</span>
						</a>
					</li>
					
					{{for (let i = 1; i <= totalPages; i++)}}
						{{if (i == page)}}
							<li class="page-item page-numbers active" aria-current="page">
								<span class="page-link">{{i}}</span>
							</li>
						{{else}}
							{{if (i == 1)}}
								<li class="page-item">
									<a data-page="{{i}}" class="page-link" href="javascript:void(0)">{{i}}</a>
								</li>
							{{elseif (i == totalPages)}}
								<li class="page-item">
									<a data-page="{{i}}" class="page-link" href="javascript:void(0)">{{i}}</a>
								</li>
							{{elseif (i == page+1)}}
								<li class="page-item">
									<a data-page="{{i}}" class="page-link" href="javascript:void(0)">{{i}}</a>
								</li>
							{{elseif (i == page+2)}}
								<li class="page-item">
									<a data-page="{{i}}" class="page-link" href="javascript:void(0)">{{i}}</a>
								</li>
								
								{{if (page+3 != totalPages)}}
									<li class="page-item disabled">
										<div class="page-link">...</div>
									</li>
								{{endif}}
							{{elseif (i == page-1)}}
								<li class="page-item">
									<a data-page="{{i}}" class="page-link" href="javascript:void(0)">{{i}}</a>
								</li>
							{{elseif (i == page-2)}}
								{{if (page-3 != 1)}}
									<li class="page-item disabled">
										<div class="page-link">...</div>
									</li>
								{{endif}}

								<li class="page-item">
									<a data-page="{{i}}" class="page-link" href="javascript:void(0)">{{i}}</a>
								</li>
							{{endif}}
						{{endif}}
					{{endfor}}

					<li class="page-item page-last {{if (page == totalPages)}}disabled{{endif}}">
						<a data-page="{{totalPages}}" class="page-link link-icon" href="javascript:void(0)">
							<span class="text">Last</span>
						</a>
					</li>

					<button class="btn btn-outline-primary page-link link-icon">
						<span class="text">View all</span>
					</button>
				</ul>
			</nav>
		`,
	}
};

export default PartnersArchive;