<?php
function premitheme_meta_fields_output($meta_fields) {
    global $post;
    $post_vals = get_post_custom( $post->ID );
    $slider_sets = get_categories('taxonomy=slider_sets');
    $meta = '';
    $meta_array = array();
    $content_sections = array();

    foreach ($meta_fields as $field) {
        if( $field['type'] == 'heading' || $field['type'] == 'sep' ){
            // DO NOTHING
        }
        elseif( $field['type'] == 'multi_upload' ){
            $meta_array = get_post_meta($post->ID, $field['id'], true);
        }
        elseif( $field['type'] == 'editor' ){
            $meta = isset( $post_vals[ $field['id'] ] ) ? esc_attr( $post_vals[ $field['id'] ][0] ) : esc_attr( $field['std'] );
            $meta = htmlspecialchars_decode($meta);
        }
        else {
            $meta = isset( $post_vals[ $field['id'] ] ) ? esc_attr( $post_vals[ $field['id'] ][0] ) : esc_attr( $field['std'] );
        }
    ?>
        <div class="section <?php echo $field['type'].'-section'; if( $field['first'] == 'first' ) echo ' first'; ?>">
            <?php switch($field['type']) {

                /* text
                ===================*/
                case 'text':
                    if( $field['note'] ){
                        echo '<p class="note">'.$field['note'].'</p>';
                    }
                    echo '<label for="'.$field['id'].'">'.$field['label'].'</label><br/>';
                    echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" class="'.$field['size'].'"/>'.$field['suffix'];
                    echo '<p>'.$field['desc'].'</p>';  
                break;


                /* color picker
                ===================*/
                case 'color':
                    if( $field['note'] ){
                        echo '<p class="note">'.$field['note'].'</p>';
                    }
                    $default_color = '';
                    if ( isset($value['std']) ) {
                        if ( $meta !=  $field['std'] )
                            $default_color = ' data-default-color="' .$field['std'] . '" ';
                    }
                    echo '<label for="'.$field['id'].'">'.$field['label'].'</label><br/>';
                    echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" class="pt-color"'.$default_color.'/>';
                    echo '<p>'.$field['desc'].'</p>';  
                break;


                /* textarea
                ===================*/
                case 'textarea':
                    if( $field['note'] ){
                        echo '<p class="note">'.$field['note'].'</p>';
                    }
                    echo '<label for="'.$field['id'].'">'.$field['label'].'</label><br/>';
                    echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="50" rows="4">'.$meta.'</textarea>';
                    echo '<p>'.$field['desc'].'</p>';  
                break;


                /* editor
                ===================*/
                case 'editor':
                    if( $field['note'] ){
                        echo '<p class="note">'.$field['note'].'</p>';
                    }
                    echo '<label for="'.$field['id'].'">'.$field['label'].'</label><br/>';
                    wp_editor( $meta, $field['id'], array( 'textarea_name' => $field['id'], 'textarea_rows' =>  15, 'teeny' => true, 'quicktags' => true, 'media_buttons' => true ) );
                    echo '<p>'.$field['desc'].'</p>';  
                break;


                /* checkbox
                ===================*/
                case 'checkbox':
                    if( $field['note'] ){
                        echo '<p class="note">'.$field['note'].'</p>';
                    }
                    echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'"', checked($meta, '1'), '/>';
                    echo '<label for="'.$field['id'].'">'.$field['label'].'</label>';
                    echo '<p>'.$field['desc'].'</p>';  
                break;


                /* select
                ===================*/
                case 'select':
                    if( $field['note'] ){
                        echo '<p class="note">'.$field['note'].'</p>';
                    }
                    echo '<label for="'.$field['id'].'">'.$field['label'].'</label><br/>';
                    echo '<select name="'.$field['id'].'" id="'.$field['id'].'" class="'.$field['size'].'">';
                    foreach ( $field['options'] as $key => $option ){
                        echo '<option ', selected($meta, $key), ' value="'.esc_attr( $key ).'">'.esc_html( $option ).'</option>';  
                    } 
                    echo '</select>';
                    echo '<p>'.$field['desc'].'</p>';  
                break;


                /* upload
                ===================*/
                case 'upload':
                    $preview = '';
                    if($meta && preg_match('/(\.jpg|\.png|\.gif|\.bmp)$/', $meta)){
                        $image_id = premitheme_get_attachment_id_by_src($meta);
                        $image = wp_get_attachment_image_src($image_id, 'medium');
                        $preview = '<img src="'.$image[0].'" class="upload-preview-img" alt="" style="display:none;" width="150px"/>';
                    }
                    if( $field['note'] ){
                        echo '<p class="note">'.$field['note'].'</p>';
                    }
                    echo '<label for="'.$field['id'].'">'.$field['label'].'</label><br/>';
                    echo '<ul><li><input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" placeholder="'.__('No file chosen', 'premitheme').'"/> ';
                    echo '<input type="button" name="upload_image_button" class="upload_img button" value="'. __('Upload', 'premitheme') .'" /> ';
                    echo '<a title="'.__('Remove', 'premitheme').'" class="value-remove button" href="#"><i class="fa fa-trash-o"></i></a>';
                    echo $preview.'</li></ul>';
                    echo '<p>'.$field['desc'].'</p>';  
                break;


                /* multiple upload
                ===================*/
                case 'multi_upload':
                    if( $field['note'] ){
                        echo '<p class="note">'.$field['note'].'</p>';
                    }
                    echo '<label for="'.$field['id'].'">'.$field['label'].'</label><br/>';
                    echo '<ul id="'.$field['id'].'-repeatable" class="field_repeatable field-sortable">';
                    $i = 0;
                    $preview = '';
                    if ($meta_array) {
                        foreach($meta_array as $meta){
                            if($meta != ''){
                                $image_id = premitheme_get_attachment_id_by_src($meta);
                                $image = wp_get_attachment_image_src($image_id, 'medium');
                                $preview = '<img src="'.$image[0].'" class="upload-preview-img" alt="" style="display:none;" width="150px"/>';
                            }
                            echo '<li>
                                    <span class="sort hndle button" title="'.__('Drag to sort', 'premitheme').'"><i class="fa fa-bars"></i></span>
                                    <input class="increment-item" type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="'.$meta.'" placeholder="'.__('No file chosen', 'premitheme').'"/>
                                    <input type="button" name="upload_image_button" class="upload_img button" value="'. __('Upload', 'premitheme') .'" />
                                    <a title="'.__('Remove', 'premitheme').'" class="repeatable-field-remove button" href="#"><i class="fa fa-trash-o"></i></a>'.$preview.'</li>';
                            $i++;
                        }
                    } else {
                        echo '<li>
                                <span class="sort hndle button" title="'.__('Drag to sort', 'premitheme').'"><i class="fa fa-bars"></i></span>
                                <input class="increment-item" type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value=""  placeholder="'.__('No file chosen', 'premitheme').'"/>
                                <input type="button" name="upload_image_button" class="upload_img button" value="'. __('Upload', 'premitheme') .'" />
                                <a title="'.__('Remove', 'premitheme').'" class="repeatable-field-remove button" href="#"><i class="fa fa-trash-o"></i></a></li>';
                    }
                    echo '</ul>';
                    echo '<a class="repeatable-add button" href="#"><i class="fa fa-plus-circle"></i> '.__('Add Image', 'premitheme').'</a>';
                    echo '<p>'.$field['desc'].'</p>';  
                break;

                /* separator
                ===================*/
                case 'sep':
                    echo '<div class="sep"></div>';
                break;

                /* heading
                ===================*/
                case 'heading':
                    echo '<h4>'.$field['label'].'</h4>';
                break;

            } ?>
        </div>
    <?php
    } // endforeach
}
