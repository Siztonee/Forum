<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Message;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    public function index($c_slug, $t_slug)
    {
        try {
            $topic = Topic::with(['category', 'messages'])
                ->where('slug', $t_slug)
                ->firstOrFail();

            if (!session()->has("viewed_topics.{$topic->id}")) {
                $topic->increment('views');
                session()->put("viewed_topics.{$topic->id}", true);
            }

            $category = $topic->category;
            
            $allMessages = $topic->messages()->orderBy('created_at', 'ASC')->get();
            
            $authorMessage = $allMessages->first();
            
            $messages = $allMessages->slice(1);
            
            return view('topic', compact('topic', 'category', 'authorMessage', 'messages'));
        } catch (ModelNotFoundException $e) {
            abort(404, 'Topic or Category not found');
        }
    }
}
