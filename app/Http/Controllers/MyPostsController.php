<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyPostsController extends Controller
{
    public function index()
    {
        // Example static posts, replace with DB fetch later
        $posts = [
            [
                'title' => 'Nasi Lemak',
                'description' => 'The excess food from event at ICC Hall. Packed in sealed takeaway containers. Please collect by 6:00 PM today.',
                'pickup_location' => 'Mahallah Asma, Block C Lobby',
                'contact' => 'Whatsapp 012-3456789',
                'category' => 'Rice Meals',
                'expiry' => '4 Dec 2025, 10:00 PM',
                'pax' => 20,
                'posted_at' => 'Posted 4 Dec 2025',
                'image_url' => 'https://savoryorigin.com/wp-content/uploads/2022/08/shutterstock_1446714962-scaled.jpg',
                'status' => 'ACTIVE',
                'details_link' => 'https://sites.google.com/view/iiumfoodsharing/food-post-details-donor',
            ],
            [
                'title' => 'Nasi Ayam Gepuk',
                'description' => 'Just bought from Mahallah Asma. Freshly purchased ayam gepuk available for collection.',
                'pickup_location' => 'Mahallah Asma',
                'contact' => 'Whatsapp 011-222333',
                'category' => 'Rice Meals',
                'expiry' => '4 Dec 2025, 12:00 AM',
                'pax' => 1,
                'posted_at' => 'Posted 4 Dec 2025',
                'image_url' => 'https://daganghalal.blob.core.windows.net/43653/Product/set-nasi-ayam-gepuk-1718875173046.jpg',
                'status' => 'CLAIMED',
                'details_link' => 'https://sites.google.com/view/iiumfoodsharing/food-post-details-receipient',
            ],
            [
                'title' => 'Chicken Wrap',
                'description' => 'Just wanna give sadaqah to anyone. Home-made chicken wraps. Portion size: 1 wrap each.',
                'pickup_location' => 'Mahallah Asma',
                'contact' => 'Whatsapp 010-999888',
                'category' => 'Bread & Pastry',
                'expiry' => '2 Dec 2025, 9:00 PM',
                'pax' => 35,
                'posted_at' => 'Posted 2 Dec 2025',
                'image_url' => 'https://www.shutterstock.com/image-photo/selective-focus-indian-food-paneer-600nw-2441817529.jpg',
                'status' => 'COMPLETED',
                'details_link' => 'https://sites.google.com/view/iiumfoodsharing/food-post-details-donor',
            ],
            [
                'title' => 'Spaghetti Bolognese',
                'description' => 'Bought from Warung Cik Ani at Gate 2. This post is expired — it was not collected in time.',
                'pickup_location' => 'Gate 2',
                'contact' => 'Whatsapp 013-777666',
                'category' => 'Noodles',
                'expiry' => '30 Nov 2025, 5:00 PM',
                'pax' => 2,
                'posted_at' => 'Posted 30 Nov 2025',
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9AnRCx_ocUtZhd_Cz5-s5nErLG02CrBDhdg&s',
                'status' => 'EXPIRED',
                'details_link' => 'https://sites.google.com/view/iiumfoodsharing/food-post-details-receipient',
            ],
        ];

        return view('mypost', compact('posts'));

    }
}
