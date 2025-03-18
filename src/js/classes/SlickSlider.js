class SlickSlider {
    constructor(element, options) {
        this.element = element;
        this.options = __.lang.extend(true, SlickSlider.DEFAULTS, this.element.dataset, typeof options == 'object' && options);

        this.initEvents();
    }

    initEvents() {
        this.initSlick();
    }

    initSlick() {
        $(this.element).each(function() {
            const prev = this.querySelector('.slick-prev');
            const next = this.querySelector('.slick-next');
            const slick = $(this).find('.slick');
            const slickNav = this.querySelector('.slick-nav');
            const progressBar = this.querySelector('.progress-bar');
            const dataSlick = slick.data('slick');
            const dataAutoplay = slick.data('autoplay');
            const dataContinuous = slick.data('continuous');
            const dataSlickInfinite = slick.data('infinite');
            const options = {
                ...{
                    'slidesToScroll': 1,
                    'prevArrow': prev,
                    'nextArrow': next,
                    'appendDots': false,
                    'dots': true,
                    'pauseOnHover': false
                },
                ...dataSlick,
                ...dataAutoplay,
                ...dataContinuous,
                ...dataSlickInfinite,
                ...{
                    'responsive': [
                        {
                            'breakpoint': 992,
                            'settings': slick.data('slick-responsive-992')
                        },
                        {
                            'breakpoint': 768,
                            'settings': slick.data('slick-responsive-768')
                        },
                        {
                            'breakpoint': 576,
                            'settings': slick.data('slick-responsive-576')
                        }
                    ]
                },
            };

            slick.slick(options);

            const totalSlides = slick.find('.slick-slide').not('.slick-cloned').length;
            if (totalSlides <= 3 && slickNav) {
                slickNav.classList.add('d-lg-none');
            } else if (slickNav) {
                slickNav.classList.remove('d-lg-none');
            }

            const breakpointSettings = slick[0].slick.breakpointSettings;

            // progress bar
            const updateProgressBar = (event, slickInstance, currentSlide) => {
                let slidesToShow = slickInstance.options.slidesToShow;
                if (slickInstance.activeBreakpoint) {
                    slidesToShow = breakpointSettings[slickInstance.activeBreakpoint].slidesToShow;
                }

                const slideCount = slickInstance?.slideCount || slick.children('.slick-slide').not('.slick-cloned').length || 1;
                const currentIndex = typeof currentSlide !== 'undefined' ? currentSlide : slickInstance?.currentSlide || 0;

                let progressWidth = ((currentIndex + slidesToShow) / slideCount) * 100;

                if (progressBar) {
                    progressBar.setAttribute('aria-valuenow', currentIndex + 1);
                    progressBar.setAttribute('aria-valuemax', slideCount);
                    progressBar.style.width = `${progressWidth}%`;
                }
            };

            slick.on('init reInit afterChange', updateProgressBar);

            slick.trigger('init', [slick.slick('getSlick')]);
        });
    }
}

SlickSlider.DEFAULTS = {};

export default SlickSlider;