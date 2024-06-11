<script>

    /**
     params : class name,id name,tags name
     example : .class-name,#id-name,tags-name
     return : true ||false
     **/
    function element_exists(element_name) {

        if ($(element_name).length) {
            return true;
        }

        return false;
    }

    function getState(country_id) {
        $.ajax({
            url: '/ajax/get-state/',
            type: 'GET',
            data: {'country_id': country_id},
            beforeSend: function () {
            },
            success: function (res) {
                if (res) {
                    $('.state-content').html(res)
                }
            }
        });
    }

    $(".select-country").change(function () {
        var country_id = $(".select-country").val();
        getState(country_id);
    });

    

</script>

