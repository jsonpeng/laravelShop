<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\OrderEvent' => [
            'App\Listeners\OrderEventListener',
        ],

        'App\Events\OrderPay' => [
            'App\Listeners\OrderPayListener',
        ],

        'Overtrue\LaravelWeChat\Events\WeChatUserAuthorized' => [
            'App\Listeners\WeChatUserAuthorizedListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
