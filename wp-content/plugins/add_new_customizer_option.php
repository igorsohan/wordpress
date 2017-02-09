<?php 
function course_register_theme_customizer( $wp_customize ) {
    // more to come...
}
add_action( 'customize_register', 'course_register_theme_customizer' );


//Add settings
$wp_customize->add_setting(
	    'course_link_color',
	    array(
	        'default'     => '#000000'
	    )
	);


// add control
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'link_color',
        array(
            'label'      => __( 'Link Color', 'tcx' ),
            'section'    => 'colors',
            'settings'   => 'course_link_color'
        )
    )
); 


// Update Settings
function course_customizer_css() {
    ?>
    <style type="text/css">
        a { color: <?php echo get_theme_mod( 'course_link_color' ); ?>; }
    </style>
    <?php
}
add_action( 'wp_head', 'course_customizer_css' );


// Update options
$wp_customize->add_setting(
    'course_link_color',
    array(
        'default'     => '#000000',
        'transport'   => 'postMessage'
    )
);


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


// Add new section
$wp_customize->add_section(
    'course_display_options',
    array(
        'title'     => 'Display Options',
        'priority'  => 200
    )
);



