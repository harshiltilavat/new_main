<?php

function load_css_scripts()
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');

    wp_enqueue_style('bootstrap');

    wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), false, 'all');

    wp_enqueue_style('main');

    wp_register_style('custom-style', get_template_directory_uri() . '/css/custom.css', array(), false, 'all');

    wp_enqueue_style('custom-style');
}
add_action('wp_enqueue_scripts', 'load_css_scripts');


function add_nav_menus()
{

    register_nav_menus(array(

        'nav-menu' => 'Navigation Bar',

    ));
}
add_action('init', 'add_nav_menus');


/* Custom Shortcode without parameters */

function custom_shortcode()
{

    $catObject = get_queried_object_id();


    $category_posts = new WP_Query(array('post_type' => 'custom_post', 'cat' => $catObject));


    if ($category_posts->have_posts()) :

        while ($category_posts->have_posts()) : $category_posts->the_post(); ?>


            <h1><a href=<?php the_permalink(); ?>><?php the_title(); ?></a></h1>

    <?php

        endwhile;

        wp_reset_postdata();

    else :
        echo "Oops, there are no posts";

    endif;
    
}
add_shortcode('custom', 'custom_shortcode');


/* Custom Shortcode with parameters */

function dynamic_image($atts = '')
{
    $value = shortcode_atts(array(
        'width' => 300,
        'height' => 250,
    ), $atts);

    $img_path = get_template_directory_uri() . '/images/test.jpg';
    ?>
    <img src="<?php echo $img_path; ?>" height="<?php echo $value['height']; ?>" width="<?php echo $value['width']; ?>" />

<?php
}
add_shortcode('image', 'dynamic_image');

function shortcode_social_links($atts = '')
{
    $args = shortcode_atts(array(

        'fb_username' => 'owthub',
        'tw_username' => 'owthub'

    ), $atts);

    $facebook = "<a href='https://www.facebook.com/" . $args['fb_username'] . "'>Follow Us On facebook</a>";
    $twitter = "<a href='https://www.twitter.com/" . $args['tw_username'] . "'>Follow Us On Twitter</a>";

    $output = $facebook . '</br>' . $twitter;

    return $output;
}
add_shortcode('social_links', 'shortcode_social_links');

function create_custom_post_type()
{
    $labels = array(
        'name' => 'Custom Posts',
        'singular_name' => 'Custom Post',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Custom Post',
        'edit_item' => 'Edit Custom Post',
        'new_item' => 'New Custom Post',
        'view_item' => 'View Custom Post',
        'search_items' => 'Search Custom Posts',
        'not_found' => 'No custom posts found',
        'not_found_in_trash' => 'No custom posts found in Trash',
        'featured_image' => 'Featured Image',
        'set_featured_image' => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image' => 'Use as featured image',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'rewrite' => array('slug' => 'custom-posts'),
        'has_archive' => true,
        'taxonomies' => array('category'),
    );

    register_post_type('custom_post', $args);
}

add_theme_support('post-thumbnails');
add_image_size( 'single-post-thumbnail', 590, 180 );
add_action('init', 'create_custom_post_type');


function assign_category_to_new_post($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if ($parent_id = wp_is_post_revision($post_id)) $post_id = $parent_id;

    if (wp_is_post_autosave($post_id) || wp_is_post_revision($post_id) || get_post_type($post_id) !== 'custom_post') {
        return;
    }

    wp_set_post_categories($post_id, array(get_cat_ID('uncategorized'))); 
}

add_action('save_post', 'assign_category_to_new_post');


function enqueue_custom_scripts()
{
    wp_enqueue_script('jquery-lib', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), null, true);

    wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/js/custom.scripts.js', array('jquery'), '1.0', true);


    wp_localize_script('custom-scripts', 'form_submission_data', array(
        'mynonce' => wp_create_nonce('handle_form_submission_data'),
        'myajaxurl' => admin_url('admin-ajax.php')
    ));
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


function my_ajax_call_handler()
{

    $nonce = $_POST['mynonce'];

    if (!check_ajax_referer('handle_form_submission_data', 'mynonce', false)) 
    {
        echo "invalid";
        die();
    } 
    else 
    {
        if (isset($_POST['action']) && $_POST['action'] === 'form_submission_data') 
        {

            $username = sanitize_text_field($_POST['username']);

            $email = sanitize_email($_POST['email']);            

            $gender = isset($_POST['gender']) ? sanitize_text_field($_POST['gender']) : '';            

            $mobile = sanitize_text_field($_POST['mobile']);            

            $hobbies = sanitize_text_field($_POST['hobbies']);

            $post_args = array(
                'post_title' => $username." - ".$email,
                'post_type' => 'custom_post',
                'post_content' => 'Hello World',
                'post_status' => 'publish',
                'meta_input' => array(
                                    'email' => $email,
                                    'gender' => $gender,
                                    'mobile' => $mobile,
                                    'hobbies' => $hobbies
                                ));

            $post_id = wp_insert_post($post_args);  

            $field_key = "field_64ce06711f2c3";

            $hobbo = explode(",",$hobbies);           
            
            update_field( $field_key, $hobbies, $post_id );    


            if (isset($_FILES['profile_image'])) 
            {
                $upload = wp_upload_bits($_FILES['profile_image']['name'], null, file_get_contents($_FILES['profile_image']['tmp_name']));
                
                if (!$upload['error']) {
                    $filename = $upload['file'];
                                        
                    $wp_filetype = wp_check_filetype($filename, null);
                    $attachment = array(
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title' => sanitize_file_name($_FILES['profile_image']['name']),
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );
                    
                    $attachment_id = wp_insert_attachment($attachment, $filename, $post_id);
                    
                    if (!is_wp_error($attachment_id)) {
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                        
                        
                        $attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
                        wp_update_attachment_metadata($attachment_id, $attachment_data);
                        
                        
                        set_post_thumbnail($post_id, $attachment_id);
                    }
                }
            }           
            
            echo 'success';

            wp_die();

        }
    }

}
add_action('wp_ajax_form_submission_data', 'my_ajax_call_handler');
add_action('wp_ajax_nopriv_form_submission_data', 'my_ajax_call_handler');  
