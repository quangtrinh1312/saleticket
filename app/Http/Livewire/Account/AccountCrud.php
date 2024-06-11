<?php

namespace App\Http\Livewire\Account;

use App\Models\User;
use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AccountCrud extends Component
{
    public  $action,
            $account,
            $name,
            $username,
            $password,
            $role_id;

    public function rules() {
        $rules = [
            'name' => 'required',
            'username' => 'required',
            'role_id' => 'required',
        ];

        if ($this->action == 'create') {
            return array_merge($rules, ['password' => 'required']);
        } else {
            return $rules;
        }
    }

    public function messages() {
        return [
            'name.required' => 'Chưa nhập họ & tên',
            'username.required' => 'Chưa nhập tên đăng nhập',
            'password.required' => 'Chưa nhập mật khẩu',
            'role_id.required' => 'Chưa chọn chức vụ',
        ];
    }

    public function modalSetup($id) {
        if ($id == 0) {
            $this->action = 'create';
        } elseif ($id > 0) {
            $this->action = 'update';
        } else {
            $this->action = 'delete';
        }

        $this->account = User::find(abs($id));

        $this->getData();
    }

    public function getData() {
        $this->name = $this->account->name ?? '';
        $this->username = $this->account->username ?? '';
        
        $this->resetErrorBag();
    }

    public function create() {
        $this->validate($this->rules(), $this->messages());
        
        $user = User::create([
            'name' => trim($this->name),
            'username' => trim($this->username),
            'password' => bcrypt($this->password),
            'role_id' => trim($this->role_id),
        ]);
        $role = Role::find($this->role_id);
        $user->assignRole($role->name);
        $this->emitTo('account.account-list', 'refreshList');
        $this->dispatchBrowserEvent('closeCrudAccount');
    }

    public function update() {
        $this->validate($this->rules(), $this->messages());
        if($this->account->role_id != $this->role_id){
            $user = User::find($this->account->id);
            $preRole = Role::find($this->account->role_id);
            $role = Role::find($this->role_id);
            if($preRole){
                $user->removeRole($preRole->name);
            }
            
            $user->assignRole($role->name);
        }
        $this->account->update([
            'name' => trim($this->name),
            'username' => trim($this->username),
            'role_id' => trim($this->role_id),
        ]);
        $this->emitTo('account.account-list', 'refreshList');
        $this->dispatchBrowserEvent('closeCrudAccount');
    }

    public function delete() {
        $this->account->delete();

        $this->emitTo('account.account-list', 'refreshList');
        $this->dispatchBrowserEvent('closeCrudAccount');
    }

    public function render()
    {
        $roles = DB::table('roles')->get();

        return view('admins.accounts.livewire.account-crud')->with([
            'roles' => $roles,
        ]);;
    }
}
