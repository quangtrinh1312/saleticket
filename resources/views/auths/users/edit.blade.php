@extends('admins.layouts.master')

@section('title')
    Cập nhật tài khoản
@endsection

@section('css')

@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <form action="{{route('users.update',$user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title text-uppercase">Tài khoản đăng nhập</h6>
                    </div>

                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                {{$error}} <br>
                            @endforeach
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="" class="font-weight-semibold">Tên tài khoản <span class='required-alert'>*</span></label>
                                <div class="form-group form-group-feedback form-group-feedback-left ">
                                    <input type="text" class="form-control" name="id" value="{{ $user->id }}"
                                           hidden />
                                    <input type="email" class="form-control border-success form-control-lg"
                                           name="email" value="{{ $user->email }}"
                                           required placeholder="email">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-pencil"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="" class="font-weight-semibold">Mật khẩu mới <span class='required-alert'>*</span></label>
                                <div class="form-group form-group-feedback form-group-feedback-left ">
                                    <input type="password" class="form-control border-success form-control-lg"
                                           name="password" placeholder="Password">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-pencil"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title text-uppercase">Thông tin nhân viên</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="" class="font-weight-semibold">Họ tên <span class='required-alert'>*</span></label>
                                <div class="form-group form-group-feedback form-group-feedback-left ">
                                    <input type="text" class="form-control border-success form-control-lg" name="fullname"
                                           placeholder="Tên nhân viên" id="name"
                                           value="{{$user->fullname}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label for="email" class="btn-block"><b>Ảnh</b></label>
                                        <input type="file" name="avatar" class="form-input-styled" data-fouc>
                                        <span class="form-text text-muted">Định dạng: gif, png, jpg. Dung lượng tối đa 2Mb</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <div class="col col-lg-12">
                                <label class="font-weight-bold">Vai trò</label>
                            </div>
                            @foreach($roles as $key => $value)
                                <div class="col col-lg-3">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" value="{{$value->id}}" name="role[]"
                                                   {{in_array($value->id,$userRole)?'checked':''}}
                                                   class="form-check-input-styled-primary" data-fouc>
                                            {{$value->name}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group ">
                                    <a href="{{route('users.index')}}"
                                       class="btn btn-secondary">
                                        <i class="icon-chevron-left" aria-hidden="true"></i>
                                        Quay về
                                    </a>
                                    <button class="btn btn-primary btn-save" type="submit">
                                        <i class="icon-floppy-disk" aria-hidden="true"></i> Lưu
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('script')

    <script src="{{asset('global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script>
        $('.form-check-input-styled-primary').uniform({
            wrapperClass: 'border-primary-600 text-primary-800'
        });
    </script>
@endsection

