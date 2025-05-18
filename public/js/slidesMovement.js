    // --- Image Carousel Script ---
            // Carousel Logic (Auto-sliding with Fade Transition)
            const carousel = document.querySelector('.image-carousel');
            if (carousel) {
                const slides = carousel.querySelectorAll('.carousel-slide');
                const prevBtn = carousel.querySelector('.carousel-control.prev');
                const nextBtn = carousel.querySelector('.carousel-control.next');
                let currentIndex = 0;
                let slideInterval; // Variable to hold the interval ID
                const slideDuration = 3000; // 3000 milliseconds = 3 seconds
    
                function showSlide(index) {
                    // Ensure index wraps around if it goes out of bounds
                    // Adding slides.length before modulo handles negative results correctly
                    currentIndex = (index + slides.length) % slides.length;
    
                    slides.forEach((slide, i) => {
                        // Add 'active' class to the target slide, remove from others
                        if (i === currentIndex) {
                            slide.classList.add('active');
                        } else {
                            slide.classList.remove('active');
                        }
                    });
                }
    
                function nextSlide() {
                    showSlide(currentIndex + 1);
                }
    
                function prevSlide() {
                    showSlide(currentIndex - 1);
                }
    
                function startAutoSlide() {
                    // Clear any existing interval before starting a new one
                    clearInterval(slideInterval);
                    // Start the interval
                    slideInterval = setInterval(nextSlide, slideDuration);
                }
    
                // Event Listeners for manual controls
                if (prevBtn && nextBtn) {
                     prevBtn.addEventListener('click', () => {
                        prevSlide();
                        startAutoSlide(); // Reset timer on manual navigation
                    });
    
                    nextBtn.addEventListener('click', () => {
                        nextSlide();
                        startAutoSlide(); // Reset timer on manual navigation
                    });
                }
    
    
                // --- Optional: Pause on Hover ---
                carousel.addEventListener('mouseenter', () => {
                    clearInterval(slideInterval); // Pause auto-sliding
                });
    
                carousel.addEventListener('mouseleave', () => {
                    startAutoSlide(); // Resume auto-sliding
                });
                // --- End Optional: Pause on Hover ---
    
    
                // Initial setup
                if (slides.length > 0) {
                     showSlide(currentIndex); // Show the first slide initially
                     if (slides.length > 1) { // Only start auto-slide if there's more than one slide
                         startAutoSlide(); // Start the automatic sliding
                     }
                }
            }
            