class Header {
    constructor(element, options) {
        this.element = element;
        this.options = __.lang.extend(true, Header.DEFAULTS, this.element.dataset, typeof options == 'object' && options);

        // desktop
        this.currentDropdown = null;
        this.headerDesktop = this.element.querySelector('.header-desktop');
        this.dropdowns = this.element.querySelectorAll('.nav-item.with-submenu');

        // mobile
        this.headerMobile = this.element.querySelector('.header-mobile');
        this.hamburger = this.element.querySelector('#hamburger');
        this.mobileNavItems = this.element.querySelectorAll('.mobile-nav-item a');
        this.activeSubMenuLink = null;

        this.alertElement = document.querySelector('.alert');
        this.mainElement = document.querySelector('.main');
        this.pageHeader = document.querySelector('.page-header');

        this.initAlertListeners();
        
        this.initEvents();
    }

    initEvents() {
        // desktop
        this.element.addEventListener('mouseleave', (e) => {
            this.closeDesktopSubmenu(e);
        });
    
        for (const dropdown of this.dropdowns) {   
            dropdown.addEventListener('mouseover', (e) => this.openDesktopSubmenu(e));
            dropdown.addEventListener('mouseleave', (e) => {
                dropdown.classList.remove('open');
                dropdown.querySelector('.nav-link').blur();
            });
        }

        // mobile
        this.hamburger.addEventListener('click', () => this.toggleMobileMenu());

        this.mobileNavItems.forEach((element) => {
            __.event.on(element, 'click', () => this.toggleMobileMenu());
        });

        const submenuItems = this.element.querySelectorAll('.mobile-nav-item.with-submenu');
        for (let i = 0; i < submenuItems.length; i++) {
            __.event.on(submenuItems[i], 'click', (e) => this.showMobileSubmenu(e));
        }
    }

    openDesktopSubmenu(e) {
        const target = e.target.closest('.with-submenu');
        this.headerDesktop.classList.add('open');
        
        if (target) {
            if (this.currentDropdown && this.currentDropdown !== target) {
                this.currentDropdown.classList.remove('open');
            }

            this.dropdowns.forEach((elem) => {
                elem.blur();
            });

            target.classList.add('open');
            this.currentDropdown = target;
        }
    }

    closeDesktopSubmenu(e) {
        this.headerDesktop.classList.remove('open');
    
        if (!this.element.contains(e.relatedTarget)) {
            for (const dropdown of this.dropdowns) {
                dropdown.classList.remove('open');
            }
        }
    
        this.currentDropdown = null;
    }
    
    toggleMobileMenu() {
        this.hamburger.classList.toggle('menu-open');
        this.hamburger.classList.toggle('menu-close');
        this.headerMobile.classList.toggle('open');
        
        document.body.classList.toggle('mobile-menu-open');
        document.documentElement.classList.toggle('mobile-menu-open');

        if (this.activeSubMenuLink) {
            this.activeSubMenuLink.classList.remove('active');
            this.activeSubMenuLink = null;
        }
    }

    showMobileSubmenu(event) {
        const link = event.delegateTarget;
        const toggleIcon = link.querySelector('.toggle-icon');
        const isActive = link.classList.contains('active');
        const submenu = link.querySelector('.mobile-submenu');
    
        if (isActive) {
            link.classList.remove('active');
            link.querySelector('.nav-link').blur();
            toggleIcon.classList.toggle('icon-keyboard_arrow_up');
            toggleIcon.classList.toggle('icon-keyboard_arrow_down');
            if (submenu) submenu.classList.remove('open');
            this.activeSubMenuLink = null;
            return;
        }
    
        if (this.activeSubMenuLink && this.activeSubMenuLink !== link) {
            this.activeSubMenuLink.classList.remove('active');
            const previousSubmenu = this.activeSubMenuLink.querySelector('.mobile-submenu');
            if (previousSubmenu) previousSubmenu.classList.remove('open');
        }
    
        link.classList.toggle('active');
        if (submenu) submenu.classList.toggle('open');
    
        const allToggleIcons = this.element.querySelectorAll('.toggle-icon');
        for (const icon of allToggleIcons) {
            if (icon !== toggleIcon) {
                icon.classList.remove('icon-keyboard_arrow_up');
                icon.classList.add('icon-keyboard_arrow_down');
            }
        }
        toggleIcon.classList.toggle('icon-keyboard_arrow_up');
        toggleIcon.classList.toggle('icon-keyboard_arrow_down');
    
        this.activeSubMenuLink = link;
    }

    //alert detection and margin adjustements
    initAlertListeners() {
        if (!this.alertElement) return;

        this.adjustMainMargin();

        window.addEventListener('resize', () => {
            this.adjustMainMargin();
        });

        this.alertElement.addEventListener('closed.bs.alert', this.onAlertClosed.bind(this));
    }

    adjustMainMargin() {
        if (!this.alertElement || !this.mainElement) return;

        const alertHeight = this.alertElement.offsetHeight;
        this.mainElement.style.transform = `translateY(${alertHeight}px)`;

        let nextElement = this.mainElement.nextElementSibling;

        while (nextElement) {
            if (nextElement.tagName == "footer") {
                nextElement.style.transform = "translateY(50px)";
                break;
            } else {
                nextElement.style.transform = "translateY(50px)";
            }
            nextElement = nextElement.nextElementSibling;
        }

            if (window.scrollY == 0) {
                window.scrollTo(0, 0);
            }
        }

    onAlertClosed() {
        if (!this.mainElement) return;

        const mainMarginTop = parseInt(window.getComputedStyle(this.mainElement).marginTop) || 0;

        this.mainElement.style.transform = "translateY(0)";

        let nextElement = this.mainElement.nextElementSibling;

        while (nextElement) {
            nextElement.style.transform = "none";
            if (nextElement.tagName.toLowerCase() === "footer") {
                break;
            }
            nextElement = nextElement.nextElementSibling;
        }

        if (window.scrollY == 0) {
            window.scrollTo(0, 0);

        }

        if(this.pageHeader) {
            const pageHeaderMarginTop = parseInt(window.getComputedStyle(this.pageHeader).marginTop) || 0;
            const newHeaderMarginTop = pageHeaderMarginTop - mainMarginTop;
            this.pageHeader.style.marginTop = newHeaderMarginTop + 'px';
        }
    }
}

Header.DEFAULTS = {};

export default Header;