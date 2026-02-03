<!-- Amenities Section -->
<section id="amenities" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-stone-900 mb-6">Our Amenities</h2>
            <div class="w-20 h-1 bg-amber-400 mx-auto mb-6 rounded"></div>
            <p class="text-xl text-stone-600">Everything you need for a comfortable stay</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $amenities = [
                [
                    'icon' => 'fas fa-bed',
                    'title' => 'Spacious En Suite Rooms',
                    'description' => 'Comfortable and modern rooms with private bathrooms'
                ],
                [
                    'icon' => 'fas fa-swimming-pool',
                    'title' => 'Swimming Pool',
                    'description' => 'Refreshing cold water pool for relaxation'
                ],
                [
                    'icon' => 'fas fa-parking',
                    'title' => 'Secure Parking',
                    'description' => 'Ample safe parking space for all guests'
                ],
                [
                    'icon' => 'fas fa-tree',
                    'title' => 'Beautiful Garden',
                    'description' => 'Tranquil garden with seating areas and bird songs'
                ],
                [
                    'icon' => 'fas fa-tv',
                    'title' => 'Bar & Lounge',
                    'description' => 'Big screen for sports events (residents only)'
                ],
                [
                    'icon' => 'fas fa-concierge-bell',
                    'title' => 'Friendly Service',
                    'description' => 'Attentive staff ensuring your comfort'
                ]
            ];
            
            foreach ($amenities as $index => $amenity):
            ?>
                <div class="group bg-stone-50 p-8 rounded-2xl text-center transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <div class="w-20 h-20 bg-gradient-to-br from-amber-400 to-amber-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="<?php echo $amenity['icon']; ?> text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-stone-900 mb-4"><?php echo $amenity['title']; ?></h3>
                    <p class="text-stone-600 leading-relaxed"><?php echo $amenity['description']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>