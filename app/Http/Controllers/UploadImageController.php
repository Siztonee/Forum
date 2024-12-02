<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UploadImageController extends Controller
{
    public function __invoke(Request $request)
    {
        $content = $request->input('content');

        $dom = new \DOMDocument();
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        foreach ($dom->getElementsByTagName('img') as $img) {
            $src = $img->getAttribute('src');

            if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {
                $data = substr($src, strpos($src, ',') + 1);
                $data = base64_decode($data);

                $fileName = uniqid() . '.' . $type[1];
                $path = storage_path('app/public/uploads/' . $fileName);

                file_put_contents($path, $data);

                $img->setAttribute('src', asset('storage/uploads/' . $fileName));
            }
        }

        Message::create([
            'sender_id' => auth()->id(),
            'topic_id'
        ]);
        $dom->saveHTML();

        return response()->json(['success' => true]);
    }

}