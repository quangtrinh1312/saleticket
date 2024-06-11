<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class AccountSearch extends Component
{
    public $info, $role;

    protected $updatesQueryString = [
        'info' => ['except' => ''],
        'role' => ['except' => ''],
    ];

    public function mount() {
        $this->info = trim(request()->query('info'));
        $this->role = trim(request()->query('role'));
    }

    public function search() {
        $params = [
            'info' => trim($this->info),
            'role' => trim($this->role),
        ];

        $this->emitTo('account.account-list', 'search', $params);
    }

    public function render()
    {
        $roles = DB::table('roles')->get();
        return view('admins.accounts.livewire.account-search')->with(['roles' => $roles]);
    }
}
