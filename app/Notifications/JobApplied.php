<?php

namespace Boaz\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Boaz\User;
use Auth;
use Boaz\JobsApplications;
use Boaz\Job;

class JobApplied extends Notification
{
    use Queueable;
    public $fromUser;
    public $jobapply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
   
    public function __construct($jobapply)
    {
        $this->jobapply = $jobapply;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = sprintf('This is a nortification from!'.settings('app_name'). 'to notify you that you have applied a Job on our Recruitment System');
      
 
        return (new MailMessage)
                    ->subject($subject)
                    ->line('Hello,'.Auth::user()->username)
                    ->salutation('Yours Faithfully')
                    ->line('Thank you for applying to the '. $this->jobapply.' position at ' . settings('app_name'))
                    ->line('Your application has successfully been sent to our hiring team.')
                    ->line('If you are among the shortlisted candidates, you will receive a call or email from the hiring team to schedule an interview.')
                    ->line('If you don\'t hear from the hiring team within 3 weeks please consider your application unsuccessful.')
                    ->line('Thank you again for showing interest and taking the time to apply to this role.')
                    ->line('Best of luck!');
    }
    


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
