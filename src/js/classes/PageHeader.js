class PageHeader {
    constructor(element, options) {
        this.element = element;
        this.options = __.lang.extend(true, PageHeader.DEFAULTS, this.element.dataset, typeof options == 'object' && options);

        this.initEvents();

        this.updateMargin()
    }

    initEvents() {
        window.addEventListener('resize', () => this.updateMargin());
    }

    updateMargin() {
        this.element.style.marginTop = (__.size.height(document.querySelector('header')) + 40) + 'px';
    }
    
}

PageHeader.DEFAULTS = {
    minMargin: 40
};

export default PageHeader;