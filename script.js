// Video Hero Slider - Seamless Loop
const heroVideos = document.querySelectorAll('.hero-video');
if (heroVideos.length > 0) {
    let currentIdx = 0;

    function transitionVideo() {
        const current = heroVideos[currentIdx];
        const nextIdx = (currentIdx + 1) % heroVideos.length;
        const next = heroVideos[nextIdx];

        next.play().then(() => {
            next.classList.add('active');
            setTimeout(() => {
                current.classList.remove('active');
                current.pause();
                current.currentTime = 0;
            }, 1500);
            currentIdx = nextIdx;
        }).catch(() => {
            currentIdx = nextIdx;
            transitionVideo();
        });
    }

    if(heroVideos[0]) {
      heroVideos[0].classList.add('active');
      heroVideos[0].play();
      heroVideos.forEach(video => {
          video.addEventListener('ended', transitionVideo);
      });
    }
}

// Core Values Auto-Slider
const valuesGrid = document.querySelector('.values-grid');
if (valuesGrid) {
    let isPaused = false;
    function autoScroll() {
        if (!isPaused) {
            valuesGrid.scrollLeft += 1;
            if (valuesGrid.scrollLeft >= (valuesGrid.scrollWidth - valuesGrid.clientWidth)) {
                valuesGrid.scrollLeft = 0;
            }
        }
        requestAnimationFrame(autoScroll);
    }
    valuesGrid.addEventListener('mouseenter', () => isPaused = true);
    valuesGrid.addEventListener('mouseleave', () => isPaused = false);
    autoScroll();
}

// Mobile Menu Toggle
const menuToggle = document.getElementById('mobile-menu');
const navLinks = document.querySelector('.nav-links');

if (menuToggle && navLinks) {
  menuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('active');
  });
}

// Smooth Scrolling
document.querySelectorAll('nav a').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    e.preventDefault();
    const targetId = this.getAttribute('href').substring(1);
    const targetElement = document.getElementById(targetId);
    if (targetElement) {
      // Close mobile menu if open
      if (navLinks.classList.contains('active')) {
        navLinks.classList.remove('active');
      }
      
      window.scrollTo({
        top: targetElement.offsetTop - 60,
        behavior: 'smooth'
      });
    }
  });
});

// PWA Service Worker Registration (Disabled for local static preview)
/*
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('service-worker.js')
      .then(reg => console.log('Service worker registered!'))
      .catch(err => console.log('Service worker registration failed:', err));
  });
}
*/

// Form validation and feedback
const contactForm = document.querySelector("form");
if (contactForm) {
  contactForm.addEventListener("submit", function(e) {
    const email = contactForm.querySelector('input[name="email"]').value;
    if (!email.includes("@")) {
      e.preventDefault();
      alert("Please enter a valid email address.");
      return;
    }
    // Allow the form to submit to the PHP server
  });
}

// Scroll Reveal Observer
const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('active');
    }
  });
}, {
  threshold: 0.1
});

document.querySelectorAll('.reveal').forEach(el => {
  revealObserver.observe(el);
});