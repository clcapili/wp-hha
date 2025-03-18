class ScrollSpy {
    constructor(options) {
        this.options = __.lang.extend(true, ScrollSpy.DEFAULTS, typeof options == 'object' && options);

        this.sections = document.querySelectorAll(".scroll-spy-target");
        this.menuLinks = document.querySelectorAll(".scroll-spy-item");
        this.currentActive = 0;

        this.initEvents();
    }

    initEvents() {
        window.addEventListener("scroll", () => this.onScroll());
    }

    onScroll() {
        const current = this.sections.length - [...this.sections].reverse().findIndex(section => window.scrollY >= section.offsetTop - 200 ) - 1
        if (current !== this.currentActive) {
            this.removeAllActive();
            this.currentActive = current;
            this.makeActive(current);
        }
    }

    makeActive(link) { 
        if (link >= 0 && link < this.menuLinks.length) {
            this.menuLinks[link].classList.add("active") 
        }
    }

    removeActive(link) { 
        if (link >= 0 && link < this.menuLinks.length) {
            this.menuLinks[link].classList.remove("active") 
        }
    }

    removeAllActive () { 
        [...Array(this.sections.length).keys()].forEach(link => this.removeActive(link)) 
    }

}

ScrollSpy.DEFAULTS = {
    offset: 200
};

export default ScrollSpy;