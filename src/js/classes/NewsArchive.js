import Archive from "./Archive";

class NewsArchive extends Archive {
	constructor(element, options) {
		super(element);
		this.options = __.lang.extend(true, Archive.DEFAULTS, NewsArchive.DEFAULTS, typeof options == 'object' && options);
	}

	start() {
		// sets template
		this.element.innerHTML = __.template.supplant(this.options.templates.body, {});

		// sets global varibles
		this.results = __.dom.findOne('.news-archive-list', this.element);
		this.message = __.dom.findOne('.message', this.element);
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

		// sets default url params
		this.updateUrlParams({});
	
		this.loadData();
	}

	loadData() {
		const urlParams = this.getUrlParams();
		let perPage = parseInt(urlParams.per_page);
		let page = parseInt(urlParams.page);

		let queryParams = {
			'page': page,
			'_embed': true,
			'per_page': perPage
		};

		__.dom.show(this.archiveLoader);

		fetch(this.options.endpoint + '?' + new URLSearchParams(queryParams))
			.then(async (response) => {
				__.dom.hide(this.archiveLoader);
		
				const totalPages = parseInt(response.headers.get('X-WP-TotalPages') || '1');
				
				if (!response.ok) {
					throw new Error(`HTTP error! status: ${response.status}`);
				}
				
				return {
					data: await response.json(),
					totalPages
				};
			})
			.then(({data, totalPages}) => {
				console.log(data);
				// no results message and pagination display
				this.setMessage('');
				__.dom.show(this.pagination);

				if (data.length == 0 && page == 1) {
					this.setMessage('No results found');
					__.dom.hide(this.pagination);
					return;
				}

				// get and display data
				let html = '';
				if (data) {
					for (let i = 0; i < data.length; i++) {
						let item = data[i];

						html += __.template.supplant(this.options.templates.post, {
							image: item.featured_media != 0 ? item['_embedded']['wp:featuredmedia'][0].source_url : null,
							alt: item.featured_media != 0 ? item['_embedded']['wp:featuredmedia'][0].alt_text : '',
							title: item.title.rendered,
							link: item.acf.in_the_news_link.url || item.link,
							target: item.acf.in_the_news_link.target || '_self'
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
				console.error('Error loading data:', error);
				this.setMessage('An error occurred while loading data.');
				__.dom.hide(this.archiveLoader);

				if (error.message.includes('rest_post_invalid_page_number')) {
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

NewsArchive.DEFAULTS = {
	endpoint: '/wp-json/wp/v2/news/',
	properties: {
		page : 1,
		per_page: 9
	},
	preRequests: [],
	templates: {
		body: `
			<div class="archive-loader" style="display: none;">
				<img src="/wp-content/themes/hha/img/loading.gif" alt="Loading archive spinner..." />
			</div>

			<div class="row news-archive-list"></div>

			<div class="message"></div>

			<div class="pagination-wrapper"></div>
		`,
		post: `
			<div class="col-md-6 col-lg-4">
				<a href="{{link}}" target="{{target}}" class="card card-flush mb-3">
					{{if (image)}}
						<img src="{{image}}" class="img-fluid" alt="{{alt}}" />
					{{endif}}

					<div class="card-body">
						<h3 class="card-title">{{& title}}</h3>
					</div>
				</a>
			</div>
		`,
		paging: `
			<nav aria-label="News Pagination">
				<ul class="pagination">
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

export default NewsArchive;