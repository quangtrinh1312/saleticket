<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Repositories\UserRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\ConfigRepository;
use Illuminate\Support\Str;
use PSpell\Config;

class PermissionController extends Controller
{
    protected $userRepository;
    protected $permissionRepository;
    protected $configRepository;
    function __construct(
        UserRepository $userRepository,
        PermissionRepository $permissionRepository,
        ConfigRepository $configRepository
    ) {
        $this->userRepository = $userRepository;
        $this->permissionRepository = $permissionRepository;
        $this->configRepository = $configRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
        // $roleQuanLy = Role::create(['name' => 'Quản lí']);
        // $roleNhanVien = Role::create(['name' => 'Nhân viên']);

        // $permissionsList = ['Bán vé', 'Thống kê', 'Soát vé', 'Quản lý loại vé', 'Nhóm dịch vụ', 'Quản lý tài khoản', 'Xuất vé','Quản lý quyền hạn'];
        // foreach ($permissionsList as $permission) {
        //     Permission::create(['name' => $permission]);
        // }

        //lay user co id 1
        // $user = User::find(1);

        //get role by name
        // $role = Role::where('name', 'Quản lí')->first();
        //assign role to all permission 
        // $role->givePermissionTo(Permission::all());

        //change role_id of user to 1 in database
        // $this->userRepository->changeRole(1, 1);

        //get list all role each role has list permission
        $rolesWithPermission = $this->permissionRepository->getListRoleLinkToPermission();
        // dd($rolesWithPermission);
        return view('admins.permission.index')->with(
            [
                'allRoles' => $this->permissionRepository->getListRole(),
                'allPermissions' => $this->permissionRepository->getListPermission(),
                'rolesWithPermission' => $rolesWithPermission,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $role = Role::create(['name' => $request->role_name]);
        foreach ($request->permissions_id as $permission_id) {
            $permission = Permission::find($permission_id);
            $role->givePermissionTo($permission);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //see permission_id
        // return $request->role_id;
        //get role by id
        $role = Role::find($request->role_id);

        //find all permission of role
        $permissions = $role->permissions;

        if (empty($request->permissions_id)) {
            // //remove all permission of role
            $role->revokePermissionTo(Permission::all());
        } else {
            //add new permission to role
            foreach ($request->permissions_id as $permission_id) {
                if (!$permissions->contains($permission_id)) {
                    $permission = Permission::find($permission_id);
                    $role->givePermissionTo($permission);
                }
            }
            //remove permission if new permissions dont have pre permission
            foreach ($permissions as $permission) {
                if (!in_array($permission->id, $request->permissions_id)) {
                    $role->revokePermissionTo($permission);
                }
            }
        }
        // //remove all permission of role
        // $role->revokePermissionTo(Permission::all());

        // //give permissions to role
        // foreach ($request->permissions_id as $permission_id) {
        //     $permission = Permission::find($permission_id);
        //     //assign permission to role
        //     $role->givePermissionTo($permission);
        // }
        //get list all role each role has list permission
        // $rolesWithPermission = $this->permissionRepository->getListRoleLinkToPermission();
        return [$request->role_id, $role->permissions];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function showPermissionDetail($id)
    {
        $role = Role::find($id);
        $permissions = $role->permissions;

        $allPermissions = $this->permissionRepository->getListPermission();
        //views\admins\permission\print_view\print_detail_permission.blade.php
        return view('admins.permission.print_view.print_detail_permission')->with(
            [
                'permissions' => $permissions,
                'allPermissions' => $allPermissions,
            ]
        );
    }

    public function showCreateRole($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function destroyRole(Request $request)
    {
        $role = Role::find($request->role_id);
        //remove all permission of role
        $role->revokePermissionTo(Permission::all());
        //get list all user has role_id = $id
        $users = $this->userRepository->getListByRole($request->role_id);
        //change role_id of user to 0 in database
        foreach ($users as $user) {
            $this->userRepository->changeRole($user->id, 0);
        }
        //remove role
        $role->delete();
        $config = $this->configRepository->getFirt();
        $username = Str::slug($config->name, '-');
        //back to permission page with parameter name = permission
        return redirect()->route('get.permission', ['name' => $username]);
    }
    public function getPermissionByRoleId(Request $request)
    {
        $role = Role::find($request->role_id);
        $permissions = $role->permissions;
        $allPermissions = Permission::all();
        return [$permissions, $allPermissions];
    }
}
