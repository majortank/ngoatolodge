<!-- Location Section -->
<section id="location" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-stone-900 mb-6">Our Location</h2>
            <div class="w-20 h-1 bg-amber-400 mx-auto mb-6 rounded"></div>
            <p class="text-xl text-stone-600">Easy to find, close to everything</p>
        </div>
        
        <div class="grid lg:grid-cols-5 gap-12 items-start">
            <!-- Location Info -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Address Info -->
                <div class="bg-stone-50 p-8 rounded-2xl">
                    <div class="flex items-start space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-400 to-amber-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-stone-900 mb-3">Address</h3>
                            <p class="text-stone-700 mb-2">Lebowakgomo, Limpopo</p>
                            <p class="text-stone-600 text-sm mb-1">4.5 km from Mall@Lebo</p>
                            <p class="text-stone-600 text-sm">47 km from Polokwane</p>
                        </div>
                    </div>
                </div>
                
                <!-- Directions -->
                <div class="bg-stone-50 p-8 rounded-2xl">
                    <div class="flex items-start space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-400 to-amber-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-stone-900 mb-3">Getting Here</h3>
                            <p class="text-stone-700 mb-4">Easily accessible from major routes</p>
                            <a href="https://maps.google.com/maps?q=-24.2754615%2C29.4631711&z=17&hl=en" 
                               target="_blank" 
                               class="inline-flex items-center space-x-2 px-6 py-3 bg-amber-400 text-amber-900 rounded-lg font-semibold transition-all duration-300 hover:bg-amber-500 hover:-translate-y-1 hover:shadow-lg">
                                <span>Get Directions</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Map -->
            <div class="lg:col-span-3">
                <div class="rounded-2xl overflow-hidden shadow-2xl h-96 lg:h-[500px]">
                    <iframe 
                        src="https://maps.google.com/maps?q=-24.2754615,29.4631711&z=15&output=embed" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full h-full">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>