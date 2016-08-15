$(document).ready(function () {
    if ($('.alert-success').length) {
        setTimeout(function () {
            var $alertDiv = $('.alert-success');
            $alertDiv.hide('slow', function () {
                $alertDiv.remove();
            });
        }, 4000);
    }
});