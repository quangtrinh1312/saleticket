@extends('admins.layouts.master_login')

@section('title')
    Login
@endsection

@section('css')

@endsection

@section('content')

    <!-- Main content -->
    <div class="content-wrapper" style="margin-top: 5%;">

        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">

            <!-- Login form -->

            <form class="login-form" action="{{route('post.admin.login')}}" method="POST" role="form">
                {{ csrf_field() }}
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $er)
                            {{$er}} <br>
                        @endforeach
                    </div>
                @endif
                @if (session()->has('error_login'))
                    <div class="alert alert-danger">
                        {{ session('error_login') }}
                    </div>
                @endif
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="{{asset('images/logo/logo.png')}}" alt="" style="width: 100%; display: block; margin: 0 auto">
                            <h5 class="mb-0">Đăng nhập</h5>
                            <span class="d-block text-muted">Nhập tài khoản bên dưới</span>
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="text" class="form-control" name="username" placeholder="Tên đăng nhập" value="{{old('username')}}" required>
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập<i
                                        class="icon-circle-right2 ml-2"></i></button>
                        </div>

                        <div class="text-center">
                           <!-- <a href="#">Quên mật khẩu ?</a> -->
                        </div>
                    </div>
                </div>
            </form>
            <!-- /login form -->

        </div>
        <!-- /content area -->


        <!-- /footer -->
    </div>

    <!-- /main content -->

@endsection

@section('script')

@endsection

