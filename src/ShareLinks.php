<?php namespace xes;
class Share {
	private static $links = [
		'facebook' => '//facebook.com/sharer/sharer.php?u={{link}}',
		'twitter' => '//twitter.com/home?status={{link}}',
		'google-plus' => '//plus.google.com/share?url={{link}}',
		'pinterest' => '//pinterest.com/pin/create/button/?url={{link}}&media={{image}}'
	];

	public static function URL($network, $link, $image = null) {
		if (!array_key_exists($network, self::$links)) {
			throw new \Exception("$network is not supported");
		}
		$template = self::$links[$network];

		if ($image) {
			$template = str_replace('{{image}}', urlencode($image), $template);
		}

		return str_replace('{{link}}', urlencode($link), $template);
	}

	public static function button($network, $link, $image = null) {
		return self::URL($network, $link, $image);
	}
}
?>
