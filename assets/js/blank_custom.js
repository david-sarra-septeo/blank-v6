document.addEventListener('DOMContentLoaded', function () {

    // GALERIES
    const galleryLightbox = GLightbox({
        selector: '.image-link',
        // selector: '.wp-block-image :where(a[href$=".jpg"], a[href$=".jpeg"], a[href$=".webp"], a[href$=".png"])',
    });

    // VIDEO POPUP
    const videoLightbox = GLightbox({
        selector: '.video-link',
    });

    // //////////////////////
    // MAIN MENU
    // /////////////////////

    const showMenuLink = document.querySelector('.show-menu-link');
    // DISPLAY MAIN MENU
    if (showMenuLink) {
        showMenuLink.addEventListener('click', function (event) {
            document.getElementsByTagName('html')[0].classList.toggle('show-main-menu');
            event.preventDefault();
        });
    }

    // // ///////////////////    
    // // SCROLL PAGE INTERSECTION OBESERVER
    // // ///////////////////

    const header = document.querySelector('header.site-header');

    header.insertAdjacentHTML('afterend', '<div class="fake-height" style="position: absolute; z-index:-99;"></div>');
    const fakeHeight = document.querySelector('.fake-height');

    const obserHeader = function (entries, observer) {
        entries.forEach(entry => {
            const body = document.querySelector('body');
            if (!entry.isIntersecting) { 
                body.classList.add('fixed-header');
                // document.querySelector('.popup-container').classList.remove('popup-open');
            } else {
                body.classList.remove('fixed-header');
            }    
        })
    };

    const headerObserver = new IntersectionObserver(obserHeader, { threshold: 0 });
    headerObserver.observe(fakeHeight);

    // // ///////////////////    
    // // BOOKING SCROLL PAGE INTERSECTION OBESERVER
    // // ///////////////////

    const bookingTitle = document.querySelector('.booking-container');

    if (!bookingTitle) {
    
        // do nothing
    
    } else {
        
        bookingTitle.insertAdjacentHTML('afterbegin', '<div class="fake-booking-height" style="position: absolute; z-index:-99; top: -44px;"></div>');
        const fakeBookingHeight = document.querySelector('.fake-booking-height');

        const obserBookingHeader = function (entries, observer) {
            entries.forEach(entry => {
                const body = document.querySelector('body');
                if (!entry.isIntersecting) { 
                    body.classList.add('booking-fixed-header');
                } else {
                    body.classList.remove('booking-fixed-header');
                } 
            })
        };

        const headerBookingObserver = new IntersectionObserver(obserBookingHeader, { threshold: 0 });
        headerBookingObserver.observe(fakeBookingHeight);
    
    }

    // ///////////////////
    //  SCROLLING SECTIONS
    // ///////////////////
    // Use '.animation--init' or '.animation--init--once' for scrolling animations.

    if (!!window.IntersectionObserver) {
        
        const sections = document.querySelectorAll('[class*="animation--init"]');

        document.querySelector('body').classList.add('has-animations');
        const revealSection = function (entries, observer) {

            entries.forEach(entry => {
                entry.target.classList.remove('animation--end');
                    if (!entry.isIntersecting) return;
                entry.target.classList.add('animation--end');
                    if (entry.target.classList.contains('animation--init--once')) {
                        observer.unobserve(entry.target);
                }

            })

        }

        const sectionObserver = new IntersectionObserver(revealSection,
            {
                root: null,
                threshold: 0.3
            });

        sections.forEach(section => sectionObserver.observe(section));
    
    }

    // // ///////////////////
    // //  SCROLL TO TOP
    // // ///////////////////

    // const top = document.querySelector('#container');
    // const scrollUp = document.querySelector('.scrollup');
    // if (scrollUp) {
    //     scrollUp.addEventListener('click', function (e) {
    //         e.preventDefault();
    //         top.scrollIntoView({ behavior: 'smooth' })
    //     })

    // }

    // // ///////////////////
    // // AVIS LATERAL
    // // ///////////////////

    const showSidePost = document.querySelector('.show-popup');
    const sidePostOverlay = document.querySelector('.popup-overlay');
    
    if (showSidePost) {

        const tancaAvis = function(event) {
            document.querySelector('.popup-container').classList.toggle('popup-open');
            event.preventDefault();
        }

        showSidePost.addEventListener( 'click', tancaAvis );
        sidePostOverlay.addEventListener( 'click', tancaAvis);
    
    }

    // // ///////////////////
    // //  SCROLL TO ANCHOR
    // // /////////////////// 
        
    // function scrollToAnchor() {

    //     let links = document.querySelectorAll('a[href^="#"]:not(.custom-tab)');

    //     const headerHeight = document.querySelector('header').clientHeight;
        
        

    //     links.forEach(function(link) {

    //         link.addEventListener('click', function(e) {

    //             e.preventDefault();

    //             let targetId = this.getAttribute('href').slice(1);

    //             let targetElement = document.getElementById(targetId);

    //             targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });

    //             //console.log(headerHeight);


    //       });

    //     });

    // }

    // scrollToAnchor();

});