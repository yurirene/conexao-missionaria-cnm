<?php

namespace App\Livewire\Missionary;

use App\Models\MissionaryField;
use App\Models\Season;
use App\UseCases\Missionary\DeleteSeasonUseCase;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

class SeasonsIndex extends Component
{
    public $field;
    public $seasons = [];

    protected $listeners = [
        'season-created' => 'loadSeasons',
        'season-updated' => 'loadSeasons',
        'season-deleted' => 'loadSeasons',
    ];

    public function mount()
    {
        $this->loadField();
        $this->loadSeasons();
    }

    public function loadField()
    {
        $this->field = auth()->user()->fresh()->missionaryField;

        if (!$this->field) {
            return redirect()->route('missionary.field.create');
        }
    }

    public function loadSeasons()
    {
        if ($this->field) {
            $this->seasons = $this->field->seasons()->orderBy('start_date', 'desc')->get();
        }
    }

    public function openAddSeasonModal(): void
    {
        $this->dispatch('openAddSeasonModal')->to(SeasonFormModal::class);
    }

    public function openEditSeasonModal(string $seasonId): void
    {
        $this->dispatch('openEditSeasonModal', $seasonId)->to(SeasonFormModal::class);
    }

    public function deleteSeason(string $seasonId, DeleteSeasonUseCase $deleteUseCase): void
    {
        $season = $this->getSeasonForUser($seasonId);
        if (!$season) {
            session()->flash('message', 'Temporada não encontrada.');
            return;
        }

        $deleteUseCase->execute($season);

        $this->dispatch('season-deleted');
        session()->flash('message', 'Temporada excluída com sucesso!');
    }

    protected function getSeasonForUser(string $seasonId): ?Season
    {
        if (!$this->field) {
            return null;
        }

        return $this->field->seasons()->find($seasonId);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.missionary.seasons-index');
    }
}
