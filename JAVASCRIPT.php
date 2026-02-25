// Video Hero Slider - Seamless Loop
const heroVideos = document.querySelectorAll('.hero-video');
if (heroVideos.length > 0) {
    let currentIdx = 0;

    function transitionVideo() {
        const current = heroVideos[currentIdx];
        const nextIdx = (currentIdx + 1) % heroVideos.length;
        const next = heroVideos[nextIdx];

        // Start next video in background to buffer
        next.play().then(() => {
            next.classList.add('active');
            
            // Wait for fade to complete before cleaning up old video
            setTimeout(() => {
                current.classList.remove('active');
                current.pause();
                current.currentTime = 0;
            }, 1500);
            
            currentIdx = nextIdx;
        }).catch(err => {
            console.warn("Buffer failed, retrying next loop", err);
            currentIdx = nextIdx;
            transitionVideo();
        });
    }

    // Initialize first video immediately
    heroVideos[0].classList.add('active');
    heroVideos[0].play();

    // Listen for end to trigger next
    heroVideos.forEach(video => {
        video.addEventListener('ended', transitionVideo);
    });
}

// Core Values Auto-Slider
const valuesGrid = document.querySelector('.values-grid');
if (valuesGrid) {
    let isPaused = false;
    const scrollSpeed = 1; // Pixels per step

    function autoScroll() {
        if (!isPaused) {
            valuesGrid.scrollLeft += scrollSpeed;
            // If reached the end, reset to start for continuous loop effect
            if (valuesGrid.scrollLeft >= (valuesGrid.scrollWidth - valuesGrid.clientWidth)) {
                valuesGrid.scrollLeft = 0;
            }
        }
        requestAnimationFrame(autoScroll);
    }

    valuesGrid.addEventListener('mouseenter', () => isPaused = true);
    valuesGrid.addEventListener('mouseleave', () => isPaused = false);
    
    // Start the slider
    autoScroll();
}

// Church Moments Auto-Slider
const videoGallery = document.querySelector('.video-gallery');
if (videoGallery) {
    let isPaused = false;
    const scrollSpeed = 0.8; 

    function autoScrollMoments() {
        if (!isPaused) {
            videoGallery.scrollLeft += scrollSpeed;
            if (videoGallery.scrollLeft >= (videoGallery.scrollWidth - videoGallery.clientWidth)) {
                videoGallery.scrollLeft = 0;
            }
        }
        requestAnimationFrame(autoScrollMoments);
    }

    videoGallery.addEventListener('mouseenter', () => isPaused = true);
    videoGallery.addEventListener('mouseleave', () => isPaused = false);
    
    autoScrollMoments();
}

// Tab Switching Logic
document.querySelectorAll('nav a').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    const targetId = this.getAttribute('href').substring(1);
    const targetSection = document.getElementById(targetId);

    if (targetSection && targetSection.classList.contains('tab-content')) {
      e.preventDefault();
      
      // Remove active class from all anchors and sections
      document.querySelectorAll('nav a').forEach(a => a.classList.remove('active'));
      document.querySelectorAll('.tab-content').forEach(s => s.classList.remove('active'));
      
      // Add active class to current
      this.classList.add('active');
      targetSection.classList.add('active');

      // Scroll to top of container
      window.scrollTo({
        top: document.querySelector('.container').offsetTop - 100,
        behavior: 'smooth'
      });

      // Close mobile menu
      const navLinks = document.querySelector('.nav-links');
      if (navLinks.classList.contains('active')) {
        navLinks.classList.remove('active');
      }
    }
  });
});

// Mobile Menu Toggle
const menuToggle = document.getElementById('mobile-menu');
const navLinks = document.querySelector('.nav-links');
if (menuToggle && navLinks) {
  menuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('active');
  });
}

// PWA Service Worker Registration
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('service-worker.js')
      .catch(err => console.log('SW registration failed:', err));
  });
}

// Form validation
const contactForm = document.querySelector("form");
if (contactForm) {
  contactForm.addEventListener("submit", function(e) {
    let email = document.querySelector("input[name='email']").value;
    if(!email.includes("@")) {
      alert("Please enter a valid email address.");
      e.preventDefault();
    }
  });
}