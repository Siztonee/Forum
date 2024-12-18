<?php
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Services\StoreImageService;
use App\Http\Controllers\Controller;
use App\Services\HtmlPurifierService;
use App\Http\Requests\SendMessageRequest;
use App\Models\User;

class SendMessageController extends Controller
{
    public function __invoke(SendMessageRequest $request, StoreImageService $imageService, HtmlPurifierService $htmlPurifierService)
    {
        $contentWithStoredImages = $imageService->storeBase64Images($request->input('message'));
        $cleanContent = $htmlPurifierService->purify($contentWithStoredImages);
        
        $receiverId = null;
        if ($request->input('receiver_username')) {
            $receiver = User::where('username', $request->input('receiver_username'))->first();
            $receiverId = $receiver ? $receiver->id : null;
        }

        $receiverId = $request->input('receiver_id', $receiverId);

        Message::create([
            'sender_id' => auth()->id(),
            'topic_id' => $request->topic_id,
            'receiver_id' => $receiverId, 
            'message' => $cleanContent,
        ]);

        return redirect()->route('category.topic', [$request->category_slug, $request->topic_slug])
            ->with('info', 'Сообщение отправлено.');
    }
}