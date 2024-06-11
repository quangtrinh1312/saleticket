<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Livewire\WithPagination;
use App\Filters\AccountFilter;

class AccountList extends Component
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

    public function getAccountList() {
        $accountFilter = new AccountFilter();

        $accountList = User::filter($accountFilter, $this->params)->paginate($this->paginate);

        return $accountList;
    }

    public function search($params) {
        $this->params = $params;
    } 

    public function render()
    {
        $accounts = $this->getAccountList();

        return view('admins.accounts.livewire.account-list')->with([
            'accounts' => $accounts,
        ]);
    }
}
