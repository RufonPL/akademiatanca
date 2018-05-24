<?php  
function rfs_custom_editor_btns() {
    global $typenow;
    // check user permissions
    if(!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
    return;
    }
    // verify the post type
    if(!in_array( $typenow, array('post', 'page')))
        return;
    // check if WYSIWYG is enabled
    if(get_user_option('rich_editing') == 'true') {
        add_filter('mce_external_plugins', 'rfs_add_tinymce_plugin');
        add_filter('mce_buttons', 'rfs_register_custom_editor_btns');
    }
}
add_action('admin_head', 'rfs_custom_editor_btns');

function rfs_add_tinymce_plugin($plugin_array) {
    $plugin_array['rfs_signup_btn'] = get_template_directory_uri().'/inc/custom-editor-btns/custom-editor-btns.js';
    return $plugin_array;
}
function rfs_custom_editor_btns_css() {
    wp_enqueue_style('rfs_custom_editor_btns', get_template_directory_uri().'/inc/custom-editor-btns/custom-editor-btns.css');
}
add_action('admin_enqueue_scripts', 'rfs_custom_editor_btns_css');

function rfs_register_custom_editor_btns($buttons) {
   array_push($buttons, 'rfs_signup_btn');
   return $buttons;
}
?>