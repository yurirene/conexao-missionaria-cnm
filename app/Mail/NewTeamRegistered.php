<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewTeamRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $teamOwner
    ) {}

    public function build()
    {
        return $this->subject('Nova Equipe de Voluntários Cadastrada')
            ->view('emails.new-team-registered');
    }
}
