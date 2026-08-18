    $(document).ready(function() {
    $('#ci').on('input', function() {
        $('#password').val($(this).val());
        $('#password_confirmation').val($(this).val());
    });
});