<?php

namespace App\Listeners;

use App\Events\UserLoginSuccess;
use Illuminate\Support\Facades\Log;

class LoginLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle(UserLoginSuccess $event)
    {
        Log::channel('daily')->info('成功登录', $event->user->toArray());
    }
}
