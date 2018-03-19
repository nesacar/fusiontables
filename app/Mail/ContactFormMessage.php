<?php

namespace App\Mail;

use App\Message;
use App\Theme;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactFormMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $theme;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Theme $theme, Message $message)
    {
        $this->theme = $theme;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('themes.ft.emails.contact-form')
            ->subject('Poruka sa sajta fusiontables.rs')
            ->from(['address' => 'office@fusiontables.rs', 'name' => 'fusiontables.rs']);
    }
}
