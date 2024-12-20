<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService 
{
    public function createNotification(
        $sender_id = null, 
        $receiver_id, 
        $type, 
        $topicName = null, 
        $message = null, 
        $reaction = null
    ) {
        $message = $this->createNotificationMessage($type, $topicName, $message, $reaction);

        Notification::create([
            'sender_id' => $sender_id ?? auth()->id(),
            'receiver_id' => $receiver_id, 
            'type' => $type,
            'message' => $message,
        ]);
    }

    public function createNotificationMessage($type, $topicName = null, $message = null, $reaction = null)
    {
        $username = auth()->user()->username;

        switch ($type) {
            case 'reaction':
                return "Пользователь {$username} отреагировал {$reaction} на ваше сообщение в теме: {$topicName}.";
            
            case 'reply':
                return "Пользователь {$username} ответил в теме: {$topicName}";

            case 'mention':
                return "Пользователь {$username} упомянул вас в теме: {$topicName}.";

            case 'system':
                return $message;

            default:
                return "Уведомление неизвестного типа.";
        }
    }
}
