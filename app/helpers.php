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
 * @param \App\Flyer $flyer
 * @return string
 */
function add_photo_path(App\Flyer $flyer)
{
    return route('store_photo_path', [$flyer->zip, $flyer->street]);
}

/**
 * The path to a given flyer.
 *
 * @param App\Flyer $flyer
 * @return string
 */
function flyer_path (App\Flyer $flyer)
{
    return $flyer->zip . '/' . str_replace(' ', '-', $flyer->street);
}
