<?php namespace xes;

class ShareLinks
{
    private static $links = [
    'facebook' => 'http://facebook.com/sharer/sharer.php?u={{link}}',
    'twitter' => 'http://twitter.com/home?status={{link}}',
    'google-plus' => 'http://plus.google.com/share?url={{link}}',
    'pinterest' => 'http://pinterest.com/pin/create/button/?url={{link}}&media={{image}}'
    ];

    public static function URL($network, $link, $image = null)
    {
        if (!array_key_exists($network, self::$links)) {
            throw new \Exception("$network is not supported");
        }

        if ($network == 'pinterest' && is_null($image)) {
            throw new \Exception("Network '$network' requires an image");
        }

        $template = self::$links[$network];

        if ($image) {
            $template = str_replace('{{image}}', urlencode($image), $template);
        }

        return str_replace('{{link}}', urlencode($link), $template);
    }
}
