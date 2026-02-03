<!-- Contact Section -->
<section id="contact" class="py-20 bg-stone-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-stone-900 mb-6">Contact Us</h2>
            <div class="w-20 h-1 bg-amber-400 mx-auto mb-6 rounded"></div>
            <p class="text-xl text-stone-600">We'd love to hear from you</p>
        </div>
        
        <div class="grid lg:grid-cols-5 gap-16 items-start">
            <!-- Contact Info -->
            <div class="lg:col-span-2 space-y-8">
                <?php
                $contact_info = [
                    [
                        'icon' => 'fas fa-phone',
                        'title' => 'Phone',
                        'content' => '<a href="tel:0824276104" class="text-stone-600 hover:text-amber-600 transition-colors">082 427 6104</a>'
                    ],
                    [
                        'icon' => 'fas fa-envelope',
                        'title' => 'Email',
                        'content' => '<a href="mailto:ngoatomogoshadi7@gmail.com" class="text-stone-600 hover:text-amber-600 transition-colors">ngoatomogoshadi7@gmail.com</a>'
                    ],
                    [
                        'icon' => 'fas fa-clock',
                        'title' => 'Reception',
                        'content' => '<span class="text-stone-600">24/7 Reception Available</span>'
                    ]
                ];
                
                foreach ($contact_info as $info):
                ?>
                    <div class="flex items-start space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-400 to-amber-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="<?php echo $info['icon']; ?> text-xl text-white"></i>
                        </div>
                        <div class="flex-1 pt-2">
                            <h3 class="text-xl font-semibold text-stone-900 mb-2"><?php echo $info['title']; ?></h3>
                            <div class="text-lg"><?php echo $info['content']; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Contact Form -->
            <div class="lg:col-span-3">
                <div class="bg-white p-8 lg:p-12 rounded-2xl shadow-2xl">
                    <div id="form-message" class="mb-6 hidden"></div>
                    <form id="booking-form" class="space-y-6" action="api/contact.php" method="POST">
                        <!-- Name and Email Row -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-stone-700 mb-2">Your Name *</label>
                                <input type="text" id="name" name="name" required 
                                       class="w-full px-4 py-3 border-2 border-stone-200 rounded-lg focus:border-amber-400 focus:outline-none transition-colors text-stone-900">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-stone-700 mb-2">Your Email *</label>
                                <input type="email" id="email" name="email" required 
                                       class="w-full px-4 py-3 border-2 border-stone-200 rounded-lg focus:border-amber-400 focus:outline-none transition-colors text-stone-900">
                            </div>
                        </div>
                        
                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-stone-700 mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" 
                                   class="w-full px-4 py-3 border-2 border-stone-200 rounded-lg focus:border-amber-400 focus:outline-none transition-colors text-stone-900">
                        </div>
                        
                        <!-- Check-in and Check-out Row -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="checkin" class="block text-sm font-semibold text-stone-700 mb-2">Check-in Date *</label>
                                <input type="date" id="checkin" name="checkin" required 
                                       class="w-full px-4 py-3 border-2 border-stone-200 rounded-lg focus:border-amber-400 focus:outline-none transition-colors text-stone-900">
                            </div>
                            <div>
                                <label for="checkout" class="block text-sm font-semibold text-stone-700 mb-2">Check-out Date *</label>
                                <input type="date" id="checkout" name="checkout" required 
                                       class="w-full px-4 py-3 border-2 border-stone-200 rounded-lg focus:border-amber-400 focus:outline-none transition-colors text-stone-900">
                            </div>
                        </div>
                        
                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-semibold text-stone-700 mb-2">Special Requests or Questions</label>
                            <textarea id="message" name="message" rows="5" 
                                      class="w-full px-4 py-3 border-2 border-stone-200 rounded-lg focus:border-amber-400 focus:outline-none transition-colors text-stone-900 resize-none"></textarea>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" id="submit-btn"
                                class="w-full bg-gradient-to-r from-amber-400 to-amber-500 text-amber-900 font-bold py-4 px-8 rounded-lg transition-all duration-300 hover:from-amber-500 hover:to-amber-600 hover:-translate-y-1 hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <span class="btn-text">Send Booking Inquiry</span>
                            <span class="btn-loading hidden">
                                <i class="fas fa-spinner fa-spin mr-2"></i>Sending...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>