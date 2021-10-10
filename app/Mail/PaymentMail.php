<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $profile;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->profile=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Payment Status";
        return $this->attachData(Storage::get($this->profile->profile->picture), 'picture.jpeg', ['mime' => 'image/jpeg'])->subject($subject)->view('email.payment');
    }
}
