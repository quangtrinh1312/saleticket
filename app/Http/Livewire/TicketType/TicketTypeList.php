<?php

namespace App\Http\Livewire\TicketType;

use Livewire\Component;
use App\Models\TicketType;
use Livewire\WithPagination;
use App\Filters\TicketTypeFilter;

class TicketTypeList extends Component
{
    use WithPagination;

    public $params = []; 
    public $paginate = 10;

    protected $listeners = [
        'refreshList' => '$refresh',
        'search',
    ];

    // public function mount() {
    //     $this->params = [
    //         'name' => trim(request()->query('name')),
    //         'price' => request()->query('price'),
    //         'pattern' => trim(request()->query('pattern')),
    //         'serial' => trim(request()->query('serial')),
    //     ];
    // }

    public function updatedPaginate() {
        $this->resetPage();
    }

    public function activateTicketType($id) {
        TicketType::find($id)->update(['is_actived' => true]);
    }

    public function disableTicketType($id) {
        TicketType::find($id)->update(['is_actived' => false]);
    }

    public function getTicketTypeList() {
        $ticketTypeFilter = new TicketTypeFilter();

        $ticketTypeList = TicketType::filter($ticketTypeFilter, $this->params)->paginate($this->paginate);

        return $ticketTypeList;
    }

    public function search($params) {
        $this->params = $params;
    } 

    public function render()
    {
        $ticketTypes = $this->getTicketTypeList();

        return view('admins.tickets.type.livewire.ticket-type-list')->with([
            'ticket_types' => $ticketTypes,
        ]);
    }
}
