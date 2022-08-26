<script>
    $('#search_input').on('keydown', function (event) {
        if (event.keyCode == '13') {
            $('#search_form').submit();
        }
    })
</script>
