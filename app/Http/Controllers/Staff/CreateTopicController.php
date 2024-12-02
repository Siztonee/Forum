<?php

namespace App\Http\Controllers\Staff;

use HTMLPurifier;
use App\Models\Topic;
use App\Models\Message;
use App\Models\Category;
use HTMLPurifier_Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\StoreImageService;
use App\Http\Controllers\Controller;
use App\Services\HtmlPurifierService;
use App\Http\Requests\StoreTopicRequest;

class CreateTopicController extends Controller
{

    public function index($slug)
    {
        $category = Category::where('slug', $slug)->first();
        
        return view('staff.create-topic', compact('category'));
    }

    public function store(StoreTopicRequest $request, StoreImageService $imageService, HtmlPurifierService $htmlPurifierService)
    {
        $contentWithStoredImages = $imageService->storeBase64Images($request->input('message'));
        $cleanContent = $htmlPurifierService->purify($contentWithStoredImages);

        $topic = Topic::create([
            'creator_id' => auth()->id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Topic::createUniqueSlug($request->name),
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'topic_id' => $topic->id,
            'message' => $cleanContent,
        ]);

        return redirect()->route('category.topics', $request->category_slug)
            ->with('info', 'Тема успешно создана!');
        
    }

}
