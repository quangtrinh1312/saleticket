@extends('layouts.master')

@section('title')
    Không có quyền truy cập
@endsection

@section('css')

@endsection

@section('content')

        <!-- Content area -->

            <!-- Container -->
            <div class="flex-fill">

                <!-- Error title -->
                <div class="text-center mb-3">
                    <h1 class="error-title">401</h1>
                    <h5>Không có quyền truy cập</h5>
                </div>
                <!-- /error title -->



            </div>
            <!-- /container -->

        <!-- /content area -->







@endsection

@section('script')

    <!-- Theme JS files -->

    <script src="{{asset('/global_assets/js/plugins/extensions/jquery_ui/widgets.min.js')}}"></script>
    <script src="{{asset('/global_assets/js/plugins/extensions/jquery_ui/effects.min.js')}}"></script>

    <script src="{{asset('/global_assets/js/demo_pages/jqueryui_components.js')}}"></script>

@endsection
