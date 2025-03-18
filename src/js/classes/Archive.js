class Archive {
	constructor(element) {
		this.element = element;
	}

	init() {
		if (__.lang.isEmpty(this.options.preRequests)) {
			this.start();
			return;
		}

		const requests = this.buildRequests(this.options.preRequests);
        Promise.all(requests)
			.then((responses) => {
              	this.start(...responses);
            })
            .catch((error) => console.trace(error));
	}

	buildRequests(requestArray) {
        let requests = [];

        requestArray.forEach((requestObject) => {
            requests.push(
                fetch(requestObject.endpoint + '?' + new URLSearchParams(requestObject.params), this.fetchOptions()).then(this.responseHandler)
            );
        });

        return requests;
    }

	fetchOptions() {
		return {
			method: "GET",
			mode: "cors",
			cache: "no-cache",
			credentials: "same-origin",
			headers: {
			  "Content-Type": "application/json",
			},
			redirect: "follow",
			referrerPolicy: "no-referrer"
		};
	}

	responseHandler(response) {
        if (!response.ok) {
            return Promise.reject(new Error(response.statusText) );
        }
      
        return response.text().then(text => {
            const data = text && JSON.parse(text);
            return data;
        });
    }

	setMessage(message) {
        if (!this.message) {
            console.error('Message element not set!!');
        }

		let html = __.template.supplant(this.options.templates.message, {
			message: message
		});

		this.message.innerHTML = html;
	}

	getUrlParams() {
		let urlParams = new URLSearchParams(window.location.search);

		const result = {};
		for(const [key, value] of urlParams.entries()) {
			result[key] = value;
		}
		return result;
	}

	updateUrlParams(updateParams) {
		const url = new URL(window.location);

		let params = __.lang.extend(this.options.properties, this.getUrlParams(), updateParams);
		for (const key in params) {
			url.searchParams.set(key, params[key]);
		}

		history.pushState({}, '', url);
	}

	matchHeight() {
        let list = $("[data-mh]").map(function(){return $(this).attr("data-mh");}).get();
 
        let set = new Set(list);
 
        set.forEach(element => {
            $('[data-mh="' + element + '"]').matchHeight()
        });
	}

}

Archive.DEFAULTS = {
	properties: {},
	preRequests: [],
	templates: {
		message: `
			<h2 class="text-center my-4">{{message}}</h2>
		`
	}
};

export default Archive;