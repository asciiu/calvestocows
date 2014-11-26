function embedshortcode() {
    var shortcodeText;
    var style = document.getElementById('shortcode_panel');


    if (style.className.indexOf('current') != -1) {
        // SHORTCODES SELEC MENU //
        var shortcodeSelect = document.getElementById('scSelect').value;


        // COLUMN //
        var columnLayout = document.getElementById('columnLayout').value;


        // TYPOGRAPHY //
        var typoElement = document.getElementById('typoElement').value;


        // BUTTON //
        var btnColor = document.getElementById('btnColor').value;
        var btnUrl = document.getElementById('btnUrl').value;
        var btnText = document.getElementById('btnText').value;

        var btnLiquid = "no";
        if (document.getElementById('btnLiquid').checked) { btnLiquid = "yes"; }

        var btnTarget = "";
        if (document.getElementById('btnTarget').checked) { btnTarget = " target=\"new\""; }


        // DIVIDER //
        var divType = document.getElementById('divType').value;


        // LIST //
        var listType = document.getElementById('listType').value;


        // VIDEO //
        var vidUrl = document.getElementById('vidUrl').value;
        var vidAlign = document.getElementById('vidAlign').value;
        var vidWidthVal = document.getElementById('vidWidth').value;

        var vidWidth = '';
        if ( vidWidthVal != '') { vidWidth = ' width="'+ vidWidthVal +'"'; }


        // VIDEO EMBED //
        var embedCode = jQuery('#vidEmbed').val();
        var vidEmbed = jQuery('<div/>').text(embedCode).html();


        // NOTIFICATION //
        var boxType = document.getElementById('boxType').value;


        // SERVICE //
        var iconLayout = document.getElementById('iconLayout').value;
        var serviceTitle = document.getElementById('serviceTitle').value;
        var iconType = jQuery('input[name="iconType"]:checked').val();


        // PRICE LABEL //
        var colSize = document.getElementById('colSize').value;
        var itemName = document.getElementById('itemName').value;
        var itemPrice = document.getElementById('itemPrice').value;
        var priceSuffix = document.getElementById('priceSuffix').value;

        var itemFeatured = 'no';
        if (document.getElementById('itemFeatured').checked) { itemFeatured = 'yes'; }


        // IMAGE //
        var imgPath = document.getElementById('imgPath').value;
        var imgHeight = document.getElementById('imgHeight').value;
        var imgWidth = document.getElementById('imgWidth').value;
        var imgTitle = document.getElementById('imgTitle').value;
        var imgAlt = document.getElementById('imgAlt').value;
        var imgAlign = document.getElementById('imgAlign').value;
        var imgLink = document.getElementById('imgLink').value;

        var imgFrame = "no";
        if (document.getElementById('imgFrame').checked) { imgFrame = "yes"; }


        // IMAGE SLIDER //
        var sliderWidth = document.getElementById('sliderWidth').value;
        var sliderHeight = document.getElementById('sliderHeight').value;


        // POPUP LIGHTBOX //
        var popupID = document.getElementById('popupId').value;
        var popupText = document.getElementById('popupText').value;
        var popupColor = document.getElementById('popupColor').value;

        // AUDIO //
        var audioID = document.getElementById('audioID').value;
        var audioMp3 = document.getElementById('audioMp3').value;
        var audioOga = document.getElementById('audioOga').value;



        //=================================//
        // LAYOUT COLUMN SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scColumn' && columnLayout == 'fullwidth_column' ){
            shortcodeText = "[pt_fullwidth content_align=\"left\"]<br />Fullwidth sample text<br />[/pt_fullwidth]";
        }


        if ( shortcodeSelect == 'scColumn' && columnLayout == 'two_columns' ){
            shortcodeText = "[pt_one_half content_align=\"left\"]<br />1/2 Sample text<br />[/pt_one_half]<br /><br />[pt_one_half_last content_align=\"left\"]<br />1/2 Sample text<br />[/pt_one_half_last]";
        }


        if ( shortcodeSelect == 'scColumn' && columnLayout == 'three_columns'){
            shortcodeText = "[pt_one_third content_align=\"left\"]<br />1/3 Sample text<br />[/pt_one_third]<br /><br />[pt_one_third content_align=\"left\"]<br />1/3 Sample text<br />[/pt_one_third]<br /><br />[pt_one_third_last content_align=\"left\"]<br />1/3 Sample text<br />[/pt_one_third_last]";
        }


        if ( shortcodeSelect == 'scColumn' && columnLayout == 'four_columns'){
            shortcodeText = "[pt_one_fourth content_align=\"left\"]<br />1/4 Sample text<br />[/pt_one_fourth]<br /><br />[pt_one_fourth content_align=\"left\"]<br />1/4 Sample text<br />[/pt_one_fourth]<br /><br />[pt_one_fourth content_align=\"left\"]<br />1/4 Sample text<br />[/pt_one_fourth]<br /><br />[pt_one_fourth_last content_align=\"left\"]<br />1/4 Sample text<br />[/pt_one_fourth_last]";
        }


        if ( shortcodeSelect == 'scColumn' && columnLayout == 'five_columns'){
            shortcodeText = "[pt_one_fifth content_align=\"left\"]<br />1/5 Sample text<br />[/pt_one_fifth]<br /><br />[pt_one_fifth content_align=\"left\"]<br />1/5 Sample text<br />[/pt_one_fifth]<br /><br />[pt_one_fifth content_align=\"left\"]<br />1/5 Sample text<br />[/pt_one_fifth]<br /><br />[pt_one_fifth content_align=\"left\"]<br />1/5 Sample text<br />[/pt_one_fifth]<br /><br />[pt_one_fifth_last content_align=\"left\"]<br />1/5 Sample text<br />[/pt_one_fifth_last]";
        }


        if ( shortcodeSelect == 'scColumn' && columnLayout == 'six_columns'){
            shortcodeText = "[pt_one_sixth content_align=\"left\"]<br />1/6 Sample text<br />[/pt_one_sixth]<br /><br />[pt_one_sixth content_align=\"left\"]<br />1/6 Sample text<br />[/pt_one_sixth]<br /><br />[pt_one_sixth content_align=\"left\"]<br />1/6 Sample text<br />[/pt_one_sixth]<br /><br />[pt_one_sixth content_align=\"left\"]<br />1/6 Sample text<br />[/pt_one_sixth]<br /><br />[pt_one_sixth content_align=\"left\"]<br />1/6 Sample text<br />[/pt_one_sixth]<br /><br />[pt_one_sixth_last content_align=\"left\"]<br />1/6 Sample text<br />[/pt_one_sixth_last]";
        }


        if ( shortcodeSelect == 'scColumn' && columnLayout == 'one_fourth_three_fourth_columns'){
            shortcodeText = "[pt_one_fourth content_align=\"left\"]<br />1/4 Sample text<br />[/pt_one_fourth]<br /><br />[pt_three_fourth_last content_align=\"left\"]<br />3/4 Sample text<br />[/pt_three_fourth_last]";
        }


        if ( shortcodeSelect == 'scColumn' && columnLayout == 'three_fourth_one_fourth_columns'){
            shortcodeText = "[pt_three_fourth content_align=\"left\"]<br />3/4 Sample text<br />[/pt_three_fourth]<br /><br />[pt_one_fourth_last content_align=\"left\"]<br />1/4 Sample text<br />[/pt_one_fourth_last]";
        }


        if ( shortcodeSelect == 'scColumn' && columnLayout == 'one_third_two_third_columns'){
            shortcodeText = "[pt_one_third content_align=\"left\"]<br />1/3 Sample text<br />[/pt_one_third]<br /><br />[pt_two_third_last content_align=\"left\"]<br />2/3 Sample text<br />[/pt_two_third_last]";
        }


        if ( shortcodeSelect == 'scColumn' && columnLayout == 'two_third_one_third_columns'){
            shortcodeText = "[pt_two_third content_align=\"left\"]<br />2/3 Sample text<br />[/pt_two_third]<br /><br />[pt_one_third_last content_align=\"left\"]<br />1/3 Sample text<br />[/pt_one_third_last]";
        }


        if ( shortcodeSelect == 'scColumn' && columnLayout == 'one_fourth_one_half_one_fourth_columns'){
            shortcodeText = "[pt_one_fourth content_align=\"left\"]<br />1/4 Sample text<br />[/pt_one_fourth]<br /><br />[pt_one_half content_align=\"left\"]<br />1/2 Sample text<br />[/pt_one_half]<br /><br />[pt_one_fourth_last content_align=\"left\"]<br />1/4 Sample text<br />[/pt_one_fourth_last]";
        }


        if ( shortcodeSelect == 'scColumn' && columnLayout == 'one_half_one_fourth_one_fourth_columns'){
            shortcodeText = "[pt_one_half content_align=\"left\"]<br />1/2 Sample text<br />[/pt_one_half]<br /><br />[pt_one_fourth content_align=\"left\"]<br />1/4 Sample text<br />[/pt_one_fourth]<br /><br />[pt_one_fourth_last content_align=\"left\"]<br />1/4 Sample text<br />[/pt_one_fourth_last]";
        }


        if ( shortcodeSelect == 'scColumn' && columnLayout == 'one_fourth_one_fourth_one_half_columns'){
            shortcodeText = "[pt_one_fourth content_align=\"left\"]<br />1/4 Sample text<br />[/pt_one_fourth]<br /><br />[pt_one_fourth content_align=\"left\"]<br />1/4 Sample text<br />[/pt_one_fourth]<br /><br />[pt_one_half_last content_align=\"left\"]<br />1/2 Sample text<br />[/pt_one_half_last]";
        }


        //=================================//
        // TYPOGRAPHY SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scTypography' && typoElement == 'typoHighlighted' ){
            shortcodeText = '[pt_highlighted]Sample text here[/pt_highlighted]';
        }


        if ( shortcodeSelect == 'scTypography' && typoElement == 'typoDropcap' ){
            shortcodeText = '[pt_dropcap]Sample text here[/pt_dropcap]';
        }


        if ( shortcodeSelect == 'scTypography' && typoElement == 'typoBlockquote' ){
            shortcodeText = '[pt_blockquote]Sample text here[/pt_blockquote]';
        }


        if ( shortcodeSelect == 'scTypography' && typoElement == 'typoPullquoteLeft' ){
            shortcodeText = '[pt_pullquote_l]Sample text here[/pt_pullquote_l]';
        }


        if ( shortcodeSelect == 'scTypography' && typoElement == 'typoPullquoteRight' ){
            shortcodeText = '[pt_pullquote_r]Sample text here[/pt_pullquote_r]';
        }


        //=================================//
        // BUTTON SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scButton' && btnColor != '0' ){
            shortcodeText = '[pt_button url="'+ btnUrl +'" color="'+ btnColor +'" liquid="'+ btnLiquid +'"'+ btnTarget +']'+ btnText +'[/pt_button]';
        }


        //=================================//
        // DIVIDER SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scDivider' && divType == 'divNormal' ){
            shortcodeText = '[pt_divider]';
        }


        if ( shortcodeSelect == 'scDivider' && divType == 'divTop' ){
            shortcodeText = '[pt_divider_top]';
        }


        if ( shortcodeSelect == 'scDivider' && divType == 'divSpace' ){
            shortcodeText = '[pt_hspace]';
        }


        //=================================//
        // LIST SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scList' && listType != '0' ){
            shortcodeText = '[pt_list type="'+ listType +'"]<br />[pt_item type="'+ listType +'"]List item text[/pt_item]<br />[pt_item type="'+ listType +'"]List item text[/pt_item]<br />[pt_item type="'+ listType +'"]List item text[/pt_item]<br />[/pt_list]';
        }


        //=================================//
        // ACCORDION SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scAccordion' ){
            shortcodeText = '[pt_accordion]<br />[pt_panel title="Title one"]Accordion text one[/pt_panel]<br />[pt_panel title="Title two"]Accordion text two[/pt_panel]<br />[pt_panel title="Title three"]Accordion text three[/pt_panel]<br />[/pt_accordion]';
        }


        //=================================//
        // TABS SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scTabs' ){
            shortcodeText = '[pt_tabs tab1="Tab one" tab2="Tab two" tab3="Tab three"]<br />[pt_tab]Tab one Content[/pt_tab]<br />[pt_tab]Tab two Content[/pt_tab]<br />[pt_tab]Tab three Content[/pt_tab]<br />[/pt_tabs]';
        }


        //=================================//
        // IMAGE SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scImage' && imgPath != '' && imgWidth != '' ){
            shortcodeText = '[pt_image path="'+ imgPath +'" width="'+ imgWidth +'" height ="'+ imgHeight +'" alt="'+ imgAlt +'" title="'+ imgTitle +'" align="'+ imgAlign +'" frame="'+ imgFrame +'" link="'+ imgLink +'"]';
        }


        //=================================//
        // VIDEO SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scVideo' && vidUrl != '' ){
            shortcodeText = '[pt_video'+ vidWidth +' align="'+ vidAlign +'" url="'+ vidUrl +'"]';
        }


        //=================================//
        // VIDEO EMBED SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scVideoEmbed' && vidEmbed != '' ){
            shortcodeText = '[pt_video_embed]'+ vidEmbed +'[/pt_video_embed]';
        }


        //=================================//
        // AUDIO SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scAudio' && audioMp3 != '' && audioOga != '' && audioID != '' ){
            shortcodeText = '[pt_audio mp3="'+ audioMp3 +'" oga="'+ audioOga +'" id="'+ audioID +'"]';
        }


        //=================================//
        // TESTIMONIAL SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scTestimonial' ){
            shortcodeText = '[pt_testimonial author="Author Name"]Testimonial content[/pt_testimonial]';
        }


        //=================================//
        // NOTIFICATION SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scNotification' && boxType != '0' ){
            shortcodeText = '[pt_box type="'+ boxType +'"]Notification box content[/pt_box]';
        }


        //=================================//
        // SERVICE SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scService' && typeof iconType != 'undefined'){
            shortcodeText = '[pt_service icon="' + iconType + '" layout="' + iconLayout + '" title="'+ serviceTitle +'"]Sample Text Here[/pt_service]';
        }


        //=================================//
        // SLIDER SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scSlider' && sliderWidth != '' && sliderHeight != '' ){
            shortcodeText = '[pt_slider width="'+ sliderWidth +'"]<br/>[pt_slide path="http://path to image" width="'+ sliderWidth +'" height="'+ sliderHeight +'"]<br/>[pt_slide path="http://path to image" width="'+ sliderWidth +'" height="'+ sliderHeight +'"]<br/>[pt_slide path="http://path to image" width="'+ sliderWidth +'" height="'+ sliderHeight +'"]<br/>[/pt_slider]';
        }


        //=================================//
        // POPUP LIGHTBOX SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scPopup' && popupID != '' && popupColor != '0' ){
            shortcodeText = '[pt_popup text="' + popupText + '" color="' + popupColor + '" id="'+ popupID +'"]Insert content Here[/pt_popup]';
        }


        //=================================//
        // ACCORDION SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scGraph' ){
            shortcodeText = '[pt_graph]<br />[pt_graph_item label="Label one" value="30%"]<br />[pt_graph_item label="Label two" value="70%"]<br />[pt_graph_item label="Label three" value="50%"]<br />[/pt_graph]';
        }


        //=================================//
        // PRICE LABEL SHORTCODE
        //=================================//
        if ( shortcodeSelect == 'scPrice' && colSize != '0' ){
            shortcodeText = '[pt_price_label size="'+ colSize +'" title="'+ itemName +'" price="'+ itemPrice +'" suffix="'+ priceSuffix +'" featured="'+ itemFeatured +'"]<br />Sample text<br />[/pt_price_label]';
        }


////////////////////////////////////////////////////////////////////////////

        // CLOSE POPUP IF NO SHOERTCODE SELECTED
        if ( shortcodeSelect == '0' ){
            tinyMCEPopup.close();
        }
    }

    // IF SHORTCODE IS SELECTED AND HAS SETTINGS INSERT IT
    if ( typeof shortcodeText != 'undefined' ){
        if(window.tinyMCE) {
            window.tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcodeText);
            tinyMCEPopup.editor.execCommand('mceRepaint');
            tinyMCEPopup.close();
        }
        return;

    // ELSE CLOSE THE POPUP
    } else {
        tinyMCEPopup.close();
    }
}