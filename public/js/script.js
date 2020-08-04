
/*
  jQuery Optional Number Step

Version: 1.0.0
 Author: Arthur Shlain
   Repo: https://github.com/ArthurShlain/JQuery-Optional-Step
 Issues: https://github.com/ArthurShlain/JQuery-Optional-Step/issues
*/
(function ($) {

    $.fn.optionalNumberStep = function (step) {
        var $base = $(this);

        var $body = $('body');

        $body.on("mouseenter mousemove", '[data-optional-step]', function () {
            $(this).attr("step", $(this).attr('data-optional-step'));
        });

        $body.on("mouseleave blur", '[data-optional-step]', function () {
            $(this).removeAttr("step");
        });

        $body.on("keydown", '[data-optional-step]', function () {
            var key = event.which;
            switch (key) {
                case 38: // Key up.
                    $(this).attr("step", step);
                    break;

                case 40: // Key down.
                    $(this).attr("step", step);
                    break;
                default:
                    $(this).removeAttr("step");
                    break;
            }
        });

        if (step === 'unset') {
            $base.removeAttr('data-optional-step');
        }

        if ($.isNumeric(step)) {
            $base.attr('data-optional-step', step);
        }

    }

}(jQuery));

jQuery(function () {
    $('.optional-step-100').optionalNumberStep(100);
});
