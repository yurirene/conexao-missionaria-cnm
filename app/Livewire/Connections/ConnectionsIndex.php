<?php

namespace App\Livewire\Connections;

use App\Enums\ConnectionStatus;
use App\Models\Connection;
use App\UseCases\Shared\AcceptConnectionUseCase;
use App\UseCases\Shared\RejectConnectionUseCase;
use App\UseCases\Shared\ConfirmConnectionUseCase;
use App\UseCases\Shared\CompleteConnectionUseCase;
use App\UseCases\Shared\CancelConnectionUseCase;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class ConnectionsIndex extends Component
{
    use WithPagination;

    public $filterStatus = '';
    public $filterType = ''; // 'sent' ou 'received'

    protected $queryString = [
        'filterStatus' => ['except' => ''],
        'filterType' => ['except' => ''],
    ];

    public function mount()
    {
        // Verificar se é missionário ou voluntário
        $user = auth()->user();
        if (!$user->isMissionary() && !$user->isVolunteer()) {
            return redirect()->route('dashboard');
        }
    }

    public function getConnectionsProperty()
    {
        $user = auth()->user();
        $query = Connection::query()
            ->with(['missionaryField.user', 'volunteerTeam.user', 'season']);

        if ($user->isMissionary()) {
            $field = $user->missionaryField;
            if ($field) {
                $query->where('missionary_field_id', $field->id);
            } else {
                return collect([])->paginate(15);
            }
        } elseif ($user->isVolunteer()) {
            $team = $user->volunteerTeam;
            if ($team) {
                $query->where('volunteer_team_id', $team->id);
            } else {
                return collect([])->paginate(15);
            }
        }

        // Filtro por status
        if ($this->filterStatus) {
            $query->where('status', ConnectionStatus::from($this->filterStatus));
        }

        // Filtro por tipo (enviadas ou recebidas)
        if ($this->filterType === 'sent') {
            $query->where('initiator_type', $user->isMissionary() ? 'missionary' : 'volunteer');
        } elseif ($this->filterType === 'received') {
            $query->where('initiator_type', $user->isMissionary() ? 'volunteer' : 'missionary');
        }

        return $query->orderBy('created_at', 'desc')->paginate(15);
    }

    public function acceptConnection(string $connectionId, AcceptConnectionUseCase $acceptUseCase): void
    {
        $connection = $this->getConnectionForUser($connectionId);
        if (!$connection) {
            session()->flash('error', 'Conexão não encontrada.');
            return;
        }

        try {
            $acceptUseCase->execute($connection);
            session()->flash('message', 'Conexão aceita com sucesso!');
            $this->resetPage();
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function rejectConnection(string $connectionId, RejectConnectionUseCase $rejectUseCase): void
    {
        $connection = $this->getConnectionForUser($connectionId);
        if (!$connection) {
            session()->flash('error', 'Conexão não encontrada.');
            return;
        }

        try {
            $rejectUseCase->execute($connection);
            session()->flash('message', 'Conexão rejeitada.');
            $this->resetPage();
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function confirmConnection(string $connectionId, ConfirmConnectionUseCase $confirmUseCase): void
    {
        $connection = $this->getConnectionForUser($connectionId);
        if (!$connection) {
            session()->flash('error', 'Conexão não encontrada.');
            return;
        }

        try {
            $confirmUseCase->execute($connection);
            session()->flash('message', 'Conexão confirmada! A missão está agendada.');
            $this->resetPage();
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function completeConnection(string $connectionId, CompleteConnectionUseCase $completeUseCase): void
    {
        $connection = $this->getConnectionForUser($connectionId);
        if (!$connection) {
            session()->flash('error', 'Conexão não encontrada.');
            return;
        }

        try {
            $completeUseCase->execute($connection);
            session()->flash('message', 'Conexão marcada como concluída! Campo e equipe estão disponíveis para nova missão.');
            $this->resetPage();
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function cancelConnection(string $connectionId, CancelConnectionUseCase $cancelUseCase): void
    {
        $connection = $this->getConnectionForUser($connectionId);
        if (!$connection) {
            session()->flash('error', 'Conexão não encontrada.');
            return;
        }

        try {
            $cancelUseCase->execute($connection);
            session()->flash('message', 'Conexão cancelada. Campo e equipe estão disponíveis para novas conexões.');
            $this->resetPage();
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    protected function getConnectionForUser(string $connectionId): ?Connection
    {
        $user = auth()->user();
        $query = Connection::query();

        if ($user->isMissionary()) {
            $field = $user->missionaryField;
            if ($field) {
                $query->where('missionary_field_id', $field->id);
            } else {
                return null;
            }
        } elseif ($user->isVolunteer()) {
            $team = $user->volunteerTeam;
            if ($team) {
                $query->where('volunteer_team_id', $team->id);
            } else {
                return null;
            }
        } else {
            return null;
        }

        return $query->find($connectionId);
    }

    public function clearFilters(): void
    {
        $this->filterStatus = '';
        $this->filterType = '';
        $this->resetPage();
    }

    public function getStatusOptionsProperty()
    {
        return ConnectionStatus::cases();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.connections.connections-index', [
            'connections' => $this->connections,
        ]);
    }
}
