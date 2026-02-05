// Mobile Menu Toggle
const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
const navLinks = document.querySelector('.nav-links');

mobileMenuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('active');
    mobileMenuToggle.classList.toggle('active');
});

// Close mobile menu when clicking a link
document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
        navLinks.classList.remove('active');
        mobileMenuToggle.classList.remove('active');
    });
});

// Navbar scroll effect
const navbar = document.querySelector('.navbar');
let lastScroll = 0;

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll > 100) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
    
    lastScroll = currentScroll;
});

// Gallery Filter
const filterBtns = document.querySelectorAll('.filter-btn');
const galleryItems = document.querySelectorAll('.gallery-item');

filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        // Remove active class from all buttons
        filterBtns.forEach(b => b.classList.remove('active'));
        // Add active class to clicked button
        btn.classList.add('active');
        
        const filter = btn.getAttribute('data-filter');
        
        galleryItems.forEach(item => {
            if (filter === 'all') {
                item.classList.remove('hidden');
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'scale(1)';
                }, 10);
            } else {
                if (item.getAttribute('data-category') === filter) {
                    item.classList.remove('hidden');
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                    }, 10);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        item.classList.add('hidden');
                    }, 300);
                }
            }
        });
        
        // Update the visible images array for lightbox
        updateVisibleImages();
    });
});

// Gallery Lightbox
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightbox-img');
const closeLightbox = document.querySelector('.close-lightbox');
const prevImage = document.querySelector('.prev-image');
const nextImage = document.querySelector('.next-image');

let currentImageIndex = 0;
let visibleImages = [];

function updateVisibleImages() {
    visibleImages = Array.from(galleryItems)
        .filter(item => !item.classList.contains('hidden'))
        .map(item => item.querySelector('img'));
}

// Initialize visible images
updateVisibleImages();

galleryItems.forEach((item) => {
    item.addEventListener('click', () => {
        const clickedImg = item.querySelector('img');
        currentImageIndex = visibleImages.indexOf(clickedImg);
        openLightbox();
    });
});

function openLightbox() {
    lightbox.classList.add('active');
    lightboxImg.src = visibleImages[currentImageIndex].src;
    lightboxImg.alt = visibleImages[currentImageIndex].alt;
    document.body.style.overflow = 'hidden';
}

function closeLightboxFunc() {
    lightbox.classList.remove('active');
    document.body.style.overflow = 'auto';
}

closeLightbox.addEventListener('click', closeLightboxFunc);

lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox) {
        closeLightboxFunc();
    }
});

prevImage.addEventListener('click', () => {
    currentImageIndex = (currentImageIndex - 1 + visibleImages.length) % visibleImages.length;
    lightboxImg.src = visibleImages[currentImageIndex].src;
    lightboxImg.alt = visibleImages[currentImageIndex].alt;
});

nextImage.addEventListener('click', () => {
    currentImageIndex = (currentImageIndex + 1) % visibleImages.length;
    lightboxImg.src = visibleImages[currentImageIndex].src;
    lightboxImg.alt = visibleImages[currentImageIndex].alt;
});

// Keyboard navigation for lightbox
document.addEventListener('keydown', (e) => {
    if (!lightbox.classList.contains('active')) return;
    
    if (e.key === 'Escape') {
        closeLightboxFunc();
    } else if (e.key === 'ArrowLeft') {
        prevImage.click();
    } else if (e.key === 'ArrowRight') {
        nextImage.click();
    }
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            const offsetTop = target.offsetTop - 80;
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        }
    });
});

// Form submission
const bookingForm = document.getElementById('booking-form');
const formMessage = document.getElementById('form-message');
const submitBtn = document.getElementById('submit-btn');

if (bookingForm) {
    bookingForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.querySelector('.btn-text')?.classList.add('hidden');
            submitBtn.querySelector('.btn-loading')?.classList.remove('hidden');
        }

        if (formMessage) {
            formMessage.classList.add('hidden');
            formMessage.textContent = '';
        }

        try {
            const response = await fetch(bookingForm.action, {
                method: 'POST',
                body: new FormData(bookingForm)
            });

            const result = await response.json();

            if (formMessage) {
                formMessage.classList.remove('hidden');
                formMessage.className = result.success
                    ? 'mb-6 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3'
                    : 'mb-6 rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3';
                formMessage.textContent = result.message || 'Unexpected response from server.';
            }

            if (!result.success) {
                console.error('Contact form error:', result.message || result);
            }

            if (result.success) {
                bookingForm.reset();
            }
        } catch (error) {
            console.error('Contact form request failed:', error);
            if (formMessage) {
                formMessage.classList.remove('hidden');
                formMessage.className = 'mb-6 rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3';
                formMessage.textContent = 'Network error. Please try again.';
            }
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.querySelector('.btn-text')?.classList.remove('hidden');
                submitBtn.querySelector('.btn-loading')?.classList.add('hidden');
            }
        }
    });
}

// Set minimum date for date inputs to today
const today = new Date().toISOString().split('T')[0];
const checkinInput = document.getElementById('checkin');
const checkoutInput = document.getElementById('checkout');

if (checkinInput && checkoutInput) {
    checkinInput.setAttribute('min', today);
    checkoutInput.setAttribute('min', today);

    // Update checkout min date based on checkin
    checkinInput.addEventListener('change', function() {
        checkoutInput.setAttribute('min', this.value);
    });
}

// Intersection Observer for scroll animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe all sections
document.querySelectorAll('section').forEach(section => {
    section.style.opacity = '0';
    section.style.transform = 'translateY(30px)';
    section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(section);
});

// Animate amenity cards on scroll
const amenityCards = document.querySelectorAll('.amenity-card');
const cardObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
            setTimeout(() => {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }, index * 100);
        }
    });
}, observerOptions);

amenityCards.forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    cardObserver.observe(card);
});

// Gallery items fade-in animation
const galleryObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
            setTimeout(() => {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'scale(1)';
            }, index * 50);
        }
    });
}, observerOptions);

galleryItems.forEach(item => {
    item.style.opacity = '0';
    item.style.transform = 'scale(0.8)';
    item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    galleryObserver.observe(item);
});

// Add active class to current nav link based on scroll position
window.addEventListener('scroll', () => {
    let current = '';
    const sections = document.querySelectorAll('section');
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (pageYOffset >= (sectionTop - 200)) {
            current = section.getAttribute('id');
        }
    });
    
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
});
