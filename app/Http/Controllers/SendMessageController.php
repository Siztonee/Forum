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
    public function __invoke(
        SendMessageRequest $request, 
        NotificationService $notificationService, 
        StoreImageService $imageService, 
        HtmlPurifierService $htmlPurifierService,
        HandleMentionsService $handleMentionsService
    ) {
        $contentWithStoredImages = $imageService->storeBase64Images($request->input('message'));
        [$contentWithMentions, $mentionedUserIds] = $handleMentionsService->handle($contentWithStoredImages);
        $cleanContent = $htmlPurifierService->purify($contentWithMentions);

        $receiver = User::where('username', $request->input('receiver_username'))->first();
        $receiverId = $receiver?->id;

        Message::create([
            'sender_id' => auth()->id(),
            'topic_id' => $request->topic_id,
            'receiver_id' => $receiverId, 
            'message' => $cleanContent,
        ]);

        $topic = Topic::findOrFail($request->topic_id);

        $notificationReceiverIds = [];

        if ($receiverId && $receiverId !== auth()->id()) { 
            $notificationReceiverIds[] = $receiverId;
        } elseif ($topic->creator->id !== auth()->id()) {
            $notificationReceiverIds[] = $topic->creator->id;
        }

        foreach (array_unique($notificationReceiverIds) as $receiverId) {
            $notificationService->createNotification(
                sender_id: auth()->id(),
                receiver_id: $receiverId,
                type: 'reply',
                topicName: $topic->name
            );
        }

        foreach ($mentionedUserIds as $mentionedUserId) {
            if ($mentionedUserId !== auth()->id() && 
                !in_array($mentionedUserId, $notificationReceiverIds)) {
                $notificationReceiverIds[] = $mentionedUserId;
                $notificationService->createNotification(
                    sender_id: auth()->id(),
                    receiver_id: $mentionedUserId,
                    type: 'mention',
                    topicName: $topic->name
                );
            }
        }

        return redirect()->route('category.topic', [$request->category_slug, $request->topic_slug])
            ->with('info', 'Сообщение отправлено.');
    }
}