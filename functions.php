<?php
/**
 * Theme Functions and Definitions
 * Theme: Digital School Custom
 */

/**
 * 1. Enqueue Scripts and Styles
 */
function ds_theme_assets() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css', array(), '4.6.2', 'all');
    
    wp_enqueue_style('ds-style', get_stylesheet_uri(), array('bootstrap-css'), '1.3', 'all');

    wp_enqueue_style('slider-style', get_template_directory_uri() . '/css/slider.css', array('ds-style'), '1.0', 'all');

    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '4.6.2', true);

    wp_enqueue_script('ds-script', get_template_directory_uri() . '/js/custom.js', array('jquery', 'bootstrap-js'), '1.0', true);

    if ( is_singular() && comments_open() && get_option('thread_comments') ) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'ds_theme_assets');

/**
 * 2. Theme Setup
 */
function ds_setup() {
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('post-formats', array('aside', 'image', 'video'));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'ds_theme'),
    ));
}
add_action('after_setup_theme', 'ds_setup');

/**
 * 3. Register Sidebar
 */
function ds_widgets_init() {
    register_sidebar(array(
        'name'          => __('Primary Sidebar', 'ds_theme'),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'ds_widgets_init');

/**
 * 4. Custom Widget: Foo Widget
 */
class Foo_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct('foo_widget', __('A Foo Widget', 'ds_theme'));
    }
    public function widget($args, $instance) {
        echo $args['before_widget'] . '<p>Hello World</p>' . $args['after_widget'];
    }
    public function form($instance) { echo '<p>No options yet</p>'; }
    public function update($new_instance, $old_instance) { return $new_instance; }
}
function ds_register_widgets() { register_widget('Foo_Widget'); }
add_action('widgets_init', 'ds_register_widgets');

/**
 * 5. Dynamic Post Limiting (User Session Based)
 * This checks if the user has set a preference on your new settings page.
 */
function my_limit_posts_on_index($query) {
    if ( !is_admin() && $query->is_main_query() && (is_home() || is_archive()) ) {
        
        // Start session to read user preference
        if ( !session_id() ) { session_start(); }

        if ( isset($_SESSION['user_post_limit']) ) {
            // Use what the user chose on the settings page
            $limit = $_SESSION['user_post_limit'];
        } else {
            // Default fallback if they haven't visited the settings page yet
            $limit = 5; 
        }
        
        $query->set('posts_per_page', $limit);
    }
}
add_action('pre_get_posts', 'my_limit_posts_on_index');