@if(Session::has('success'))
    <script>
        $(document).ready(function() {
            new Noty({
                text: "{{Session::get('success')}}",
                type: 'success'
            }).show();
        });
    </script>
@endif