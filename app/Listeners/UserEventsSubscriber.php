<?php

namespace Boaz\Listeners;

use Boaz\Activity;
use Boaz\Events\Settings\Updated as SettingsUpdated;
use Boaz\Events\User\Banned;
use Boaz\Events\User\ChangedAvatar;
use Boaz\Events\User\Created;
use Boaz\Events\User\Deleted;
use Boaz\Events\User\LoggedIn;
use Boaz\Events\User\LoggedOut;
use Boaz\Events\User\Registered;
use Boaz\Events\User\RequestedPasswordResetEmail;
use Boaz\Events\User\ResetedPasswordViaEmail;
use Boaz\Events\User\TwoFactorDisabled;
use Boaz\Events\User\TwoFactorDisabledByAdmin;
use Boaz\Events\User\TwoFactorEnabled;
use Boaz\Events\User\TwoFactorEnabledByAdmin;
use Boaz\Events\User\UpdatedByAdmin;
use Boaz\Events\User\UpdatedProfileDetails;
use Boaz\Events\User\UserEventContract;
use Boaz\Services\Logging\UserActivity\Logger;

class UserEventsSubscriber
{
    /**
     * @var UserActivityLogger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function onLogin(LoggedIn $event)
    {
        $this->logger->log(trans('log.logged_in'));
    }

    public function onLogout(LoggedOut $event)
    {
        $this->logger->log(trans('log.logged_out'));
    }

    public function onRegister(Registered $event)
    {
        $this->logger->setUser($event->getRegisteredUser());
        $this->logger->log(trans('log.created_account'));
    }

    public function onAvatarChange(ChangedAvatar $event)
    {
        $this->logger->log(trans('log.updated_avatar'));
    }

    public function onProfileDetailsUpdate(UpdatedProfileDetails $event)
    {
        $this->logger->log(trans('log.updated_profile'));
    }

    public function onDelete(Deleted $event)
    {
        $message = trans(
            'log.deleted_user',
            ['name' => $event->getDeletedUser()->present()->nameOrEmail]
        );

        $this->logger->log($message);
    }

    public function onBan(Banned $event)
    {
        $message = trans(
            'log.banned_user',
            ['name' => $event->getBannedUser()->present()->nameOrEmail]
        );

        $this->logger->log($message);
    }

    public function onUpdateByAdmin(UpdatedByAdmin $event)
    {
        $message = trans(
            'log.updated_profile_details_for',
            ['name' => $event->getUpdatedUser()->present()->nameOrEmail]
        );

        $this->logger->log($message);
    }

    public function onCreate(Created $event)
    {
        $message = trans(
            'log.created_account_for',
            ['name' => $event->getCreatedUser()->present()->nameOrEmail]
        );

        $this->logger->log($message);
    }

    public function onSettingsUpdate(SettingsUpdated $event)
    {
        $this->logger->log(trans('log.updated_settings'));
    }

    public function onTwoFactorEnable(TwoFactorEnabled $event)
    {
        $this->logger->log(trans('log.enabled_2fa'));
    }

    public function onTwoFactorDisable(TwoFactorDisabled $event)
    {
        $this->logger->log(trans('log.disabled_2fa'));
    }

    public function onTwoFactorEnableByAdmin(TwoFactorEnabledByAdmin $event)
    {
        $message = trans(
            'log.enabled_2fa_for',
            ['name' => $event->getUser()->present()->nameOrEmail]
        );

        $this->logger->log($message);
    }

    public function onTwoFactorDisableByAdmin(TwoFactorDisabledByAdmin $event)
    {
        $message = trans(
            'log.disabled_2fa_for',
            ['name' => $event->getUser()->present()->nameOrEmail]
        );

        $this->logger->log($message);
    }

    public function onPasswordResetEmailRequest(RequestedPasswordResetEmail $event)
    {
        $this->logger->setUser($event->getUser());
        $this->logger->log(trans('log.requested_password_reset'));
    }

    public function onPasswordReset(ResetedPasswordViaEmail $event)
    {
        $this->logger->setUser($event->getUser());
        $this->logger->log(trans('log.reseted_password'));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'Boaz\Listeners\UserEventsSubscriber';

        $events->listen(LoggedIn::class, "{$class}@onLogin");
        $events->listen(LoggedOut::class, "{$class}@onLogout");
        $events->listen(Registered::class, "{$class}@onRegister");
        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(ChangedAvatar::class, "{$class}@onAvatarChange");
        $events->listen(UpdatedProfileDetails::class, "{$class}@onProfileDetailsUpdate");
        $events->listen(UpdatedByAdmin::class, "{$class}@onUpdateByAdmin");
        $events->listen(Deleted::class, "{$class}@onDelete");
        $events->listen(Banned::class, "{$class}@onBan");
        $events->listen(SettingsUpdated::class, "{$class}@onSettingsUpdate");
        $events->listen(TwoFactorEnabled::class, "{$class}@onTwoFactorEnable");
        $events->listen(TwoFactorDisabled::class, "{$class}@onTwoFactorDisable");
        $events->listen(TwoFactorEnabledByAdmin::class, "{$class}@onTwoFactorEnableByAdmin");
        $events->listen(TwoFactorDisabledByAdmin::class, "{$class}@onTwoFactorDisableByAdmin");
        $events->listen(RequestedPasswordResetEmail::class, "{$class}@onPasswordResetEmailRequest");
        $events->listen(ResetedPasswordViaEmail::class, "{$class}@onPasswordReset");
    }
}
