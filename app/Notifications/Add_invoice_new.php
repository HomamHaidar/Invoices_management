<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\invoices;
use Illuminate\Support\Facades\Auth;

class Add_invoice_new extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $invoice_id_notify;

    public function __construct(invoices $invoice_id_notify)
    {
      $this->invoice_id_notify=$invoice_id_notify;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable)
    {
        return [
            'id' =>$this->invoice_id_notify->id,
            'title'=>' تم اضافة فاتورة جديدة بواسطة :',
            'user'=>Auth::user()->name,
            'invoice_num'=>$this->invoice_id_notify->invoice_number
        ];
    }
}
