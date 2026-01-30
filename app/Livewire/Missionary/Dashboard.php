<?php

namespace App\Livewire\Missionary;

use App\Models\MissionaryField;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

class Dashboard extends Component
{
    public $field;

    protected $listeners = [
        'field-created' => 'loadField',
    ];

    public function mount()
    {
        $this->loadField();
    }

    public function loadField()
    {
        $this->field = auth()->user()->fresh()->missionaryField;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.missionary.dashboard');
    }
}
