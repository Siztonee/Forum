<?php

namespace App\Services;

use Illuminate\Support\Str;

class StoreImageService
{
    public function storeBase64Images(string $content): string
    {
        preg_match_all('/<img[^>]+src="data:image\/([^;]+);base64,([^"]+)"/', $content, $matches, PREG_SET_ORDER);

        if (!$matches) {
            return $content; 
        }

        foreach ($matches as $match) {
            $extension = $match[1];
            $data = base64_decode($match[2]); 
            $fileName = Str::uuid() . '.' . $extension;
            $path = storage_path('app/public/uploads/' . $fileName);

            file_put_contents($path, $data);

            $newSrc = '/storage/uploads/' . $fileName;

            $newImageTag = str_replace(
                $match[0], 
                preg_replace('/src="[^"]+"/', 'src="' . $newSrc . '"', $match[0]),
                $content
            );

            $content = $newImageTag;
        }

        return $content;
    }

}