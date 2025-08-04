<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Mock data - in a real application, this would come from your database
        $mockPosts = [
            [
                'id' => 1,
                'title' => "The Future of Electric Supercars: McLaren Artura Review",
                'excerpt' => "McLaren's hybrid masterpiece combines cutting-edge technology with raw performance in ways we never thought possible.",
                'image' => "https://hips.hearstapps.com/hmg-prod/images/2023-mclaren-artura-141-1655218129.jpg?crop=0.622xw:0.524xh;0.378xw,0.430xh&resize=2048:*",
                'category' => "Reviews",
                'author' => "Alex Thompson",
                'date' => "2024-01-15",
                'views' => 2400,
                'likes' => 89,
                'featured' => true,
                'hot' => true
            ],
            [
                'id' => 2,
                'title' => "Restoration Story: 1969 Dodge Charger R/T",
                'excerpt' => "Follow our journey as we bring this classic muscle car back to its former glory with modern touches.",
                'image' => "https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800&h=600&fit=crop",
                'category' => "Classic Cars",
                'author' => "Sarah Mitchell",
                'date' => "2024-01-12",
                'views' => 1800,
                'likes' => 156,
                'hot' => true
            ],
            [
                'id' => 3,
                'title' => "Track Day Special: Porsche 911 GT3 RS",
                'excerpt' => "We take the ultimate track weapon to its natural habitat and push it to the absolute limit.",
                'image' => "https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&h=600&fit=crop",
                'category' => "Track Tests",
                'author' => "Mike Rodriguez",
                'date' => "2024-01-10",
                'views' => 3200,
                'likes' => 203,
                'hot' => true
            ],
            [
                'id' => 4,
                'title' => "Budget Build: Making a Miata Fast",
                'excerpt' => "Proving you don't need deep pockets to have serious fun on the track with smart modifications.",
                'image' => "https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800&h=600&fit=crop",
                'category' => "Modifications",
                'author' => "David Chen",
                'date' => "2024-01-08",
                'views' => 1600,
                'likes' => 94
            ],
            [
                'id' => 5,
                'title' => "New vs Used: BMW M3 Buying Guide",
                'excerpt' => "Everything you need to know before purchasing your dream sports sedan, from financing to maintenance.",
                'image' => "https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&h=600&fit=crop",
                'category' => "Buying Guides",
                'author' => "Jessica Park",
                'date' => "2024-01-05",
                'views' => 2100,
                'likes' => 127
            ],
            [
                'id' => 6,
                'title' => "Electric Revolution: Tesla Model S Plaid Review",
                'excerpt' => "The fastest production car ever made? We put Tesla's latest creation through its paces.",
                'image' => "https://images.unsplash.com/photo-1536700503339-1e4b06520771?w=800&h=600&fit=crop",
                'category' => "Reviews",
                'author' => "Chris Wilson",
                'date' => "2024-01-03",
                'views' => 2800,
                'likes' => 145
            ]
        ];

        $categories = [
            "All",
            "Reviews",
            "Classic Cars",
            "Track Tests",
            "Modifications",
            "Buying Guides",
            "News"
        ];

        // Get the selected category from the request
        $selectedCategory = $request->get('category', 'All');

        // Filter posts based on selected category
        $filteredPosts = collect($mockPosts);
        if ($selectedCategory !== 'All') {
            $filteredPosts = $filteredPosts->filter(function ($post) use ($selectedCategory) {
                return $post['category'] === $selectedCategory;
            });
        }

        // Get featured post
        $featuredPost = collect($mockPosts)->firstWhere('featured', true);

        // Get hot posts
        $hotPosts = collect($mockPosts)->where('hot', true);

        return view('home', compact('filteredPosts', 'featuredPost', 'hotPosts', 'categories'));
    }
} 