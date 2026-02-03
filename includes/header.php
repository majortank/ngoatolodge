<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $page_description ?? 'Ngoato Mogoshadi Lodge - Luxury accommodation in Lebowakgomo'; ?>">
    <title><?php echo $page_title ?? 'Ngoato Mogoshadi Lodge'; ?></title>
    
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#d4af37',
                        secondary: '#8b7355',
                        accent: '#2d5016'
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui']
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 1s ease-out',
                        'bounce-slow': 'bounce 2s infinite'
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .text-shadow { text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); }
        .text-shadow-lg { text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.7); }
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="font-sans leading-relaxed">
    
<!-- Navigation -->
<nav class="fixed top-0 w-full bg-white/95 backdrop-blur-sm shadow-lg z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
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
                    <span class="text-xl font-bold text-stone-900 tracking-wide">Ngoato Mogoshadi</span>
                    <span class="text-xs font-semibold text-amber-600 tracking-widest">LODGE</span>
                </div>
            </div>
            
            <!-- Desktop Navigation -->
            <ul class="hidden lg:flex space-x-8">
                <?php
                $nav_items = [
                    ['href' => '#home', 'text' => 'Home'],
                    ['href' => '#about', 'text' => 'About'],
                    ['href' => '#amenities', 'text' => 'Amenities'],
                    ['href' => '#gallery', 'text' => 'Gallery'],
                    ['href' => '#location', 'text' => 'Location'],
                    ['href' => '#contact', 'text' => 'Contact']
                ];
                
                foreach ($nav_items as $item) {
                    echo "<li><a href='{$item['href']}' class='text-stone-700 hover:text-amber-600 font-medium transition-colors duration-300 relative group'>";
                    echo $item['text'];
                    echo "<span class='absolute bottom-0 left-0 w-0 h-0.5 bg-amber-600 transition-all duration-300 group-hover:w-full'></span>";
                    echo "</a></li>";
                }
                ?>
            </ul>
            
            <!-- Mobile Menu Button -->
            <button class="lg:hidden p-2" id="mobile-menu-toggle">
                <svg class="w-6 h-6 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Navigation -->
        <div class="lg:hidden hidden bg-white border-t" id="mobile-menu">
            <div class="py-4 space-y-2">
                <?php foreach ($nav_items as $item): ?>
                    <a href="<?php echo $item['href']; ?>" class="block px-4 py-2 text-stone-700 hover:text-amber-600 hover:bg-amber-50 transition-colors duration-300">
                        <?php echo $item['text']; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</nav>