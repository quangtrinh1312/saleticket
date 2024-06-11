<?php

namespace App\Http\Livewire\TicketType;

use Livewire\Component;

class TicketTypeSearch extends Component
{
    public $name, $price, $pattern, $serial;

    protected $updatesQueryString = [
        'name' => ['except' => ''],
        'price' => ['except' => '', 0],
        'pattern' => ['except' => ''],
        'serial' => ['except' => ''],
    ];

    public function mount() {
        $this->name = trim(request()->query('name'));
        $this->price = request()->query('price');
        $this->pattern = trim(request()->query('pattern'));
        $this->serial = trim(request()->query('serial'));
    }

    public function search() {
        $params = [
            'name' => trim($this->name),
            'post_vat_price' => preg_replace("/[^0-9]/", "", $this->price),
            'pattern' => trim($this->pattern),
            'serial' => trim($this->serial),
        ];

        $this->emitTo('ticket-type.ticket-type-list', 'search', $params);
    }

    public function render()
    {
        return view('admins.tickets.type.livewire.ticket-type-search');
    }
}
