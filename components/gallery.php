<!-- Gallery Section -->
<section id="gallery" class="py-20 bg-stone-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-stone-900 mb-6">Photo Gallery</h2>
            <div class="w-20 h-1 bg-amber-400 mx-auto mb-6 rounded"></div>
            <p class="text-xl text-stone-600 mb-8">Experience the beauty of our lodge</p>
        </div>
        
        <!-- Gallery Filter Buttons -->
        <div class="flex flex-wrap justify-center gap-3 mb-8 md:mb-12">
            <button class="filter-btn px-6 md:px-8 py-2 md:py-3 bg-amber-400 text-amber-900 rounded-full font-semibold transition-all duration-300 hover:bg-amber-500 text-sm md:text-base" data-filter="all">
                All
            </button>
            <button class="filter-btn px-6 md:px-8 py-2 md:py-3 bg-white border-2 border-amber-400 text-amber-700 rounded-full font-semibold transition-all duration-300 hover:bg-amber-400 hover:text-amber-900 text-sm md:text-base" data-filter="indoor">
                Indoor
            </button>
            <button class="filter-btn px-6 md:px-8 py-2 md:py-3 bg-white border-2 border-amber-400 text-amber-700 rounded-full font-semibold transition-all duration-300 hover:bg-amber-400 hover:text-amber-900 text-sm md:text-base" data-filter="outdoor">
                Outdoor
            </button>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6" id="gallery-grid">
            <?php
            // Indoor images
            $indoor_images = [
                ['src' => './images/gallery/indoor/image-1.jpeg', 'alt' => 'Lodge interior', 'label' => 'Interior'],
                ['src' => './images/gallery/indoor/image-2.jpeg', 'alt' => 'Room interior', 'label' => 'Room'],
                ['src' => './images/gallery/indoor/image-3.jpeg', 'alt' => 'Bedroom', 'label' => 'Bedroom'],
                ['src' => './images/gallery/indoor/image-4.jpeg', 'alt' => 'Suite', 'label' => 'Suite'],
                ['src' => './images/gallery/indoor/image-5.jpeg', 'alt' => 'Room view', 'label' => 'Room'],
                ['src' => './images/gallery/indoor/image-6.jpeg', 'alt' => 'Lounge area', 'label' => 'Lounge'],
                ['src' => './images/gallery/indoor/image-7.jpeg', 'alt' => 'Bar area', 'label' => 'Bar'],
                ['src' => './images/gallery/indoor/image-8.jpeg', 'alt' => 'Interior space', 'label' => 'Interior'],
                ['src' => './images/gallery/indoor/image-9.jpeg', 'alt' => 'Room details', 'label' => 'Room'],
                ['src' => './images/gallery/indoor/image-10.jpeg', 'alt' => 'Bedroom setup', 'label' => 'Bedroom'],
                ['src' => './images/gallery/indoor/image-11.jpeg', 'alt' => 'Suite interior', 'label' => 'Suite'],
                ['src' => './images/gallery/indoor/image-12.jpeg', 'alt' => 'Bathroom', 'label' => 'Bathroom']
            ];
            
            // Outdoor images
            $outdoor_images = [
                ['src' => './images/gallery/outdoor/image-1.jpeg', 'alt' => 'Lodge exterior', 'label' => 'Exterior'],
                ['src' => './images/gallery/outdoor/image-2.jpeg', 'alt' => 'Lodge view', 'label' => 'Exterior'],
                ['src' => './images/gallery/outdoor/image-3.jpeg', 'alt' => 'Front entrance', 'label' => 'Entrance'],
                ['src' => './images/gallery/outdoor/image-4.jpeg', 'alt' => 'Garden area', 'label' => 'Garden'],
                ['src' => './images/gallery/outdoor/image-5.jpeg', 'alt' => 'Outdoor space', 'label' => 'Outdoor'],
                ['src' => './images/gallery/outdoor/image-6.jpeg', 'alt' => 'Swimming pool', 'label' => 'Pool'],
                ['src' => './images/gallery/outdoor/image-7.jpeg', 'alt' => 'Pool area', 'label' => 'Pool'],
                ['src' => './images/gallery/outdoor/image-8.jpeg', 'alt' => 'Garden seating', 'label' => 'Garden'],
                ['src' => './images/gallery/outdoor/image-9.jpeg', 'alt' => 'Outdoor facilities', 'label' => 'Facilities'],
                ['src' => './images/gallery/outdoor/image-10.jpeg', 'alt' => 'Parking area', 'label' => 'Parking'],
                ['src' => './images/gallery/outdoor/image-11.jpeg', 'alt' => 'Exterior view', 'label' => 'Exterior'],
                ['src' => './images/gallery/outdoor/image-12.jpeg', 'alt' => 'Lodge grounds', 'label' => 'Grounds']
            ];
            
            // Render indoor images
            foreach ($indoor_images as $image):
            ?>
                <div class="gallery-item group relative overflow-hidden rounded-lg md:rounded-2xl cursor-pointer aspect-square bg-stone-100" data-category="indoor">
                    <img src="<?php echo $image['src']; ?>" alt="<?php echo $image['alt']; ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-amber-600/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end items-center p-4 md:p-6">
                        <div class="text-white text-center">
                            <svg class="w-8 h-8 md:w-12 md:h-12 mx-auto mb-2 md:mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                            </svg>
                            <span class="text-sm md:text-lg font-semibold uppercase tracking-wider"><?php echo $image['label']; ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <?php
            // Render outdoor images
            foreach ($outdoor_images as $image):
            ?>
                <div class="gallery-item group relative overflow-hidden rounded-lg md:rounded-2xl cursor-pointer aspect-square bg-stone-100" data-category="outdoor">
                    <img src="<?php echo $image['src']; ?>" alt="<?php echo $image['alt']; ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-amber-600/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end items-center p-4 md:p-6">
                        <div class="text-white text-center">
                            <svg class="w-8 h-8 md:w-12 md:h-12 mx-auto mb-2 md:mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                            </svg>
                            <span class="text-sm md:text-lg font-semibold uppercase tracking-wider"><?php echo $image['label']; ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black/95 hidden items-center justify-center z-50 p-4">
    <button class="absolute top-4 right-4 md:top-6 md:right-6 text-white text-3xl md:text-4xl hover:text-amber-400 transition-colors z-10" id="close-lightbox">
        &times;
    </button>
    <button class="absolute left-2 md:left-6 top-1/2 transform -translate-y-1/2 text-white hover:text-amber-400 transition-colors z-10" id="prev-image">
        <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button class="absolute right-2 md:right-6 top-1/2 transform -translate-y-1/2 text-white hover:text-amber-400 transition-colors z-10" id="next-image">
        <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>
    <img id="lightbox-img" class="max-w-full max-h-full w-auto h-auto object-contain" alt="Gallery image">
</div>