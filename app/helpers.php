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
function flyer_path(App\Flyer $flyer)
{
    return $flyer->zip . '/' . str_replace(' ', '-', $flyer->street);
}

/**
 * Generate a HTML link.
 *
 * NOTE: Original function name in the Episode 19 is "link_to" but is renamed here,
 *       since function with that name now exists in the Illuminate/Html package.
 *
 * @param $body
 * @param $path
 * @param $type
 * @return string
 */
function link_to_html($body, $path, $type)
{
    $csrf = csrf_field();

    if (is_object($path)) {
        $action = '/' . $path->getTable();

        if (in_array($type, ['PUT', 'PATCH', 'DELETE'])) {
            $action .= '/' . $path->getKey();
        }
    } else {
        $action = $path;
    }

    return <<<EOT
        <form method="POST" action="{$action}">
            <input type='hidden' name='_method' value='{$type}'>
            $csrf
            <button type="submit">{$body}</button>

        </form>
EOT;

}
