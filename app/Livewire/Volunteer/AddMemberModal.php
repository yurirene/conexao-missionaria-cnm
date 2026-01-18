<?php

namespace App\Livewire\Volunteer;

use App\Models\VolunteerTeam;
use App\UseCases\Volunteer\AddTeamMemberUseCase;
use App\UseCases\Volunteer\UploadMemberDocumentsUseCase;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class AddMemberModal extends Component
{
    use WithFileUploads;

    public bool $show = false;

    public string $name = '';
    public ?string $phone = null;
    public ?string $church = null;
    public ?string $pastor_name = null;
    public ?string $pastor_phone = null;
    public ?string $role = null;
    public ?string $description = null;
    public ?string $specialty = null;

    public $pastoral_authorization = null;
    public $criminal_background = null;
    public $terms = null;
    public $lgpd = null;

    private const FILE_RULE = 'nullable|file|mimetypes:application/pdf,image/jpeg,image/png,image/jpg|max:5120';

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'church' => 'nullable|string|max:255',
            'pastor_name' => 'nullable|string|max:255',
            'pastor_phone' => 'nullable|string|max:20',
            'role' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'specialty' => 'nullable|string|max:255',
            'pastoral_authorization' => self::FILE_RULE,
            'criminal_background' => self::FILE_RULE,
            'terms' => self::FILE_RULE,
            'lgpd' => self::FILE_RULE,
        ];
    }

    public function open(): void
    {
        $this->show = true;
        $this->resetForm();
    }

    public function close(): void
    {
        $this->show = false;
        $this->resetForm();
    }

    public function resetForm(): void
    {
        $this->name = '';
        $this->phone = null;
        $this->church = null;
        $this->pastor_name = null;
        $this->pastor_phone = null;
        $this->role = null;
        $this->description = null;
        $this->specialty = null;
        $this->reset('pastoral_authorization', 'criminal_background', 'terms', 'lgpd');
        $this->resetValidation();
    }

    public function save(AddTeamMemberUseCase $addMemberUseCase, UploadMemberDocumentsUseCase $uploadUseCase): void
    {
        $this->validate();

        $team = $this->getTeam();
        if (!$team) {
            $this->addError('name', 'Equipe não encontrada.');
            return;
        }

        $member = $addMemberUseCase->execute($team, [
            'name' => $this->name,
            'phone' => $this->phone ?: null,
            'church' => $this->church ?: null,
            'pastor_name' => $this->pastor_name ?: null,
            'pastor_phone' => $this->pastor_phone ?: null,
            'role' => $this->role ?: null,
            'description' => $this->description ?: null,
            'specialty' => $this->specialty ?: null,
        ]);

        $files = $this->collectDocumentFiles();
        if (!empty($files)) {
            $uploadUseCase->execute($member, $files);
        }

        $this->close();
        $this->dispatch('member-added')->to(\App\Livewire\Volunteer\Dashboard::class);
        session()->flash('message', 'Membro adicionado com sucesso!');
    }

    protected function collectDocumentFiles(): array
    {
        $files = [];
        if ($this->pastoral_authorization) {
            $files['pastoral_authorization'] = $this->pastoral_authorization;
        }
        if ($this->criminal_background) {
            $files['criminal_background'] = $this->criminal_background;
        }
        if ($this->terms) {
            $files['terms'] = $this->terms;
        }
        if ($this->lgpd) {
            $files['lgpd'] = $this->lgpd;
        }
        return $files;
    }

    #[On('openAddMemberModal')]
    public function handleOpenModal(): void
    {
        $this->open();
    }

    protected function getTeam(): ?VolunteerTeam
    {
        return auth()->user()->volunteerTeam;
    }

    public function render()
    {
        return view('livewire.volunteer.add-member-modal');
    }
}
