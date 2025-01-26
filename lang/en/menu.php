<?php

return [
    'header' => [
        'main-menu' => [
            ['name' => 'home', 'label' => 'Home'],
            ['name' => 'car-rental', 'label' => 'Car Rental'],
            ['name' => 'tour-package', 'label' => 'Tour Package'],
            ['name' => 'blog', 'label' => 'Blog'],
        ],
        'contact-btn' => 'Contact Us',
    ],
    'home' => [
        'hero' => [
            'description' => 'Get the comfort of <span>Car Rental</span> and <span>Tour Packages</span> in Lombok with professional and friendly service from us. Explore the beauty of Lombok with ease and enjoy a pleasant journey.',
            'hero-btn-car-rental' => 'Car Rental',
            'hero-btn-tour-package' => 'Tour Package',
        ],
        'products' => [
            'title' => 'Our Products and Services',
            'big-title' => 'Choose the Package You Need',
            'offers' => [
                ['title' => 'Car Rental', 'href' => 'car-rental', 'image' => 'storage/img/storyset-driving-bro.png',  'description' => 'Easy, fast, and affordable car rental! Choose your favorite vehicle for a comfortable journey with us.'],
                ['title' => 'Tour Packages', 'href' => 'tour-package', 'image' => 'storage/img/storyset-Journey-amico.png', 'description' => 'Explore your dream destinations with the best travel packages! Enjoy exciting and affordable vacations with us.'],
            ],
            'detail-btn' => 'Check Details'
        ],
        'blogs' => [
            'title' => 'Our Blogs',
            'big-title' => 'Discover the Beauty of Nature in Every Article',
            'all-blog-btn' => 'View All Blogs'
        ],
        'destination' => [
            'title' => 'Favorite Destinations',
            'big-title' => 'Find the best places for unforgettable experiences.',
            'all-destination-btn' => 'View All Destinations'
        ],
        'contact' => [
            'big-title' => 'Want to rent a car or choose a holiday package?',
            'description' => 'Contact us for reservations and more information.',
            'contact-btn' => 'Contact Us'
        ]
    ],
    'footer' => [
        'description' => 'Find Lombok tour packages, car rentals, and motorbike rentals at the best prices in Lombok',
        'address-title' => 'Address',
        'address' => 'Jln Raya Lembar-Gerung West Lombok (Near the Gerung roundabout).',
        'contact-title' => 'Contact Us',
        'language-title' => 'Language',
    ],
    'car-rental' => [
        'title' => 'Car Rental',
        'show' => [
            'policy' => 'Car Rental Policy',
            'information' => 'Important Terms'
        ]
    ],
    'tour-package' => [
        'title' => 'Tour Package',
        'price' => [
            'start' => 'Starting From',
            'end' => 'Person'
        ]
    ],
    'blog' => [
        'title' => 'Blog'
    ],
    'destinationblog' => [
        'title' => 'Destination Blog'
    ],
    'order' => 'Order Now'

];
