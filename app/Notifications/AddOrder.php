<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddOrder extends Notification
{
    use Queueable;

    private $orders;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $orders)
    {
        $this->orders = $orders;
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
        $url = 'http://127.0.0.1:8000/InvoicesDetails/'. $this->orders;

        return (new MailMessage)
                    ->greeting('Hello!')
                    ->subject('Place an order')
                    ->line('Order Placed Successfully!')
                    ->action('Show Order', $url)
                    ->line('Thank You For Shopping at Khitan!');
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
