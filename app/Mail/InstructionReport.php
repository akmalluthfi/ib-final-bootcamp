<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InstructionReport extends Mailable
{
    use Queueable, SerializesModels;

    protected $pathAttachment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pathAttachment)
    {
        $this->pathAttachment = $pathAttachment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('team2@inosoftweb.com', 'Team 2')
            ->markdown('mail.index', [
                'url' => env('APP_URL') . '/api/reports/pdf/{instruction}'
            ])
            ->attachFromStorage($this->pathAttachment);
    }
}
