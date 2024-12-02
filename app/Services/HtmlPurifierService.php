<?php

namespace App\Services;

use HTMLPurifier;
use HTMLPurifier_Config;

class HtmlPurifierService
{
    public function purify(string $content): string
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 'p,b,strong,i,em,u,a[href|title],ul,ol,li,br,img[src|alt|width|height]');
        $config->set('CSS.AllowedProperties', 'font,font-size,font-weight,text-decoration,color,background-color');
        $config->set('URI.AllowedSchemes', ['http' => true, 'https' => true]);
        $purifier = new HTMLPurifier($config);

        return $purifier->purify($content);
    }
}