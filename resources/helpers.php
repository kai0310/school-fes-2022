<?php

use Astrotomic\Twemoji\Twemoji;

if (! function_exists('twemoji')) {
    /**
     * Convert to twemoji
     */
    function twemoji(string $emoji): string
    {
        return Twemoji::emoji($emoji)->url();
    }
}
