@if(Session::has('error'))
    <script>
        $(document).ready(function() {
            new Noty({
                text: "{{Session::get('error')}}",
                type: 'error'
            }).show();

        });
    </script>
@endif