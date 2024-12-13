<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    public function index($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Данный пользователь не найден!');
        }

        $stats = Cache::remember("profileStats_{$user->id}", 60, function () use ($user) {
            return [
                'messagesCount' => Message::where('sender_id', $user->id)->count(),
                'topicsCount' => Topic::where('creator_id', $user->id)->count(),
            ];
        });

        $lastMessage = Message::where('sender_id', $user->id)
            ->latest()
            ->first();

        return view('profile', [
            'user' => $user,
            'stats' => $stats,
            'lastMessage' => $lastMessage,
        ]);
    }
}
