let body = document.querySelector('body');

let ajaxTag = document.querySelector('meta[name="ajaxurl"]');
let ajaxurl = ajaxTag ? ajaxTag.getAttribute('content') : '/wp-admin/admin-ajax.php';

// events
AOS.init();

// Scroll Spy
new HHA.ScrollSpy();

// header
let header = document.querySelector('.header');
if (header) {
	new HHA.Header(header);
}

// header scroll
$(document).ready(function() {
    var $window = $(window);
    var $header = $('.header');
    var lastScrollTop = 0;
    var classTrigger = 100;

    $window.scroll(function(event){
        var scrollTop = $window.scrollTop();

		if (scrollTop > lastScrollTop && scrollTop > classTrigger) {
			$header.removeClass('show');
		} else {
			$header.addClass('show');
			if (scrollTop < classTrigger) {
				$header.removeClass('scrolled');
			}
		}
        lastScrollTop = scrollTop;
    });

    $header.bind('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function() {
        if ($window.scrollTop() > classTrigger) {
            $header.addClass('scrolled');
        } else {
            $header.removeClass('scrolled');
        }
    });
});

// Page Header
let pageHeader = document.querySelector('.page-header');
if (pageHeader) {
	new HHA.PageHeader(pageHeader);
}

// Blog Archive
let blogBlock = document.querySelector('.blog-listing-block');
if (blogBlock) {
	let blogArchive = new HHA.BlogArchive(blogBlock);
	blogArchive.init();
}

// Client Stories Archive
let clientStoriesBlock = document.querySelector('.client-stories-listing-block');
if (clientStoriesBlock) {
	let clientStoriesArchive = new HHA.ClientStoriesArchive(clientStoriesBlock);
	clientStoriesArchive.init();
}

// Events Archive
let eventsBlock = document.querySelector('.events-listing-block');
if (eventsBlock) {
	let eventsArchive = new HHA.EventsArchive(eventsBlock);
	eventsArchive.init();
}

// Lever search
let leverSearch = document.querySelector('.lever-search');
if (leverSearch) {
   new HHA.LeverSearch(leverSearch);    

}

// Memberships Archive
let membershipsBlock = document.querySelector('.memberships-listing-block');
if (membershipsBlock) {
	let membershipsArchive = new HHA.MembershipsArchive(membershipsBlock);
	membershipsArchive.init();
}

// News Archive
let newsBlock = document.querySelector('.news-listing-block');
if (newsBlock) {
	let newsArchive = new HHA.NewsArchive(newsBlock);
	newsArchive.init();
}

// Partners Archive
let partnersBlock = document.querySelector('.partners-listing-block');
if (partnersBlock) {
	let partnersArchive = new HHA.PartnersArchive(partnersBlock);
	partnersArchive.init();
}

// Press Releases Archive
let pressReleasesBlock = document.querySelector('.press-releases-listing-block');
if (pressReleasesBlock) {
	let pressReleasesArchive = new HHA.PressReleasesArchive(pressReleasesBlock);
	pressReleasesArchive.init();
}

// Resources Archive
let resourcesBlock = document.querySelector('.resources-listing-block');
if (resourcesBlock) {
	let resourcesArchive = new HHA.ResourcesArchive(resourcesBlock);
	resourcesArchive.init();
}

// State Info Center Archive
let stateInfoCenterBlock = document.querySelector('.state-info-center-listing-block');
if (stateInfoCenterBlock) {
	let stateInfoCenterArchive = new HHA.StateInfoCenterArchive(stateInfoCenterBlock);
	stateInfoCenterArchive.init();
}

// slick slider wrapper
let slickSliders = document.querySelectorAll('.slick-slider-wrapper');
if (slickSliders.length > 0) {
	for (let i = 0; i < slickSliders.length; i++) {
        if (!__.dom.closest(slickSliders[i], '.tab-pane')) {
            new HHA.SlickSlider(slickSliders[i]);
        } else if (__.dom.closest(slickSliders[i], '.tab-pane.active')) {
            new HHA.SlickSlider(slickSliders[i]);
        }
    }
}

// tabs
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('[data-bs-toggle="pill"]');

    tabs.forEach(tab => {
        tab.addEventListener('shown.bs.tab', function (event) {
            const targetTab = document.querySelector(event.target.dataset.bsTarget);

            // slick slider wrapper
            let slickSliders = targetTab.querySelectorAll('.slick-slider-wrapper');
            if (slickSliders.length > 0) {
                for (let i = 0; i < slickSliders.length; i++) {
                    if (!__.dom.findOne('.slick.slick-initialized', slickSliders[i])) {
                        new HHA.SlickSlider(slickSliders[i]);
                    }
                }
            }
        });
    });

    const alertEl = document.querySelector('.my-custom-alert');
    if (alertEl) {
        const closeBtn = alertEl.querySelector('.btn-close');
        
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                document.cookie = "<?php echo $cookieName;?>=true; path=/; max-age=" + (60 * 60 * 24);
            });
        }
    }

});

// copy share link
function copyURI(button, url) {
    var dummy = document.createElement('input');
    document.body.appendChild(dummy);
    dummy.value = url;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
}

//scroll to tab-pane
let tabsSidebar = document.querySelectorAll('.tabs-sidebar');
if (tabsSidebar.length > 0) {
  
  document.addEventListener('shown.bs.tab', function (event) {
    let clickedTab = event.target;
    
    let targetId = clickedTab.getAttribute('data-bs-target');
    console.log(targetId);
    
    if (targetId) {
      let scrollTarget = document.querySelector(targetId);
      if (scrollTarget) {
        scrollTarget.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    }
  });
}

