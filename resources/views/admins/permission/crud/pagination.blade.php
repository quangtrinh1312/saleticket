<div class="container-fluid" id="" style="overflow: auto;">
    <div class="mt-2 table-wrapper">
        <table class="table table-hover table-dark table-striped mb-1 table-bordered">
            <thead>
                <button type="button" class="btn btn-primary text-center mb-1" data-toggle="modal"
                    data-target="#CreateRoleWithPermissionModalLong" style="width: 15vw;"
                    onclick="showCreateRole('{{ $allPermissions }}')">
                    Tạo role mới +
                </button>
                <tr>
                    <th scope="col" class="text-center">STT</th>
                    <th scope="col" class="text-center">Chức vụ</th>
                    <th scope="col" class="text-center">Quyền hạn</th>
                    <th scope="col" class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody id="list_role_table_data">
                @if ($allRoles !== null && count($allRoles) > 0)
                    @php
                        // dd($rolesWithPermission);
                        // $keys = array_keys($rolesWithPermission);
                        //get length of array
                        // $length = count($allRoles);
                        // dd($keys);
                        // dd($rolesWithPermission[$keys[0]][0]['id']);
                        // dd($allRoles);
                    @endphp
                    @foreach ($allRoles as $i => $role)
                        {{-- @php dd($role); @endphp --}}
                        <tr>
                            <td scope="row" class="text-center">{{ $i + 1 }}</td>
                            <td scope="row" class="text-center">{{ $role->name }}</td>
                            <td scope="row" class="text-center" id="listPermissionOf_{{$i+1}}">
                                    @foreach ($rolesWithPermission[$role->name] as $permission)
                                        <span class="badge badge-primary mr-1">{{ $permission['name'] }}</span>
                                    @endforeach
                            </td>
                            <td class="" scope="row">

                                <form action="{{ route('post.deleteRole') }}" method="POST" style="display: flex; justify-content: space-around">
                                    @csrf
                                    <button type="button" class="btn btn-primary" data-toggle="modal" 
                                        data-target="#exampleModalLong"
                                        onclick="showPermission('{{ $role->id }}', '{{ $role->name }}')" title="Sửa quyền hạn">
                                        Sửa quyền
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                                    <button class="badge badge-danger" type="submit"
                                        title="Xóa">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>


                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10" class="text-center">(Không có Chức vụ nào)</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="mt-2" id="links">
        {{-- @if (count($tickets) > 0)
            <div class="d-flex justify-content-between">
                <span style="font-size: 15px;"><strong>Hiển thị {{ $tickets->firstItem() }} - {{ $tickets->lastItem() }}
                        / Tổng {{ $tickets->total() }}</strong></span>
            </div>

            <nav aria-label="Page navigation example" class="mbl_pagination">
                <ul class="pagination justify-content-center">
                    @if (isset($tickets) && count($tickets) > 0)
                        {!! $tickets->appends(Request::all())->links('helpers.paginate') !!}
                    @endif
                </ul>
            </nav>
        @endif --}}
    </div>
</div>
