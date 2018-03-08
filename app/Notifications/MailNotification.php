<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Collection;
use Auth;

class MailNotification extends Notification
{
    use Queueable;


    protected $subject;
    protected $content;
    protected $action;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subject, $content, $action = null)
    {

        $this->subject = $subject;
        $this->content = explode(PHP_EOL,$content);
        $this->action = $action;
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
        $mail = new MailMessage();

        $mail->subject($this->subject);
        $mail->salutation('Hälsningar ' . Auth::User()->name);
        $mail->greeting('Hejsan svejsan!');
        foreach($this->content as $row){
            $mail->line($row);
        }

        if($this->action){
            $mail->action('Klicka här för mer info', $this->action);
        }

        return $mail;

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
            'subject' => $this->subject,
            'content' => implode(PHP_EOL, $this->content),
            'action'  => $this->action
        ];
    }
}
