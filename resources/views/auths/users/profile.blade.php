@extends('admins.layouts.master')

@section('title')
    Profile
@endsection

@section('css')

@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title text-uppercase">Cập nhật</h6>
                </div>

                <div class="card-body ">

                    @if($user)
                        <form action="{{route('profile.update',$user->id)}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @else
                                <form action="{{route('profile.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    @endif
                                    @if($errors->any())
                                        <ul class="alert alert-danger">
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label class="mb-0 font-weight-semibold">Tên</label>
                                            <div class="form-group form-group-feedback form-group-feedback-left ">
                                                <input type="text" class="form-control border-success form-control-lg"
                                                       name="fullname" value="{{old('fullname',$user->fullname)}}"
                                                       required placeholder="Tên">
                                                <div class="form-control-feedback form-control-feedback-lg">
                                                    <i class="icon-pencil"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">

                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="email" class="btn-block"><b>Ảnh</b></label>
                                                <img id="show_img" src="{{asset('storages/users/60/'.$user->avatar)}}"
                                                     alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                        </div>
                                        <div class="col-lg-3">
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="email" class="btn-block"><b>Ảnh Mới</b></label>
                                                <input type="file" name="avatar" class="form-input-styled"
                                                       id="preview_img" data-fouc>
                                                <span class="form-text text-muted">Định dạng: gif, png, jpg. Dung lượng tối đa 2Mb</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-12">
                                            <div class="form-group ">
                                                <a href="{{ url()->previous() }}"
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
                                </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        $('.birth').pickadate({
            'format': 'dd/mm/yyyy',
            selectMonths: true,
            selectYears: 80
        });

    </script>

    <script src="{{asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script>
        CKEDITOR.replace('ck_editor', {
            height: 100
        });
    </script>
    <script type="text/javascript">
        $('.select').select2({
            minimumResultsForSearch: Infinity
        });
    </script>

    @include('auths.users.script')
@endsection

