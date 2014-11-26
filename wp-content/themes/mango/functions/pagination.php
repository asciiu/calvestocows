<?php
/* TRADITIONAL PAGINATION
=======================================================*/
function premitheme_pagination() {
    global $wp_query, $wp_rewrite;
    $pages = '';
    $max = $wp_query->max_num_pages;
    if (!$current = get_query_var('paged')) $current = 1;
    $a['base'] = ($wp_rewrite->using_permalinks()) ? user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' ) : @add_query_arg('paged','%#%');
    if( !empty($wp_query->query_vars['s']) ) $a['add_args'] = array( 's' => get_query_var( 's' ) );
    $a['total'] = $max;
    $a['current'] = $current;

    $total = 1;                                         //1 - display the text "Page N of N", 0 - not display
    $a['mid_size'] = 2;                                 //how many links to show on the left and right of the current
    $a['end_size'] = 1;                                 //how many links to show in the beginning and end
    $a['prev_text'] = __('&laquo; Prev', 'premitheme'); //text of the "Previous page" link
    $a['next_text'] = __('Next &raquo;', 'premitheme'); //text of the "Next page" link

    if ($max > 1) echo '<div id="pagination" class="clearfix">';
    if ($total == 1 && $max > 1) $pages = '<span class="pages-counter">'.__('Page', 'premitheme').' '. $current .' '.__('of', 'premitheme').' '. $max .'</span>'."\r\n";
    echo $pages . paginate_links($a);
    if ($max > 1) echo '</div>';
}