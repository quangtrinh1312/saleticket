@extends('admins.layouts.master')

@section('title')
    Thêm tài khoản
@endsection

@section('css')
    <style>

        .p-suggestions-loading {
            /*position: absolute;*/
            width: 100%;
            box-shadow: 0 0 0 1px rgba(68, 88, 112, 0.11);
            box-sizing: border-box;
            text-align: center;
            background: #fff;
            display: none;
        }

        .p-suggestions-loading img {
            width: 65px;
        }

        .p-suggestions {
            position: absolute;
            background-color: #fff;
            width: 100%;
            padding: 0px;
            box-shadow: 0 0 0 1px rgba(68, 88, 112, 0.11);
            box-sizing: border-box;
            display: none;
            z-index: 1;
        }

        .p-suggestions li {
            list-style-type: none;
            cursor: pointer;
            padding: 2px 10px;
            color: #445870;
            font-size: 14px;
        }

        .p-suggestions li:hover {
            background: #f6f7f9;
        }


    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title text-uppercase">Thêm tài khoản đăng nhập</h6>
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
                                <label for="account" class="font-weight-semibold">Tài Khoản <span
                                            class='required-alert'>*</span></label>
                                <div class="form-group form-group-feedback form-group-feedback-left ">
                                    <input type="email" class="form-control border-success form-control-lg"
                                           name="email"
                                           required placeholder="Email">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-pencil"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="password" class="font-weight-semibold">Mật khẩu <span
                                            class='required-alert'>*</span></label>
                                <div class="form-group form-group-feedback form-group-feedback-left ">
                                    <input type="password" class="form-control border-success form-control-lg"
                                           name="password"
                                           required placeholder="Password">
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
                            <div class="col-lg-12">
                                <label for="" class="font-weight-semibold">Họ tên <span class='required-alert'>*</span></label>
                                <div class="form-group form-group-feedback form-group-feedback-left ">
                                    <input type="text" class="form-control border-success form-control-lg" name="fullname"
                                           placeholder="Tên nhân viên" id="name"/>
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-pencil"></i>
                                    </div>

                                    <input type="text" class="form-control" name="employee_id" value=""
                                           id="employee_id" hidden/>
                                    <div class="p-suggestions-loading">
                                        <img src="{{ asset('global_assets/images/loading/loader.gif') }}"
                                             alt="loading"/>
                                    </div>
                                    <ul class="p-suggestions">
                                    </ul>

                                </div>
                            </div>
                        </div>
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <label for="" class="font-weight-semibold">Quê quán </label>--}}
{{--                                <div class="form-group form-group-feedback form-group-feedback-left ">--}}
{{--                                    <input type="text" class="form-control border-success form-control-lg" name="native"--}}
{{--                                           disabled placeholder="Quê quán" id="native"/>--}}
{{--                                    <div class="form-control-feedback form-control-feedback-lg">--}}
{{--                                        <i class="icon-pencil"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <label for="" class="font-weight-semibold">Trình độ</label>--}}
{{--                                <div class="form-group form-group-feedback form-group-feedback-left ">--}}
{{--                                    <input type="text" class="form-control border-success form-control-lg" name="degree"--}}
{{--                                           disabled placeholder="Trình độ" id="degree"/>--}}
{{--                                    <div class="form-control-feedback form-control-feedback-lg">--}}
{{--                                        <i class="icon-pencil"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <div class="form-group date ">--}}
{{--                                    <label for="email" class="btn-block font-weight-semibold">Ngày sinh </label>--}}
{{--                                    <div class="input-group">--}}
{{--										<span class="input-group-prepend">--}}
{{--											<span class="input-group-text"><i class="icon-calendar"></i></span>--}}
{{--										</span>--}}
{{--                                        <input name="birth" type="text" class="form-control birth"--}}
{{--                                               value="" id="birth" disabled/>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-lg-6">--}}
{{--                                <div class="form-group date ">--}}
{{--                                    <label for="email" class="btn-block font-weight-semibold">Khoa</label>--}}
{{--                                    <div class="input-group">--}}
{{--										<span class="input-group-prepend">--}}
{{--											<span class="input-group-text"><i class="icon-pencil"></i></span>--}}
{{--										</span>--}}
{{--                                        <input name="department_id" type="text" class="form-control"--}}
{{--                                               value="" id="department" disabled/>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}

                        <div class="form-group">
                            <div class="col-lg-12">
                                <label for="email" class="btn-block"><b>Ảnh</b></label>
                                <input type="file" name="avatar" class="form-input-styled" data-fouc>
                                <span class="form-text text-muted">Định dạng: gif, png, jpg. Dung lượng tối đa 2Mb</span>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <div class="col-lg-12">
                                <label class="font-weight-bold">Vai trò</label>
                            </div>
                            @foreach($roles as $key => $value)
                                <div class="col col-lg-3">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" value="{{$value->id}}" name="role[]"
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
    <script type="text/javascript">

        $("#name").keyup(function () {
            var $name = $("#name").val();
            var $suggestions = $(".p-suggestions");
            var $loading = $(".p-suggestions-loading");

            var $native = $("#native");
            var $degree = $("#degree");
            var $birth = $("#birth");
            var $department = $("#department");
            var $employee_id = $("#employee_id");

            if (!$name) {
                $loading.hide();
                $suggestions.hide();
                $suggestions.html();

                $employee_id.val(0);
                $name.val('');
                $native.val('');
                $birth.val('');
                $department.val('');
                $degree.val('');
                return false;
            }


            jQuery.ajax({
                url: '/ajax/get-list-employee-by-names',
                type: 'GET',
                cache: false,
                data: {'name': $name},
                beforeSend: function () {
                    $loading.show();
                    $suggestions.hide();
                    $suggestions.html();
                },
                success: function (data) {
                    $loading.hide();
                    $suggestions.show();
                    $suggestions.html(data);
                }
            });
        });

    </script>
    <script src="{{asset('global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script>
        $('.form-check-input-styled-primary').uniform({
            wrapperClass: 'border-primary-600 text-primary-800'
        });
    </script>
@endsection

