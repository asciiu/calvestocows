jQuery.noConflict();
(function($) {

    $(document).ready(function() {
        var pt_media_frame;
        
        $('input.upload_img').live("click", function () {
            formfield = $(this).prev('input');

            if ( pt_media_frame ) {
                pt_media_frame.open();
                return;
            }

            pt_media_frame = wp.media.frames.pt_media_frame = wp.media({
                className: 'media-frame pt-media-frame',

                frame: 'select',

                // Disallow multiple selection
                multiple: false,

                // Customize frame title
                title: pt_trans_media.title,

                // Customize button text
                button: {
                    text:  pt_trans_media.button
                }
            });

            pt_media_frame.on('select', function(){
                var media_attachment = pt_media_frame.state().get('selection').first().toJSON();

                // Send URL to text field
                formfield.val(media_attachment.url);
            });

            pt_media_frame.open();
        });
    });

})(jQuery);