@extends('admins.layouts.master')

@section('title')
    Cài đặt tài khoản
@endsection

@section('css')

@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <form action="{{route('update.account.setting',$user->id)}}" method="post">
                @csrf

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
                                <div class="form-group form-group-feedback form-group-feedback-left ">
                                    <input type="text" class="form-control" name="id" value="{{ $user->id }}"
                                           hidden/>
                                    <input type="email" class="form-control border-success form-control-lg"
                                           name="email" value="{{ $user->email }}"
                                           required placeholder="Email">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-pencil"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group form-group-feedback form-group-feedback-left ">
                                    <input type="password" class="form-control border-success form-control-lg"
                                           name="password" placeholder="Mật khẩu mới">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-pencil"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-12">
                                <div class="form-group ">
                                    <a href="{{route('employees.index')}}"
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

