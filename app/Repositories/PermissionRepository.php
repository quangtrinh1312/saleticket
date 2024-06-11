<?php

namespace App\Repositories;
//use Your Model
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
/**
 * Class PermissionRepository.
 */
class PermissionRepository extends AbstractRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function getModel()
    {
        return User::class;
    }
    public function getListRole() {
        return Role::all();
    }
    public function getListPermission() {
        return Permission::all();
    }
    public function getRoleById($id) {
        return Role::find($id);
    }
    public function getPermissionById($id) {
        return permission::find($id);
    }
    public function createRole($name) {
        $role = new Role();
        $role->name = $name;
        $role->save();
    }
    public function createPermission($name) {
        $permission = new permission();
        $permission->name = $name;
        $permission->save();
    }
    public function getListRoleLinkToPermission() {
        $roles = Role::all();
        $rolesWithPermission = [];
        foreach ($roles as $role) {
            $rolesWithPermission[$role->name] = $role->permissions;
        }
        return $rolesWithPermission;
    }
}
