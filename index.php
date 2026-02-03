<?php
$page_title = "Ngoato Mogoshadi Lodge | Lebowakgomo Guest House";
$page_description = "Ngoato Mogoshadi Lodge in Lebowakgomo - Luxurious comfort and convenience for business travelers and holiday guests";
include 'includes/header.php';
?>

<!-- Hero Section -->
<section id="home" class="min-h-screen bg-gradient-to-br from-amber-900/70 via-amber-800/60 to-amber-700/50 bg-cover bg-center bg-fixed flex items-center justify-center text-center text-white relative" style="background-image: url('images/gallery/hero/image.jpeg');">
    <div class="absolute inset-0 bg-black/30"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 animate-fade-in-up">
        <h1 class="text-5xl md:text-6xl font-bold mb-6 text-shadow-lg">Welcome to Ngoato Mogoshadi Lodge</h1>
        <p class="text-xl md:text-2xl mb-8 font-light text-shadow">Luxurious Comfort in the Heart of Lebowakgomo</p>
        <a href="#contact" class="inline-block px-10 py-4 bg-amber-400 text-amber-900 rounded-full font-semibold text-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:bg-amber-300">
            Book Your Stay
        </a>
    </div>
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 bg-stone-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-stone-900 mb-6">About Our Lodge</h2>
            <div class="w-20 h-1 bg-amber-400 mx-auto mb-6 rounded"></div>
        </div>
        
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-6">
                <p class="text-xl text-stone-700 leading-relaxed font-medium">
                    Ngoato Mogoshadi Lodge in Lebowakgomo provides luxurious comfort and convenience to the business traveler and holiday guests.
                </p>
                <p class="text-lg text-stone-600 leading-relaxed">
                    At Ngoato Mogoshadi Lodge you will find spacious en suite rooms, modern interior, friendly service and more than enough secure parking. For relaxation there is a cold water swimming pool.
                </p>
                <p class="text-lg text-stone-600 leading-relaxed">
                    After a long day's work you can relax on the grass or wooden seats underneath the numerous trees in the garden and listen to the tranquility of the numerous bird songs.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-6 mt-8">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-amber-400 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-900" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-stone-700 font-medium">4.5 km from Mall@Lebo</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-amber-400 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-900" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm3 7a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-stone-700 font-medium">47 km from Polokwane</span>
                    </div>
                </div>
            </div>
            
            <div class="relative">
                <div class="rounded-2xl overflow-hidden shadow-2xl">
                    <img src="images/gallery/about/image.jpeg" alt="Luxury lodge exterior" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'components/amenities.php'; ?>
<?php include 'components/gallery.php'; ?>
<?php include 'components/location.php'; ?>
<?php include 'components/contact.php'; ?>

<?php include 'includes/footer.php'; ?>