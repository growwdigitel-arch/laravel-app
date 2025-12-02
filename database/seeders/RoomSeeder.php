<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing rooms
        DB::table('rooms')->truncate();

        $indianNames = [
            'Aarav' => 'male', 'Vihaan' => 'male', 'Aditya' => 'male', 'Sai' => 'male', 'Arjun' => 'male', 
            'Reyansh' => 'male', 'Muhammad' => 'male', 'Aryan' => 'male', 'Krishna' => 'male', 'Ishaan' => 'male',
            'Saanvi' => 'female', 'Anya' => 'female', 'Kiara' => 'female', 'Diya' => 'female', 'Pari' => 'female', 
            'Ananya' => 'female', 'Myra' => 'female', 'Aadhya' => 'female', 'Fatima' => 'female', 'Zoya' => 'female'
        ];

        $roomTitles = [
            'Mumbai Chill Zone 🌊' => 'https://picsum.photos/seed/mumbai/800/600',
            'Bangalore Tech Talks 💻' => 'https://picsum.photos/seed/tech/800/600',
            'Delhi Foodies Corner 🥘' => 'https://picsum.photos/seed/food/800/600',
            'Bollywood Gossip 🎬' => 'https://picsum.photos/seed/movie/800/600',
            'Cricket Fever 🏏' => 'https://picsum.photos/seed/cricket/800/600',
            'Late Night Shayari 🌙' => 'https://picsum.photos/seed/night/800/600',
            'Tamil Music Vibes 🎵' => 'https://picsum.photos/seed/music/800/600',
            'Punjabi Beats 🕺' => 'https://picsum.photos/seed/dance/800/600',
            'Kerala Nature Lovers 🌴' => 'https://picsum.photos/seed/nature/800/600',
            'Hyderabad Biryani Club 🍗' => 'https://picsum.photos/seed/biryani/800/600',
            'Startup Hustle India 🚀' => 'https://picsum.photos/seed/startup/800/600',
            'UPSC Preparation Group 📚' => 'https://picsum.photos/seed/book/800/600',
            'Indian Gamers Unite 🎮' => 'https://picsum.photos/seed/gaming/800/600',
            'Desi Comedy Club 😂' => 'https://picsum.photos/seed/comedy/800/600',
            'Spiritual Awakening 🕉️' => 'https://picsum.photos/seed/yoga/800/600',
            'Travel India 🚂' => 'https://picsum.photos/seed/train/800/600',
            'Stock Market Tips 📈' => 'https://picsum.photos/seed/stock/800/600',
            'Fitness Freaks 💪' => 'https://picsum.photos/seed/gym/800/600',
            'Coding & Coffee ☕' => 'https://picsum.photos/seed/code/800/600',
            'Friendship Club 🤝' => 'https://picsum.photos/seed/friend/800/600'
        ];

        $categories = ['Music', 'Gaming', 'Chat', 'Dating', 'Debate', 'Comedy'];

        $rooms = [];

        foreach ($roomTitles as $title => $image) {
            $hostName = array_rand($indianNames);
            $gender = $indianNames[$hostName];
            
            // Generate avatar based on gender
            $avatarStyle = $gender === 'male' ? 'avataaars' : 'avataaars'; // Using avataaars for both but could switch
            // For better gender distinction, we can use different seeds or styles if available, 
            // but avataaars usually handles gender by features. 
            // Let's try to ensure we get something that looks appropriate or use a different service if needed.
            // Actually, ui-avatars is just text. Let's use dicebear with specific seeds or styles.
            // For simplicity and "men logo"/"female logo" request:
            
            $avatar = 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . $hostName;
            if ($gender === 'female') {
                $avatar .= '&eyebrows=default&eyes=default&mouth=smile&top=longHair';
            } else {
                $avatar .= '&eyebrows=default&eyes=default&mouth=smile&top=shortHair';
            }

            $rooms[] = [
                'name' => $title,
                'description' => 'Join us for a fun conversation about ' . explode(' ', $title)[0],
                'category' => $categories[array_rand($categories)],
                'host_name' => $hostName,
                'host_avatar' => $avatar,
                'participant_count' => rand(50, 80),
                'is_live' => true,
                'image' => $image,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Room::insert($rooms);
    }
}
