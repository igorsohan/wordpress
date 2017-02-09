<?php
/**
 * course functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package course
 */

if ( ! function_exists( 'course_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function course_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on course, use a find and replace
	 * to change 'course' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'course', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'course' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'course_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'course_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function course_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'course_content_width', 640 );
}
add_action( 'after_setup_theme', 'course_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function course_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'course' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'course' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'course' ),
		'id' => 'sidebar-2',
		'description' => __( 'The main sidebar appears on the right on each
		page except the front page template', 'course' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );

	register_sidebar( array(
		'name' =>__( 'Front page sidebar', 'course'),
		'id' => 'sidebar-3',
		'description' => __( 'Appears on the static front page template',
		'course' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );

}
add_action( 'widgets_init', 'course_widgets_init' );



/**
 * Enqueue scripts and styles.
 */
function course_scripts() {
	wp_enqueue_style( 'course-style', get_stylesheet_uri() );

	wp_enqueue_script( 'course-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'course-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'course_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 *Enable the specific formats.
 */
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'video', 'status', 'image', 'quote', 'chat', 'audio' ) );

function course_register_theme_customizer( $wp_customize ) {

	// Add new section
	$wp_customize->add_section(
	    'course_display_options',
	    array(
	        'title'     =>  'New setting',
	        'priority'  => 200,
	    )
	);

	//Add settings
	$wp_customize->add_setting(
	    'course_link_header',
	    array(
	        'section' => 'course_display_options',
	        'default'     => 'TRUE',
	        'transport'   => 'postMessage',
	    )
	);

	// add control
	$wp_customize->add_control(
	     'course_link_header',
	        array(
	            'label'      => 'New section',
	            'section'    => 'course_display_options',
	            'type'   => 'cheackbox'
	        )
	   
	);


    //Add settings
	$wp_customize->add_setting(
	    'course_link_color',
	    array(
	        'default'     => '#000000',
	        'transport'   => 'postMessage'
	    )
	);

	// add control
	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'link_color',
	        array(
	            'label'      => __( 'Link Color', 'course' ),
	            'section'    => 'colors',
	            'settings'   => 'course_link_color'
	        )
	    )
	);

	

}

add_action( 'customize_register', 'course_register_theme_customizer');

// Update Settings
function course_customizer_css() {
    ?>
    <style type="text/css">
        a { color: <?php echo get_theme_mod( 'course_link_color' ); ?>; }
    </style>
    <?php
}
add_action( 'wp_head', 'course_customizer_css' );

// Add live preview function and registering new JS file
function course_customizer_live_preview() {
    wp_enqueue_script(
        'course-theme-customizer',
        get_template_directory_uri() . '/js/theme-customizer.js',
        array( 'jquery', 'customize-preview' ),
        '0.3.0',
        true
    );
}
add_action( 'customize_preview_init', 'course_customizer_live_preview' );
