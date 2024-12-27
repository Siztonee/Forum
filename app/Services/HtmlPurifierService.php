<?php

namespace App\Services;

use HTMLPurifier;
use HTMLPurifier_Config;

class HtmlPurifierService
{
    public function purify(string $content): string
    {
        $config = HTMLPurifier_Config::createDefault();

        $config->set('HTML.Allowed', 'p,b,strong,i,em,u,a[href|title|class],ul,ol,li,br,img[src|alt|width|height],span[class]');
        $config->set('Attr.AllowedClasses', null);
        $config->set('CSS.AllowedProperties', 'color,background-color');
        $config->set('URI.AllowedSchemes', ['http' => true, 'https' => true]);
        $config->set('Core.EscapeInvalidTags', true);

        $purifier = new HTMLPurifier($config);

        return $purifier->purify($content);
    }
}
