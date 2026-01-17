<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewFieldRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $fieldOwner
    ) {}

    public function build()
    {
        return $this->subject('Novo Campo Missionário Cadastrado')
            ->view('emails.new-field-registered');
    }
}
