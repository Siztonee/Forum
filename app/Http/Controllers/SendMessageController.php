<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Services\StoreImageService;
use App\Http\Controllers\Controller;
use App\Services\HtmlPurifierService;
use App\Services\NotificationService;
use App\Services\HandleMentionsService;
use App\Http\Requests\SendMessageRequest;

class SendMessageController extends Controller
{
    protected NotificationService $notificationService;
    protected StoreImageService $imageService;
    protected HtmlPurifierService $htmlPurifierService;
    protected HandleMentionsService $handleMentionsService;

    public function __construct(
        NotificationService $notificationService, 
        StoreImageService $imageService, 
        HtmlPurifierService $htmlPurifierService,
        HandleMentionsService $handleMentionsService
    ) {
        $this->notificationService = $notificationService;
        $this->imageService = $imageService;
        $this->htmlPurifierService = $htmlPurifierService; 
        $this->handleMentionsService = $handleMentionsService;
    }

    public function __invoke(SendMessageRequest $request) 
    {
        $contentWithStoredImages = $this->imageService->storeBase64Images($request->input('message'));
        $contentWithMentions = $this->handleMentionsService->handle($contentWithStoredImages);
        $cleanContent = $this->htmlPurifierService->purify($contentWithMentions);
        
        $receiverId = null;
        if ($request->input('receiver_username')) {
            $receiver = User::where('username', $request->input('receiver_username'))->first();
            $receiverId = $receiver ? $receiver->id : null;
        }

        Message::create([
            'sender_id' => auth()->id(),
            'topic_id' => $request->topic_id,
            'receiver_id' => $receiverId, 
            'message' => $cleanContent,
        ]);

        $topic = Topic::findOrFail($request->topic_id);
        $notificationReceiverId = $receiverId ?? $topic->creator->id;

        $this->notificationService->createNotification(
            sender_id: auth()->id(),
            receiver_id: $notificationReceiverId,
            type: 'reply',
            topicName: $topic->name
        );

        return redirect()->route('category.topic', [$request->category_slug, $request->topic_slug])
            ->with('info', 'Сообщение отправлено.');
    }
}
