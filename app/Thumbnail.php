<?php

namespace App;

use Image;

class Thumbnail
{
    /**
     * Make a photo thumbnail.
     *
     * @param string $src
     * @param string $destination
     */
    public function make($src, $destination)
    {
        Image::make($src)
            ->fit(200)
            ->save($destination);
    }

}
