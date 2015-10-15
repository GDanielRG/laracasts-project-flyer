<?php

/**
 * Flash message handler.
 *
 * @param null $title
 * @param null $message
 * @return \Illuminate\Foundation\Application|mixed
 */
function flash($title = null, $message = null)
{
    $flash = app('App\Http\Flash');

    if (func_num_args() == 0) {
        return $flash;
    }

    return $flash->info($title, $message);
}

/**
 * Form action path for adding photos.
 *
 * @param $flyer
 * @return string
 */
function add_photo_path($flyer)
{
    return route('store_photo_path', [$flyer->zip, $flyer->street]);
}