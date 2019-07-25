<?php

namespace Boaz\Providers;

use Boaz\Events\User\Banned;
use Boaz\Events\User\LoggedIn;
use Boaz\Events\User\Registered;
use Boaz\Listeners\Users\InvalidateSessionsAndTokens;
use Boaz\Listeners\Login\UpdateLastLoginTimestamp;
use Boaz\Listeners\PermissionEventsSubscriber;
use Boaz\Listeners\Registration\SendConfirmationEmail;
use Boaz\Listeners\Registration\SendSignUpNotification;
use Boaz\Listeners\RoleEventsSubscriber;
use Boaz\Listeners\UserEventsSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendConfirmationEmail::class,
            SendSignUpNotification::class,
        ],
        LoggedIn::class => [
            UpdateLastLoginTimestamp::class
        ],
        Banned::class => [
            InvalidateSessionsAndTokens::class
        ]
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        UserEventsSubscriber::class,
        RoleEventsSubscriber::class,
        PermissionEventsSubscriber::class
    ];

    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
