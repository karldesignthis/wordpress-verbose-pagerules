/*
 * The following filters force verbose page rules to be true
 * then make sure that page rules are processed BEFORE post type
 * rules; allowing hierarchal page content to be processed before
 * posts in a post type with the same slug as the page parent.
 * I will provide a link to where I found this once I find it again
 */
add_action( 'init', 'nerdpress_init' );
function nerdpress_init() {
    $GLOBALS['wp_rewrite']->use_verbose_page_rules = true;
 
}
 
add_filter( 'page_rewrite_rules', 'nerdpress_collect_page_rewrite_rules' );
function nerdpress_collect_page_rewrite_rules( $page_rewrite_rules )
{
    $GLOBALS['nerdpress_page_rewrite_rules'] = $page_rewrite_rules;
    return array();
}
 
add_filter( 'rewrite_rules_array', 'nerdpress_prepend_page_rewrite_rules' );
function nerdpress_prepend_page_rewrite_rules( $rewrite_rules )
{
    return $GLOBALS['nerdpress_page_rewrite_rules'] + $rewrite_rules;
}