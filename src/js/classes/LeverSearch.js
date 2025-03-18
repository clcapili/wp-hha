class LeverSearch {
    constructor (element, options) {
        this.element = element;
        this.options = __.lang.extend(true, LeverSearch.DEFAULTS, this.element.dataset, typeof options == 'object' && options);
        this.data = {};

        this.init();
        this.initEvents();
        this.fetchJobs();
    }

    init() {
        __.dom.append(this.options.templates.scaffolding, this.element);
    }

    initEvents() {
        __.event.on(this.element, 'change', '.job-filter', (event) => this.filterJobs(event));
    }

    fetchJobs() {
        fetch('/wp-admin/admin-ajax.php?action=lever_data', {method: 'GET'})
        .then(this.responseHandler)
        .then((response) => this.handleResults(response));
    }

    handleResults(response) {
        this.data.jobs = [];
        let allCommitments = [];
        let allLocations = [];
        let allPositions = [];

        response.forEach((job) => {
            job.postings.forEach((posting) => {
                
                let location = posting.categories.location;
                let commitment = posting.categories.commitment;
                
                if (allLocations.indexOf(location) == -1 && location != undefined) {
                    allLocations.push(location);
                    __.dom.append('<option value="' + location + '">' + location + '</option>', __.dom.findOne('[name="location-filter"]'));
                }
                if (allCommitments.indexOf(commitment) == -1 && commitment != undefined){ 
                    allCommitments.push(commitment);
                    __.dom.append('<option value="' + commitment + '">' + commitment + '</option>', __.dom.findOne('[name="commitment-filter"]'));
                }
                
                /*
                if (allPositions.indexOf(posting.text) == -1) {
                    allPositions.push(posting.text);
                    __.dom.append('<option value="' + posting.text + '">' + posting.text + '</option>', __.dom.findOne('[name="position-filter"]'));
                }
                */

                this.data.jobs.push({
                    title: posting.text,
                    country: posting.country,
                    applyUrl: posting.applyUrl,
                    hostedUrl: posting.hostedUrl,
                    commitment: posting.categories.commitment,
                    location: posting.categories.location,
                    position: posting.text,
                    workplaceType: posting.workplaceType
                });
            });
        });

        this.displayJobs(this.data.jobs);
        this.matchHeight();
    }

    filterJobs(event) {
        let locationFilter = __.dom.findOne('.location-filter').value;
        let employmentFilter = __.dom.findOne('.employment-filter').value;
       // let positionFilter = __.dom.findOne('.position-filter').value;

        let filteredJobs = this.data.jobs.filter((job) => {
            if (locationFilter != -1 && !(job.location == locationFilter)) return false;
            if (employmentFilter != -1 && !(job.commitment == employmentFilter)) return false;
           // if (positionFilter != -1 && !(job.position == positionFilter)) return false;
            return true;
        });

        this.displayJobs(filteredJobs);
    }

    displayJobs(jobs) {
        let jobList = __.dom.findOne('.job-list', this.element);

        __.dom.empty(jobList);
        __.dom.append(__.template.supplant(this.options.templates.jobs, {
            jobs: jobs
        }), jobList);  
    }

    responseHandler(response) {
        if (!response.ok) {
            return Promise.reject(new Error(response.statusText) );
        }

        return response.text().then(text => {
            return text && JSON.parse(text);
        });
    }

    matchHeight() {
        let list = $("[data-mh]").map(function() {
            return $(this).attr("data-mh");
        }).get();
 
        let set = new Set(list);

        set.forEach(element => {
            $('[data-mh="' + element + '"]').matchHeight()
        });
	}
}

LeverSearch.DEFAULTS = {
    endpoint: '',
    account: '',
    key: '',
    country: '',
    templates: {
        scaffolding: `
            <div class="filters">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-6 mb-4">
                            <select class="job-filter location-filter form-select" name="location-filter">
                                <option value="-1">All Locations</option>
                            </select>
                        </div>

                        <div class="col-sm-6 mb-4">
                            <select class="job-filter employment-filter form-select" name="commitment-filter">
                                <option value="-1">All Employment Types</option>
                            </select>
                        </div>

                        <!--
                        <div class="col">
                            <select class="job-filter position-filter form-select" name="position-filter">
                                <option value="-1">All Positions</option>
                            </select>
                        </div>
                        -->
                    </div>
                </div>
            </div>

            <div class="job-list container"></div>
        `,
        jobs: `
            <div class="row">
                {{for (let i = 0; i < jobs.length; i++)}}
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <p class="card-text">{{jobs[i].location}}, {{jobs[i].commitment}} / {{jobs[i].workplaceType}}</p>
                                <h3 class="card-title" data-mh="career-title">{{jobs[i].title}}</h3>
                                <a href="{{jobs[i].hostedUrl}}" class="btn btn-link">Learn more</a>
                            </div>
                        </div>
                    </div>
                {{endfor}}
            </div>
        `
    }
}

export default LeverSearch;