<?php

namespace App\Livewire\Missionary;

use App\Models\MissionaryField;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    public $field;

    public function mount()
    {
        $this->field = auth()->user()->missionaryField;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.missionary.dashboard');
    }
}
