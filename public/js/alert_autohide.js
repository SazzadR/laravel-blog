$(document).ready(function () {
    if ($('.alert').length) {
        setTimeout(function () {
            $alertDiv = $('.alert');
            $alertDiv.hide('slow', function () {
                $alertDiv.remove();
            });
        }, 4000);
    }
});