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

        $lastCategories = Category::latest()
            ->take(5) 
            ->get();  

        $lastTopics = Topic::latest()
            ->take(5)
            ->get();

        return view('home', [
            'stats' => $stats,
            'lastCategories' => $lastCategories,
            'lastTopics' => $lastTopics,
        ]);
    }
}

