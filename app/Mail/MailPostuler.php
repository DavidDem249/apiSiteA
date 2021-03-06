<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailPostuler extends Mailable
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
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("david.kouakou@agilestelecoms.com")
                ->subject('AGILES TELECOMS - UN NOUVEAU POSTULANT')
                ->view('emails.postuler')
                ->attach(public_path('postuler/cv/PRESENTATION-AGILES-TELECOMS-FINALE.pdf'), [
                     'as' => 'sample.pdf',
                     'mime' => 'application/pdf',
                ]);
    }
}
