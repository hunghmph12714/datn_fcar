<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FromOrderSuccessEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        $details = $this->details;
        return $this->from(config('mail.mailers.smtp.username'))
            ->subject('Thông báo đặt lịch thành công')
            ->view('mail.order-mail', ['details' => $details]);
    }
}
