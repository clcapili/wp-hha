import Archive from "./Archive";

class ResourcesArchive extends Archive {
	constructor(element, options) {
		super(element);
		this.options = __.lang.extend(true, Archive.DEFAULTS, ResourcesArchive.DEFAULTS, typeof options == 'object' && options);
	}

	start(audiences, types, topics) {
		// sets template
		this.element.innerHTML = __.template.supplant(this.options.templates.body, {});

		// sets global varibles
		this.results = __.dom.findOne('.resources-archive-list', this.element);
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
			this.showMoreFilters(audiences, types, topics)

			// toggle button
			let toggleSpan = this.toggleFilters.querySelector('span');
    		toggleSpan.textContent = toggleSpan.textContent === 'Show filters' ? 'Hide Filters' : 'Show filters';

			// audiences
			this.audiencesSelect = __.dom.find('[data-filter-option="audience"]', this.element);
			this.audiencesSelect.forEach((element) => {
				__.event.on(element, 'change', (event) => this.switchAudience(event));
			});

			// types
			this.typesSelect = __.dom.find('[data-filter-option="type"]', this.element);
			this.typesSelect.forEach((element) => {
				__.event.on(element, 'click', (event) => this.switchType(event));
			});

			// topics
			this.topicsSelect = __.dom.find('[data-filter-option="topic"]', this.element);
			this.topicsSelect.forEach((element) => {
				__.event.on(element, 'click', (event) => this.switchTopic(event));
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
		let audience = urlParams.audience;
		let type = urlParams.type;
		let topic = urlParams.topic;
		let search = urlParams.search;

		let queryParams = {
			'action': 'get_resources_items',
			'page': page,
			'per_page': perPage
		};

		if (audience && audience != '') {
			queryParams['audience'] = audience;
		}

		if (type && type != '') {
			queryParams['type'] = type;
		}

		if (topic && topic != '') {
			queryParams['topic'] = topic;
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
							type: item.type,
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

	switchAudience(event) {
		let slug = event.target.value;

		this.results.innerHTML = '';

		this.updateUrlParams({
			page: 1,
			audience: slug
		});
		
		this.loadData();
	}

	switchType(event) {
		let slug = event.target.value;

		this.results.innerHTML = '';

		this.updateUrlParams({
			page: 1,
			type: slug
		});
		
		this.loadData();
	}

	switchTopic(event) {
		let slug = event.target.value;
		let isChecked = event.target.checked;
	
		this.results.innerHTML = '';

		let selectedTopicsBefore = this.getSelectedTopics();
		isChecked ? [...selectedTopicsBefore, slug] : this.removeTopic(slug);
	
		let topicParam = (selectedTopicsBefore.length > 0) ? selectedTopicsBefore : '';

		this.updateUrlParams({
			page: 1,
			topic: topicParam
		});
	
		this.loadData();
	}

	getSelectedTopics() {
		return Array.from(this.topicsSelect)
			.filter(element => element.checked)
			.map(element => element.value);
	}
	
	removeTopic(id) {
		let selectedTopics = this.getSelectedTopics();
		let updatedTopic = selectedTopics.filter(value => value !== id);
	
		return (updatedTopic.length > 0) ? updatedTopic : '';
	}

	showMoreFilters(audiences, types, topics) {
		let urlParams = this.getUrlParams();

		__.dom.toggle(this.moreFilters);

		let html = __.template.supplant(this.options.templates.filters, {
			audiences: audiences,
			audienceName: urlParams.audience,
			types: types,
			typeName: urlParams.type,
			topics: topics,
			topicName: urlParams.topic
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

ResourcesArchive.DEFAULTS = {
	properties: {
		page : 1,
		audience: '',
		type: '',
		topic: '',
		search : '',
		per_page: 9
	},
	preRequests: [
		{
			endpoint: '/wp-json/wp/v2/audiences',
			params: {}
		},
		{
			endpoint: '/wp-json/wp/v2/resource-types',
			params: {}
		},
		{
			endpoint: '/wp-json/wp/v2/topics',
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
						<input type="text" class="form-control" name="search-resources" placeholder="Search resources" aria-label="Search resources" data-filter-option="search" title="Search resources">
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

					<div class="row resources-archive-list"></div>

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
						{{if (type)}}
							<p class="card-pretitle">{{& type}}</p>
						{{endif}}

						<h3 class="card-title">{{& title}}</h3>
					</div>
				</a>
			</div>
		`,
		filters: `
			<p class="text-black fw-bold">FILTER BY</p>

			<div class="row">
				{{if (audiences)}}
					<div class="col-sm-6 col-md-4 col-lg-12">
						<p class="text-dark-green fw-bold">Audience</p>

						<div class="inner-options">
							<div class="form-check">
								<div class="form-check">
									<input 
										class="form-check-input" 
										type="radio" 
										id="audience-all" 
										data-filter-option="audience"
										value="" 
										name="audiences-filter"
										checked
									>

									<label class="form-check-label" for="audience-all">
										All Audiences
									</label>
								</div>
								
								{{for (let i = 0; i < audiences.length; i++)}}
									<div class="form-check">
										<input 
											class="form-check-input" 
											type="radio" 
											id="audience-{{& audiences[i].slug}}" 
											data-filter-option="audience"
											value="{{audiences[i].slug}}" 
											name="audiences-filter" 
											{{if (audienceName == audiences[i].slug)}} checked{{endif}}
										>

										<label class="form-check-label" for="audience-{{& audiences[i].slug}}">
											{{& audiences[i].name}}
										</label>
									</div>
								{{endfor}}
							</div>
						</div>
					</div>
				{{endif}}

				{{if (types)}}
					<div class="col-sm-6 col-md-4 col-lg-12">
						<p class="text-dark-green fw-bold">Type</p>

						<div class="inner-options">
							<div class="form-check">
								<div class="form-check">
									<input 
										class="form-check-input" 
										type="radio" 
										id="type-all" 
										data-filter-option="type" 
										value="" 
										name="types-filter"
										checked
									>

									<label class="form-check-label" for="type-all">
										All Types
									</label>
								</div>
								
								{{for (let i = 0; i < types.length; i++)}}
									<div class="form-check">
										<input 
											class="form-check-input" 
											type="radio" 
											id="type-{{& types[i].slug}}" 
											data-filter-option="type"
											value="{{& types[i].slug}}" 
											name="types-filter" 
											{{if (typeName == types[i].slug)}} checked{{endif}}
										>

										<label class="form-check-label" for="type-{{& types[i].slug}}">
											{{& types[i].name}}
										</label>
									</div>
								{{endfor}}
							</div>
						</div>
					</div>
				{{endif}}

				{{if (topics)}}
					<div class="col-sm-6 col-md-4 col-lg-12">
						<p class="text-dark-green fw-bold">Topics</p>

						<div class="inner-options">
							<div class="form-check">
								{{for (let i = 0; i < topics.length; i++)}}
									<div class="form-check">
										<input 
											class="form-check-input" 
											type="checkbox" 
											id="topic-{{& topics[i].slug}}" 
											data-filter-option="topic"
											value="{{topics[i].slug}}" 
											name="topics-filter" 
											{{if (topicName == topics[i].slug)}} checked{{endif}}
										>

										<label class="form-check-label" for="topic-{{& topics[i].slug}}">
											{{& topics[i].name}}
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
			<nav aria-label="Resources Pagination">
				<ul class="pagination mb-0">
					<li class="page-item page-prev {{if (page == 1)}}disabled{{endif}}">
						<a data-page="{{1}}" class="page-link link-icon" href="javascript:void(0)">
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

					<li class="page-item page-next {{if (page == totalPages)}}disabled{{endif}}">
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

export default ResourcesArchive;