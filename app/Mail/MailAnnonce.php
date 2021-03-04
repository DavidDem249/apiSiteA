<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailAnnonce extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        return $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    // ->attach('/path/to/file', [
    //     'as' => 'name.pdf',
    //     'mime' => 'application/pdf',
    // ])
    
    public function build()
    {
        return $this->from("david.kouakou@agilestelecoms.com")
                ->subject('AGILES TELECOMS - PUBLICATION')
                ->view('emails.annonce_mail');
    }
}
