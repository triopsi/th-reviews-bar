; (function ($) {
    $(document).ready(function () {
        $('#reviewDetailsRatingField').on('change', function () {
            var ratingval = $(this).val();
            var ratingprecense = $('.thrb-precent-star-rating');
            var maxstar = 5;
            if (ratingval <= maxstar) {
                var precent = ((100 / 5) * ratingval);
                ratingprecense.css("width", precent + "%");
            } else {
                return false;
            }
        });

        $('#post').submit(function () {

            if (!$('#reviewDetailsAuthorNameField').val()) {
                $('#reviewDetailsAuthorNameField').css('border-color', 'red');
                alert('Please fill the Author name field!');
                return false;
            }

            if (!$('#reviewDetailsRatingField').val()) {
                $('#reviewDetailsRatingField').css('border-color', 'red');
                alert('Please fill the rating field!');
                return false;
            }
        });
        $(function () {
            $('.thrb-hover-color-field').wpColorPicker();
        });
    });
})(jQuery);