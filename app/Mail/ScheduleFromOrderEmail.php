<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FromScheduleOrderEmail extends Mailable
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
        return $this->from('trantuanhop9678@gmail.com')
            ->subject('Thông báo phản hồi khách hàng')
            ->view('mail.schedule-mail', ['details' => $details]);

    }

}
