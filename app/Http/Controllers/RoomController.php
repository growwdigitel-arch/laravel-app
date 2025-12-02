<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::orderBy('is_live', 'desc')
            ->orderBy('participant_count', 'desc')
            ->get();
        
        return view('rooms.index', compact('rooms'));
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        $gifts = \App\Models\Gift::all();
        
        // Generate dummy participants
        $participants = [];
        $count = $room->participant_count > 0 ? $room->participant_count : 12; // Ensure at least some people
        
        // Add authenticated user if logged in
        if (auth()->check()) {
            $user = auth()->user();
            // Generate initials
            $names = explode(' ', $user->name);
            $initials = '';
            foreach ($names as $name) {
                $initials .= strtoupper(substr($name, 0, 1));
            }
            $initials = substr($initials, 0, 2); // Max 2 chars

            $participants[] = [
                'name' => $user->name,
                'avatar' => $user->avatar ?? null,
                'initials' => $initials,
                'is_speaking' => false,
                'is_host' => false,
                'is_me' => true,
                'mic_on' => false, // User's mic starts muted
            ];
        }
        
        $names = [
            'Aarav', 'Vihaan', 'Aditya', 'Sai', 'Arjun', 'Reyansh', 'Muhammad', 'Aryan', 'Krishna', 'Ishaan',
            'Saanvi', 'Anya', 'Kiara', 'Diya', 'Pari', 'Ananya', 'Myra', 'Aadhya', 'Fatima', 'Zoya',
            'Rahul', 'Priya', 'Anjali', 'Vikram', 'Sneha', 'Kavya', 'Rohan', 'Meera', 'Nisha', 'Karan',
            'Pooja', 'Varun', 'Simran', 'Amit', 'Neha', 'Raj', 'Sonia', 'Vivek', 'Riya', 'Suresh'
        ];
        
        for ($i = 0; $i < $count; $i++) {
            $name = $names[$i % count($names)] . ($i >= count($names) ? ' ' . floor($i / count($names)) : '');
            $micOn = rand(0, 10) > 3; // 60% have mic on
            $isSpeaking = $micOn && rand(0, 10) > 6; // Only speak if mic is on, 30% chance
            
            $participants[] = [
                'name' => $name,
                'avatar' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . $name,
                'initials' => null,
                'is_speaking' => $isSpeaking,
                'is_host' => false,
                'is_me' => false,
                'mic_on' => $micOn,
            ];
        }

        // Explicitly add Host
        $hostExists = false;
        foreach ($participants as $p) {
            if ($p['name'] === $room->host_name) {
                $hostExists = true;
                break;
            }
        }

        if (!$hostExists) {
            $participants[] = [
                'name' => $room->host_name,
                'avatar' => $room->host_avatar,
                'initials' => substr($room->host_name, 0, 2),
                'is_speaking' => true, // Host usually speaks
                'is_host' => true,
                'is_me' => false,
                'mic_on' => true, // Host has mic on
            ];
        } else {
            // Mark existing host correctly
            foreach ($participants as &$p) {
                if ($p['name'] === $room->host_name) {
                    $p['is_host'] = true;
                    $p['avatar'] = $room->host_avatar;
                    $p['mic_on'] = true; // Host has mic on
                }
            }
        }

        // Sort participants: Host first, then Me, then others
        usort($participants, function ($a, $b) {
            if ($a['is_host']) return -1;
            if ($b['is_host']) return 1;
            if ($a['is_me']) return -1;
            if ($b['is_me']) return 1;
            return 0;
        });

        return view('rooms.show', compact('room', 'participants', 'gifts'));
    }
}
