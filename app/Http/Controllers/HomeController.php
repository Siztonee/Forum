<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Message;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('homeStats', 60, function () {
            return [
                'usersTotal' => User::count(),
                'topicsCount' => Topic::count(),
                'messagesCount' => Message::count(),
            ];
        });

        $lastCategory = Category::latest()
            ->withCount(['topics', 'topics as messages_count' => fn($query) => $query->withCount('messages')])
            ->first();

        $lastMessage = Message::latest()->first();
        $lastTopic = Topic::latest()->withCount('messages')->first();

        return view('home', [
            'usersTotal' => $stats['usersTotal'],
            'topicsCount' => $stats['topicsCount'],
            'messagesCount' => $stats['messagesCount'],
            'lastCategory' => $lastCategory,
            'lastMessage' => $lastMessage,
            'lastTopic' => $lastTopic,
        ]);
    }
}

