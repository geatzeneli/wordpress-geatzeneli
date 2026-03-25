<?php
/**
 * Theme Functions and Definitions
 * Theme: Digital School Custom
 */

/**
 * 1. Enqueue Scripts and Styles
 */
function ds_theme_assets() {

    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css',
        array(),
        '4.6.2',
        'all'
    );

    wp_enqueue_style(
        'ds-style',
        get_stylesheet_uri(),
        array( 'bootstrap-css' ),
        '1.3',
        'all'
    );

    wp_enqueue_style(
        'slider-style',
        get_template_directory_uri() . '/css/slider.css',
        array( 'ds-style' ),
        '1.0',
        'all'
    );

    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js',
        array( 'jquery' ),
        '4.6.2',
        true
    );

    wp_enqueue_script(
        'ds-script',
        get_template_directory_uri() . '/js/custom.js',
        array( 'jquery', 'bootstrap-js' ),
        '1.0',
        true
    );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'ds_theme_assets' );


/**
 * 2. Theme Setup
 */
function ds_setup() {
    add_theme_support( 'menus' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-formats', array( 'aside', 'image', 'video' ) );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'ds_theme' ),
    ) );
}
add_action( 'after_setup_theme', 'ds_setup' );


/**
 * 3. Register Sidebar
 */
function ds_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Primary Sidebar', 'ds_theme' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'ds_widgets_init' );


/**
 * 4. Custom Widget: Foo Widget
 */
class Foo_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'foo_widget', __( 'A Foo Widget', 'ds_theme' ) );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'] . '<p>Hello World</p>' . $args['after_widget'];
    }

    public function form( $instance ) {
        echo '<p>No options yet</p>';
    }

    public function update( $new_instance, $old_instance ) {
        return $new_instance;
    }
}

function ds_register_widgets() {
    register_widget( 'Foo_Widget' );
}
add_action( 'widgets_init', 'ds_register_widgets' );


/**
 * 5. Dynamic Post Limiting (User Session Based)
 */
function my_limit_posts_on_index( $query ) {
    if ( ! is_admin() && $query->is_main_query() && ( is_home() || is_archive() ) ) {

        if ( ! session_id() && ! headers_sent() ) {
            session_start();
        }

        $limit = isset( $_SESSION['user_post_limit'] ) ? intval( $_SESSION['user_post_limit'] ) : 5;

        $query->set( 'posts_per_page', $limit );
    }
}
add_action( 'pre_get_posts', 'my_limit_posts_on_index' );


/**
 * 6. Custom Post Type: Movies
 */
function our_custom_movie() {
    $labels = array(
        'name'               => _x( 'Movies', 'post type general name', 'ds_theme' ),
        'singular_name'      => _x( 'Movie', 'post type singular name', 'ds_theme' ),
        'add_new'            => _x( 'Add New', 'movie', 'ds_theme' ),
        'add_new_item'       => __( 'Add New Movie', 'ds_theme' ),
        'edit_item'          => __( 'Edit Movie', 'ds_theme' ),
        'new_item'           => __( 'New Movie', 'ds_theme' ),
        'all_items'          => __( 'All Movies', 'ds_theme' ),
        'view_item'          => __( 'View Movie', 'ds_theme' ),
        'search_items'       => __( 'Search Movies', 'ds_theme' ),
        'not_found'          => __( 'No movies found', 'ds_theme' ),
        'not_found_in_trash' => __( 'No movies found in the Trash', 'ds_theme' ),
        'menu_name'          => __( 'Movies', 'ds_theme' ),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => 'Movies and single movie details',
        'public'             => true,
        'publicly_queryable' => true,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'movies' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'movies', $args );
}
add_action( 'init', 'our_custom_movie' );


/**
 * 7. Register Taxonomies: Movie Genres & Movie Tags
 */
function register_taxonomy_movie_genres() {

    // --- Movie Genres (hierarchical, like categories) ---
    $genre_labels = array(
        'name'              => _x( 'Movie Genres', 'taxonomy general name', 'ds_theme' ),
        'singular_name'     => _x( 'Movie Genre', 'taxonomy singular name', 'ds_theme' ),
        'search_items'      => __( 'Search Movie Genres', 'ds_theme' ),
        'all_items'         => __( 'All Movie Genres', 'ds_theme' ),
        'parent_item'       => __( 'Parent Movie Genre', 'ds_theme' ),
        'parent_item_colon' => __( 'Parent Movie Genre:', 'ds_theme' ),
        'edit_item'         => __( 'Edit Movie Genre', 'ds_theme' ),
        'update_item'       => __( 'Update Movie Genre', 'ds_theme' ),
        'add_new_item'      => __( 'Add New Movie Genre', 'ds_theme' ),
        'new_item_name'     => __( 'New Movie Genre Name', 'ds_theme' ),
        'menu_name'         => __( 'Movie Genres', 'ds_theme' ),
    );

    $genre_args = array(
        'hierarchical'      => true,
        'labels'            => $genre_labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'movie-genre' ),
    );

    register_taxonomy( 'movie_genres', array( 'movies' ), $genre_args );

    // --- Movie Tags (flat, like post tags) ---
    $tag_labels = array(
        'name'          => _x( 'Movie Tags', 'taxonomy general name', 'ds_theme' ),
        'singular_name' => _x( 'Movie Tag', 'taxonomy singular name', 'ds_theme' ),
        'search_items'  => __( 'Search Movie Tags', 'ds_theme' ),
        'all_items'     => __( 'All Movie Tags', 'ds_theme' ),
        'edit_item'     => __( 'Edit Movie Tag', 'ds_theme' ),
        'update_item'   => __( 'Update Movie Tag', 'ds_theme' ),
        'add_new_item'  => __( 'Add New Movie Tag', 'ds_theme' ),
        'new_item_name' => __( 'New Movie Tag Name', 'ds_theme' ),
        'menu_name'     => __( 'Movie Tags', 'ds_theme' ),
    );

    $tag_args = array(
        'hierarchical'      => false,
        'labels'            => $tag_labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'movie-tags' ),
    );

    register_taxonomy( 'movietags', array( 'movies' ), $tag_args );
}
add_action( 'init', 'register_taxonomy_movie_genres' );