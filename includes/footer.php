<!-- Footer -->
<footer class="bg-stone-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- Logo and Description -->
            <div class="lg:col-span-2">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="w-12 h-12">
                        <svg viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                            <circle cx="30" cy="30" r="28" fill="#d4af37" opacity="0.2"/>
                            <path d="M30 10 L40 25 L30 22 L20 25 Z" fill="#d4af37"/>
                            <rect x="20" y="25" width="20" height="20" fill="#8b7355" rx="2"/>
                            <rect x="25" y="30" width="4" height="6" fill="#d4af37"/>
                            <rect x="31" y="30" width="4" height="6" fill="#d4af37"/>
                            <rect x="27" y="38" width="6" height="7" fill="#5a4a3a"/>
                            <circle cx="15" cy="20" r="3" fill="#2d5016" opacity="0.6"/>
                            <circle cx="45" cy="22" r="4" fill="#2d5016" opacity="0.6"/>
                            <circle cx="12" cy="35" r="2.5" fill="#2d5016" opacity="0.6"/>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold tracking-wide">Ngoato Mogoshadi</span>
                        <span class="text-xs font-semibold text-amber-400 tracking-widest">LODGE</span>
                    </div>
                </div>
                <p class="text-stone-300 leading-relaxed max-w-md">
                    Luxurious comfort and convenience in Lebowakgomo. Experience tranquil accommodation with modern amenities and exceptional service.
                </p>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold text-amber-400 mb-6">Quick Links</h3>
                <ul class="space-y-3">
                    <?php
                    $footer_links = [
                        ['href' => '#about', 'text' => 'About'],
                        ['href' => '#amenities', 'text' => 'Amenities'],
                        ['href' => '#gallery', 'text' => 'Gallery'],
                        ['href' => '#location', 'text' => 'Location']
                    ];
                    
                    foreach ($footer_links as $link):
                    ?>
                        <li>
                            <a href="<?php echo $link['href']; ?>" class="text-stone-300 hover:text-amber-400 transition-colors duration-300">
                                <?php echo $link['text']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold text-amber-400 mb-6">Contact Info</h3>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-phone text-amber-400"></i>
                        <a href="tel:0824276104" class="text-stone-300 hover:text-amber-400 transition-colors">082 427 6104</a>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-amber-400"></i>
                        <a href="mailto:ngoatomogoshadi7@gmail.com" class="text-stone-300 hover:text-amber-400 transition-colors break-all">ngoatomogoshadi7@gmail.com</a>
                    </li>
                    <li class="flex items-start space-x-3">
                        <i class="fas fa-map-marker-alt text-amber-400 mt-1"></i>
                        <span class="text-stone-300">Lebowakgomo, Limpopo</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Bottom Bar -->
        <div class="border-t border-stone-700 pt-8 text-center">
            <p class="text-stone-400">
                &copy; <?php echo date('Y'); ?> Ngoato Mogoshadi Lodge. All rights reserved.
            </p>
        </div>
    </div>
</footer>

<!-- JavaScript -->
<script>
// Mobile menu toggle
const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
const mobileMenu = document.getElementById('mobile-menu');

if (mobileMenuToggle && mobileMenu) {
    // Toggle menu on button click
    mobileMenuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        
        // Toggle hamburger icon
        const icon = mobileMenuToggle.querySelector('svg');
        if (mobileMenu.classList.contains('hidden')) {
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
        } else {
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
        }
    });
    
    // Close menu when clicking on menu items
    const mobileMenuLinks = mobileMenu.querySelectorAll('a');
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
            const icon = mobileMenuToggle.querySelector('svg');
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
        });
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', (event) => {
        if (!mobileMenuToggle.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.classList.add('hidden');
            const icon = mobileMenuToggle.querySelector('svg');
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
        }
    });
}

// Gallery filter functionality
const filterBtns = document.querySelectorAll('.filter-btn');
const galleryItems = document.querySelectorAll('.gallery-item');

filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        // Update active button
        filterBtns.forEach(b => {
            b.classList.remove('bg-amber-400', 'text-amber-900');
            b.classList.add('bg-white', 'border-2', 'border-amber-400', 'text-amber-700');
        });
        btn.classList.remove('bg-white', 'border-2', 'border-amber-400', 'text-amber-700');
        btn.classList.add('bg-amber-400', 'text-amber-900');
        
        const filter = btn.getAttribute('data-filter');
        
        galleryItems.forEach(item => {
            if (filter === 'all' || item.getAttribute('data-category') === filter) {
                item.classList.remove('hidden');
                item.style.opacity = '1';
                item.style.transform = 'scale(1)';
            } else {
                item.style.opacity = '0';
                item.style.transform = 'scale(0.8)';
                setTimeout(() => {
                    item.classList.add('hidden');
                }, 300);
            }
        });
        
        updateVisibleImages();
    });
});

