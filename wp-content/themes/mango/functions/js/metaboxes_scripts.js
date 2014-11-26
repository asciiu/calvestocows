jQuery(document).ready(function($) {

    /* POST FORMATS METABOXES SCRIPTS
    =============================================================*/

    var radioSet = $('#post-formats-select input'); // POST FORMAT RADIO SET
    var postFormatRadios = [ $("#post-format-link"), $("#post-format-video"), $("#post-format-audio"), $("#post-format-quote"), $("#post-format-gallery") ]; // POST FORMAT RADIO BUTTONS
    var postFormatMetaboxes = [ $("#link_format_settings"), $("#video_format_settings"), $("#audio_format_settings"), $("#quote_format_settings"), $("#gallery_format_settings") ]; // POST FORMAT METABOXES


    // HIDE POST FORMATE METABOXES
    $.each( postFormatMetaboxes, function(index, metabox){
        metabox.css({ display: 'none' });
    });


    // SHOW SELECTED POST FORMATE METABOXES IF IS INITIALLY CHECKED
    $.each( postFormatRadios, function(index, radioButton){
        if(radioButton.is(':checked')){
            postFormatMetaboxes[index].css({ display: 'block' });
        }
    });


    // SHOW/HIDE SELECTED POST FORMATE METABOXES ON RADIO BUTTONS CHANGE
    radioSet.change( function() {
        $.each( postFormatMetaboxes, function(index, metabox){
            metabox.css({ display: 'none' });
        });

        if($(this).val() == 'link') {
            postFormatMetaboxes[0].css({ display: 'block' });
        }
        else if($(this).val() == 'video') {
            postFormatMetaboxes[1].css({ display: 'block' });
        }
        else if($(this).val() == 'audio') {
            postFormatMetaboxes[2].css({ display: 'block' });
        }
        else if($(this).val() == 'quote') {
            postFormatMetaboxes[3].css({ display: 'block' });
        }
        else if($(this).val() == 'gallery') {
            postFormatMetaboxes[4].css({ display: 'block' });
        }
    });




    /* PAGE TEMPLATES METABOXES SCRIPTS
    =============================================================*/

    var pageTemplate = $("#page_template"); // PAGE TEMPLATE SELECT MENU
    var folioPageMetabox = $("#folio_page_settings"); // FOLIO PAGE METABOX
    var faqsPageMetabox = $("#faqs_page_settings"); // FAQs PAGE METABOX
    var homeVideoMetabox = $("#home_video_settings"); // HOME VIDEO METABOX
    var homeSlideshowMetabox = $("#home_slideshow_settings"); // HOME VIDEO METABOX
    var aboutPageMetabox = $("#about_page_settings"); // ABOUT PAGE METABOX
    var contactPageMetabox = $("#contact_page_settings"); // CONTACT PAGE METABOX
    var contentBuilderMetabox = $("#content_builder_settings"); // CONTENT BUILDER METABOX
    var customBgMetabox = $("#page_bg_settings"); // PAGE BG METABOX


    // HIDE METABOXES
    folioPageMetabox.css({ display: 'none' });
    faqsPageMetabox.css({ display: 'none' });
    homeVideoMetabox.css({ display: 'none' });
    homeSlideshowMetabox.css({ display: 'none' });
    aboutPageMetabox.css({ display: 'none' });
    contactPageMetabox.css({ display: 'none' });
    contentBuilderMetabox.css({ display: 'none' });


    // SHOW SELECTED METABOXES IF IS INITIALLY SELECTED
    if( pageTemplate.val() == 'portfolio.php' ){
        folioPageMetabox.css({ display: 'block' });
    }

    if( pageTemplate.val() == 'faqs.php' ){
        faqsPageMetabox.css({ display: 'block' });
    }

    if( pageTemplate.val() == 'about.php' ){
        aboutPageMetabox.css({ display: 'block' });
    }

    if( pageTemplate.val() == 'contact.php' ){
        contactPageMetabox.css({ display: 'block' });
    }

    if( pageTemplate.val() == 'home-video.php' ){
        homeVideoMetabox.css({ display: 'block' });
        contentBuilderMetabox.css({ display: 'block' });
        customBgMetabox.css({ display: 'none' });
    }

    if( pageTemplate.val() == 'home-slideshow.php' ){
        homeSlideshowMetabox.css({ display: 'block' });
        contentBuilderMetabox.css({ display: 'block' });
        customBgMetabox.css({ display: 'none' });
    }

    if( pageTemplate.val() == 'home-corp.php' ){
        homeSlideshowMetabox.css({ display: 'none' });
        contentBuilderMetabox.css({ display: 'block' });
        customBgMetabox.css({ display: 'block' });
    }


    // SHOW/HIDE SELECTED METABOXES ON PAGE TEMPLATE SELECT MENU CHANGE
    pageTemplate.change( function() {
        folioPageMetabox.css({ display: 'none' });
        faqsPageMetabox.css({ display: 'none' });
        homeVideoMetabox.css({ display: 'none' });
        homeSlideshowMetabox.css({ display: 'none' });
        aboutPageMetabox.css({ display: 'none' });
        contactPageMetabox.css({ display: 'none' });
        contentBuilderMetabox.css({ display: 'none' });
        customBgMetabox.css({ display: 'block' });

        if( pageTemplate.val() == 'portfolio.php' ){
            folioPageMetabox.css({ display: 'block' });
        }
        else if( pageTemplate.val() == 'faqs.php' ){
            faqsPageMetabox.css({ display: 'block' });
        }
        else if( pageTemplate.val() == 'about.php' ){
            aboutPageMetabox.css({ display: 'block' });
        }
        else if( pageTemplate.val() == 'contact.php' ){
            contactPageMetabox.css({ display: 'block' });
        }
        else if( pageTemplate.val() == 'home-video.php' ){
            homeVideoMetabox.css({ display: 'block' });
            contentBuilderMetabox.css({ display: 'block' });
            customBgMetabox.css({ display: 'none' });
        }
        else if( pageTemplate.val() == 'home-slideshow.php' ){
            homeSlideshowMetabox.css({ display: 'block' });
            contentBuilderMetabox.css({ display: 'block' });
            customBgMetabox.css({ display: 'none' });
        }
        else if( pageTemplate.val() == 'home-corp.php' ){
            homeSlideshowMetabox.css({ display: 'none' });
            contentBuilderMetabox.css({ display: 'block' });
            customBgMetabox.css({ display: 'block' });
        }
    });




    /* CONTENT BUILDER INNER SETTINGS
    =============================================================*/

    // HIDE SECTION SETTINGS CONTAINERS
    $(".sub-section").css({ display: 'none' });

    // SHOW SELECTED SECTION SETTINGS CONTAINERS IF IS INITIALLY SELECTED
    $(".section-select").each( function(){
        if($(this).val() == 'callout-message'){
            $(this).closest('li').find('#callout-message-section').css({ display: 'block' });
        }
        if($(this).val() == 'flex-slider'){
            $(this).closest('li').find('#flex-slider-section').css({ display: 'block' });
        }
        if($(this).val() == 'video-banner'){
            $(this).closest('li').find('#video-banner-section').css({ display: 'block' });
        }
        if($(this).val() == 'fixed-image'){
            $(this).closest('li').find('#fixed-image-section').css({ display: 'block' });
        }
        if($(this).val() == 'grid-showcase'){
            $(this).closest('li').find('#grid-showcase-section').css({ display: 'block' });
        }
        if($(this).val() == 'recent-work-row'){
            $(this).closest('li').find('#recent-work-section').css({ display: 'block' });
        }
        if($(this).val() == 'recent-posts-row'){
            $(this).closest('li').find('#recent-posts-section').css({ display: 'block' });
        }
        if($(this).val() == 'clients'){
            $(this).closest('li').find('#clients-section').css({ display: 'block' });
        }
        if($(this).val() == 'twitter'){
            $(this).closest('li').find('#twitter-section').css({ display: 'block' });
        }
        if($(this).val() == 'custom'){
            $(this).closest('li').find('#custom-section').css({ display: 'block' });
        }
        if($(this).val() == '0'){
            $(this).closest('li').find('#empty-section').css({ display: 'block' });
        }
    });

    // SHOW/HIDE SELECTED SECTION SETTINGS CONTAINERS ON CONTENT SECTION SELECT MENU CHANGE
    $(".section-select").change(function() {
        $(this).closest('li').find(".sub-section").css({ display: 'none' });

        if($(this).val() == 'callout-message'){
            $(this).closest('li').find('#callout-message-section').css({ display: 'block' });
        }
        if($(this).val() == 'flex-slider'){
            $(this).closest('li').find('#flex-slider-section').css({ display: 'block' });
        }
        if($(this).val() == 'video-banner'){
            $(this).closest('li').find('#video-banner-section').css({ display: 'block' });
        }
        if($(this).val() == 'fixed-image'){
            $(this).closest('li').find('#fixed-image-section').css({ display: 'block' });
        }
        if($(this).val() == 'grid-showcase'){
            $(this).closest('li').find('#grid-showcase-section').css({ display: 'block' });
        }
        if($(this).val() == 'recent-work-row'){
            $(this).closest('li').find('#recent-work-section').css({ display: 'block' });
        }
        if($(this).val() == 'recent-posts-row'){
            $(this).closest('li').find('#recent-posts-section').css({ display: 'block' });
        }
        if($(this).val() == 'clients'){
            $(this).closest('li').find('#clients-section').css({ display: 'block' });
        }
        if($(this).val() == 'twitter'){
            $(this).closest('li').find('#twitter-section').css({ display: 'block' });
        }
        if($(this).val() == 'custom'){
            $(this).closest('li').find('#custom-section').css({ display: 'block' });
        }
        if($(this).val() == '0'){
            $(this).closest('li').find('#empty-section').css({ display: 'block' });
        }
    });




    /* REPEATABLE FILEDS
    ==================================*/

    $('.repeatable-add').click(function() {
        var field = $(this).closest('.section').find('.field_repeatable > li:last').clone(true);
        var fieldLocation = $(this).closest('.section').find('.field_repeatable > li:last');
        $('input:text, textarea', field).val('');
        $('select option:selected', field).removeAttr('selected');
        $('.increment', field).attr('name', function(index, name) {
            return name.replace(/(\d+)/, function(fullMatch, n) {
                return Number(n) + 1;
            });
        });
        $('.increment-item', field).attr('name', function(index, name) {
            return name.replace(/(\d+)/, function(fullMatch, n) {
                return Number(n) + 1;
            });
        });
        $('.upload-preview-img', field).remove();
        field.insertAfter(fieldLocation, $(this).closest('.section'));
        return false;
    });

    $('.repeatable-field-remove').click(function(){
        $(this).closest('li').remove();
        itemIndex();
        return false;
    });

    $('.repeatable-remove').click(function(){
        $(this).closest('.content-section-wrapper').remove();
        sectionIndex();
        return false;
    });




    /* CLEAR SINGLE UPLOAD FIELD VALUE
    ==================================*/

    $('.value-remove').click(function(){
        $(this).closest("li").find("input:text").val("");
        return false;
    });




    /* SORTABLE FILEDS
    ==================================*/

    function sectionIndex() {
        $(".increment").attr('name', function(index, name) {
            return name.replace(/(\d+)/, $(this).closest(".content-section-wrapper").index() );
        });
    }

    function itemIndex() {
        $(".increment-item").attr('name', function(index, name) {
            return name.replace(/(\d+)/, $(this).closest("li").index() );
        });
    }

    $('.section-sortable').sortable({
        opacity: 0.8,
        revert: true,
        cursor: 'move',
        placeholder: "sortable-highlight",
        handle: '.sort',
        stop: function( event, ui ) {
            sectionIndex();
        }
    });

    $('.field-sortable').sortable({
        opacity: 0.8,
        revert: true,
        cursor: 'move',
        placeholder: "sortable-highlight",
        handle: '.sort',
        stop: function( event, ui ) {
            itemIndex();
        }
    });




    /* DISABLE FIELDS
    ==================================*/

    if( $("#folio_preview_imgs_nav").val() == 'thumbnails' ){
        $("#folio_preview_variable_height").prop('disabled', true);
    }

    $("#folio_preview_imgs_nav").change(function() {
        if( $(this).val() == 'thumbnails' ){
            $("#folio_preview_variable_height").prop('disabled', true);
        } else {
            $("#folio_preview_variable_height").prop('disabled', false);
        }
    });




    /* IMAGE PERVIEW FOR UPLOAD FIELDS
    ==================================*/

    $(document).on({
        mouseenter: function(){
            $(this).closest("li").find(".upload-preview-img").fadeIn(150);
        },
        mouseleave: function(){
            $(this).closest("li").find(".upload-preview-img").fadeOut(150);
        }
    }, ".multi_upload-section li input:text, .upload-section input:text, .sub-section li input:text");




    /* COLOR PICKER
    ==================================*/

    $('.pt-color').wpColorPicker();

}); /* DOCUMENT READY END */