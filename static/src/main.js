// core version + scrollbar module:
import Swiper, { Scrollbar } from 'swiper';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/scrollbar';

import './main.css';

"use strict";

const body = document.querySelector( 'body' );

// Mobile nav
const mobileNavBtn = document.querySelector( '[data-mobile-nav-btn]' );
const mobileNav = document.querySelector( '[data-mobile-nav]' );
const navItemHasChildren = document.querySelectorAll( '[data-has-children' );
const mobileLogoAndNav = document.querySelector('[data-mobile-logo-nav]');

mobileNavBtn.addEventListener( 'click', () => {
    mobileNavBtn.style.transform = mobileNavBtn.style.transform === 'rotate(-45deg)' ? '' : 'rotate(-45deg)';
    mobileNav.classList.toggle( 'hidden' );
    mobileNav.style.position = mobileNav.style.position === 'fixed' ? '' : 'fixed';
    body.style.overflow = body.style.overflow === 'hidden' ? '' : 'hidden';
    mobileLogoAndNav.classList.toggle( 'bg-background' );
});

navItemHasChildren.forEach( parentNav =>
    parentNav.addEventListener( 'click', () => {
        parentNav.nextElementSibling.classList.toggle( 'hidden' );
        parentNav.querySelector('svg').style.transform = parentNav.querySelector('svg').style.transform === 'rotate(90deg)' ? '' : 'rotate(90deg)';
    })
);

// Show nav on scroll up
const scrollUp = 'scrolling-up';
const scrollDown = 'scrolling-down';
let lastScroll = 0;

window.addEventListener( 'scroll', () => {
  const currentScroll = window.pageYOffset;
  if (currentScroll <= 0) {
    body.classList.remove(scrollUp);
    return;
  }

  if (currentScroll > lastScroll && !body.classList.contains(scrollDown)) {
    // down
    body.classList.remove(scrollUp);
    body.classList.add(scrollDown);
  } else if (
    currentScroll < lastScroll &&
    body.classList.contains(scrollDown)
  ) {
    // up
    body.classList.remove(scrollDown);
    body.classList.add(scrollUp);
  }
  lastScroll = currentScroll;
}, { passive: true } );

// Video blocks
const videoContainer = document.querySelectorAll('[data-video-id]');

if ( videoContainer.length ) {
    videoContainer.forEach(function (video) {
        const playPauseBtn = video.querySelector('[data-playpause]');
        const playBtn = video.querySelector('[data-playbutton]');
        const player = video.querySelector('iframe').contentWindow;
        const videoId = video.getAttribute('data-video-id');
        const contentIframe = video.querySelector('[data-content-iframe]');
        const videoLoop = video.querySelector('[data-video-loop]');

        playPauseBtn.addEventListener('click', () => {
            if ( playPauseBtn.ariaPressed === 'false' ) {
                playPauseBtn.textContent = 'Resume background video';
                player.postMessage('{"method":"pause"}', '*');
                playPauseBtn.ariaPressed = 'true';
            } else if ( playPauseBtn.ariaPressed === 'true' ) {
                playPauseBtn.textContent = 'Stop background video';
                player.postMessage('{"method":"play"}', '*');
                playPauseBtn.ariaPressed = 'false';
            }
        });

        playBtn.addEventListener('click', () => {
            playPauseBtn.remove();
            playBtn.remove();
            // Let's find a more secure alternative at some point
            contentIframe.innerHTML = `<iframe src="https://player.vimeo.com/video/${videoId}?color=ffd700&title=0&byline=0&portrait=0&autoplay=1" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay" fullscreen picture-in-picture allowfullscreen data-ready="true"></iframe>`;
            videoLoop.remove();
        });
    });
}

// Services Carousel
const swiper = new Swiper( ".services-swiper", {
  modules: [Scrollbar],
  slidesPerView: 1,
  spaceBetween: 40,
  breakpoints: {
    // when window width is >= 640px
    640: {
      slidesPerView: 1.5,
      spaceBetween: 30
    }
  },
  a11y: {
    enabled: true
  },
  scrollbar: {
    el: ".swiper-scrollbar",
    hide: false,
    draggable: true
  },
});

// HubSpot

window.addEventListener('message', event => {
  if(event.data.type === 'hsFormCallback' && event.data.eventName === 'onFormReady') {
    const hsSubmitBtns = document.querySelectorAll('.hs_submit input[type="submit"]');

    hsSubmitBtns.forEach( btn => {
      const svg = document.createElement("i");
      svg.classList.add('fak');
      svg.classList.add('fa-compass-arrow');
      svg.classList.add('hs-button');
      svg.style.fontSize = '1.75rem';
      svg.style.alignSelf = 'center';
      btn.parentNode.insertBefore( svg, btn.nextSibling );
    } );
  }
});

