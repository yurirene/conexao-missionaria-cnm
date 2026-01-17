<?php

namespace App\Services;

use App\Models\Connection;

class WhatsAppNotificationService
{
    public function sendConnectionAcceptedNotification(Connection $connection): void
    {
        // Implementação inicial: gerar link API WhatsApp
        // Pode ser integrado com API do WhatsApp Business no futuro

        if ($connection->initiator_type === 'missionary') {
            // Missionário aceitou: enviar para equipe
            $team = $connection->volunteerTeam;
            $field = $connection->missionaryField;
            
            if ($team && $field) {
                $phone = $team->user->phone ?? $team->responsible_officer;
                $message = "Sua equipe foi aceita pelo campo {$field->name}. Contato: {$field->phone}";
                $this->generateWhatsAppLink($phone, $message);
            }
        } else {
            // Equipe aceitou: enviar para campo
            $team = $connection->volunteerTeam;
            $field = $connection->missionaryField;
            
            if ($team && $field) {
                $phone = $field->phone ?? $field->user->email;
                $message = "Sua solicitação foi aceita pela equipe {$team->church_name}. Contato: {$team->responsible_officer}";
                $this->generateWhatsAppLink($phone, $message);
            }
        }
    }

    private function generateWhatsAppLink(string $phone, string $message): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        $message = urlencode($message);
        
        return "https://wa.me/{$phone}?text={$message}";
    }
}
