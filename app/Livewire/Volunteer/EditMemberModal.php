<?php

namespace App\Livewire\Volunteer;

use App\Models\TeamMember;
use App\UseCases\Volunteer\UpdateTeamMemberUseCase;
use App\UseCases\Volunteer\UploadMemberDocumentsUseCase;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class EditMemberModal extends Component
{
    use WithFileUploads;

    public bool $show = false;

    public ?string $memberId = null;
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

    public array $existingFilePaths = [];

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

    public function open(string $memberId): void
    {
        $member = $this->getMemberForUser($memberId);
        if (!$member) {
            return;
        }

        $this->memberId = $member->id;
        $this->name = $member->name;
        $this->phone = $member->phone;
        $this->church = $member->church;
        $this->pastor_name = $member->pastor_name;
        $this->pastor_phone = $member->pastor_phone;
        $this->role = $member->role;
        $this->description = $member->description;
        $this->specialty = $member->specialty;
        $this->existingFilePaths = is_array($member->file_paths ?? null) ? $member->file_paths : [];
        $this->show = true;
        $this->resetValidation();
    }

    public function close(): void
    {
        $this->show = false;
        $this->memberId = null;
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
        $this->existingFilePaths = [];
        $this->reset('pastoral_authorization', 'criminal_background', 'terms', 'lgpd');
        $this->resetValidation();
    }

    public function save(UpdateTeamMemberUseCase $updateMemberUseCase, UploadMemberDocumentsUseCase $uploadUseCase): void
    {
        $this->validate();

        $member = $this->getMemberForUser($this->memberId);
        if (!$member) {
            $this->addError('name', 'Membro não encontrado.');
            return;
        }

        $updateMemberUseCase->execute($member, [
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
        $this->dispatch('member-updated')->to(\App\Livewire\Volunteer\Dashboard::class);
        session()->flash('message', 'Membro atualizado com sucesso!');
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

    #[On('openEditMemberModal')]
    public function handleOpenModal(string $memberId): void
    {
        $this->open($memberId);
    }

    protected function getMemberForUser(?string $memberId): ?TeamMember
    {
        if (!$memberId) {
            return null;
        }

        $team = auth()->user()->volunteerTeam;
        if (!$team) {
            return null;
        }

        return $team->members()->find($memberId);
    }

    public function render()
    {
        return view('livewire.volunteer.edit-member-modal');
    }
}