// Lightbox functionality
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightbox-img');
const closeLightbox = document.getElementById('close-lightbox');
const prevImage = document.getElementById('prev-image');
const nextImage = document.getElementById('next-image');

let currentImageIndex = 0;
let visibleImages = [];

function updateVisibleImages() {
    visibleImages = Array.from(galleryItems)
        .filter(item => !item.classList.contains('hidden'))
        .map(item => item.querySelector('img'));
}

function openLightbox(index) {
    currentImageIndex = index;
    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');
    lightboxImg.src = visibleImages[currentImageIndex].src;
    lightboxImg.alt = visibleImages[currentImageIndex].alt;
    document.body.style.overflow = 'hidden';
}

function closeLightboxFunc() {
    lightbox.classList.add('hidden');
    lightbox.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// Initialize visible images
updateVisibleImages();

// Gallery item click events
galleryItems.forEach((item, index) => {
    item.addEventListener('click', () => {
        const clickedImg = item.querySelector('img');
        const imgIndex = visibleImages.indexOf(clickedImg);
        if (imgIndex !== -1) {
            openLightbox(imgIndex);
        }
    });
});

// Lightbox controls
closeLightbox?.addEventListener('click', closeLightboxFunc);

lightbox?.addEventListener('click', (e) => {
    if (e.target === lightbox) {
        closeLightboxFunc();
    }
});

prevImage?.addEventListener('click', () => {
    currentImageIndex = (currentImageIndex - 1 + visibleImages.length) % visibleImages.length;
    lightboxImg.src = visibleImages[currentImageIndex].src;
    lightboxImg.alt = visibleImages[currentImageIndex].alt;
});

nextImage?.addEventListener('click', () => {
    currentImageIndex = (currentImageIndex + 1) % visibleImages.length;
    lightboxImg.src = visibleImages[currentImageIndex].src;
    lightboxImg.alt = visibleImages[currentImageIndex].alt;
});

// Keyboard navigation
document.addEventListener('keydown', (e) => {
    if (!lightbox.classList.contains('hidden')) {
        if (e.key === 'Escape') {
            closeLightboxFunc();
        } else if (e.key === 'ArrowLeft') {
            prevImage.click();
        } else if (e.key === 'ArrowRight') {
            nextImage.click();
        }
    }
});

// Contact form with PHP mailer
const bookingForm = document.getElementById('booking-form');

if (bookingForm) {
    // Set minimum dates
    const today = new Date().toISOString().split('T')[0];
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    
    if (checkinInput && checkoutInput) {
        checkinInput.setAttribute('min', today);
        
        checkinInput.addEventListener('change', function() {
            const checkinDate = new Date(this.value);
            checkinDate.setDate(checkinDate.getDate() + 1);
            checkoutInput.setAttribute('min', checkinDate.toISOString().split('T')[0]);
            
            // Clear checkout if it's before new minimum
            if (checkoutInput.value && new Date(checkoutInput.value) <= new Date(this.value)) {
                checkoutInput.value = '';
            }
        });
    }
    
    bookingForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const form = e.target;
        const formData = new FormData(form);
        const submitBtn = document.getElementById('submit-btn');
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoading = submitBtn.querySelector('.btn-loading');
        const messageDiv = document.getElementById('form-message');
        
        // Show loading state
        submitBtn.disabled = true;
        btnText.classList.add('hidden');
        btnLoading.classList.remove('hidden');
        messageDiv.classList.add('hidden');
        
        try {
            const response = await fetch('api/contact.php', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            
            // Show message
            messageDiv.className = `mb-6 p-4 rounded-lg ${result.success ? 'bg-green-100 border border-green-300 text-green-700' : 'bg-red-100 border border-red-300 text-red-700'}`;
            messageDiv.textContent = result.message;
            messageDiv.classList.remove('hidden');
            
            // Reset form if successful
            if (result.success) {
                form.reset();
                
                // Scroll to message
                messageDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            
        } catch (error) {
            console.error('Form submission error:', error);
            messageDiv.className = 'mb-6 p-4 rounded-lg bg-red-100 border border-red-300 text-red-700';
            messageDiv.textContent = 'An error occurred. Please try again or contact us directly.';
            messageDiv.classList.remove('hidden');
        } finally {
            // Reset button state
            submitBtn.disabled = false;
            btnText.classList.remove('hidden');
            btnLoading.classList.add('hidden');
        }
    });
}

// Smooth scrolling for anchor links
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

// Scroll animations
const observeElements = (selector, options = {}) => {
    const elements = document.querySelectorAll(selector);
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px', ...options });
    
    elements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
};

// Apply scroll animations
observeElements('section');
observeElements('.gallery-item', { threshold: 0.2 });
</script>

</body>
</html>