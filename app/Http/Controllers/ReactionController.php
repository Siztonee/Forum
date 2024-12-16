<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message_id' => 'required|exists:messages,id',
            'reaction' => 'required|string|max:255',
        ]);

        Reaction::updateOrCreate(
            [
                'sender_id' => auth()->id(),
                'message_id' => $request->message_id,
            ],
            ['reaction' => $request->reaction]
        );

        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'message_id' => 'required|exists:messages,id',
        ]);

        Reaction::where('sender_id', auth()->id())
            ->where('message_id', $request->message_id)
            ->delete();

        return response()->json(['success' => true]);
    }
}
