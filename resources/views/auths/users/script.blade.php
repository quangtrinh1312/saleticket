<script>

    $('#preview_img').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#show_img').attr('src', e.target.result).width(175).height(200);
        };
        reader.readAsDataURL(this.files[0]);
    });
</script>