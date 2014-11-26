jQuery(document).ready(function($) {
    $('#optionsframework-submit input.button-primary').wrap('<div id="save-btn"></div>');

    $(window).resize( function(){
        var conWidth = $("#optionsframework").width();
        $('#optionsframework-submit #save-btn').css({ width: conWidth });
    });

    $(window).scroll(function (event) {
        var y = $(this).scrollTop();

        if (y >= 350) {
            $('#optionsframework-submit #save-btn').addClass('fixed');
        } else {
            $('#optionsframework-submit #save-btn').removeClass('fixed');
        }
    });

    $(window).trigger('resize'); // inital resize
});