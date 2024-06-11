@extends('admins.layouts.master')

@section('title')
    Quản Lý Tài Khoản
@endsection

@section('css')

@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title text-uppercase">DANH SÁCH</h6>
                    <div class="row">
                        <div class="col-lg-12 mt-1 mb-1 pl-1">
                            <a href="{{route('users.create')}}" class="float-right btn btn-primary mr-1"><i
                                        class="icon-plus2"></i> Thêm mới</a>
                        </div>
                    </div>
                </div>

                <div class="card-body overflow-auto">
                    <table class="table table table-striped table-bordered table-responsive-sm">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Avatar</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th width="125">Tác Vụ</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(isset($users) && count($users)!=0)
                            @foreach($users as $key => $value)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <img src="{{ asset('storages/users/100/'.$value->avatar) }}" alt="" />
                                    </td>
                                    <td>{{$value->fullname}}</td>

                                    <td>{{$value->email}}</td>
                                    <td>
                                        @foreach($value->roles as $roleUser)
                                            <span class="badge bg-blue">{{$roleUser->name}}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{route('users.edit',$value->id)}}"
                                           class=" btn btn-success btn-icon legitRipple  btn-sm float-left mr-1">
                                            <i class="icon-pencil" aria-hidden="true"></i>
                                        </a>
                                        <form action="{{route('users.destroy',$value->id)}}"
                                              class="pull-left float-left"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon btn-sm"
                                                    onclick="if(!confirm('Bạn có chắc chắn muốn xóa ?')){return false}">
                                                <i class="icon-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">{{'Không tìm thấy dữ liệu'}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-12 mt-4 mb-1 pl-1">
                            <div class="clearfix">
                                <nav aria-label="Page navigation example" class="pull-right navigation">
                                    {!! $users->appends(Request::all())->links('helpers.paginate') !!}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection
