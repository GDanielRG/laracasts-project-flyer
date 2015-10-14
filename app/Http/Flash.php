<?php namespace App\Http;

class Flash {

    /**
     * Create a flash message.
     *
     * @param $title
     * @param $message
     * @param $level
     * @param string $key
     * @return void
     */
    public function create($title, $message, $level, $key = 'flash_message')
    {
        session()->flash($key, [
            'title'   => $title,
            'message' => $message,
            'level'   => $level
        ]);
    }

    /**
     * Create an information flash message.
     *
     * @param $title
     * @param $message
     * @return void
     */
    public function info($title, $message)
    {
        return $this->create($title, $message, 'info');
    }

    /**
     * Create a success flash message.
     *
     * @param $title
     * @param $message
     * @return void
     */
    public function success($title, $message)
    {
        return $this->create($title, $message, 'success');
    }

    /**
     * Create a warning flash message.
     *
     * @param $title
     * @param $message
     * @return void
     */
    public function warning($title, $message)
    {
        return $this->create($title, $message, 'warning');
    }

    /**
     * Create an error flash message.
     *
     * @param $title
     * @param $message
     * @return void
     */
    public function error($title, $message)
    {
        return $this->create($title, $message, 'error');
    }

    /**
     * Create an overlay flash message.
     *
     * @param $title
     * @param $message
     * @return void
     */
    public function overlay($title, $message, $level = 'success')
    {
        return $this->create($title, $message, $level, 'flash_message_overlay');
    }

}