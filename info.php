<?php

/**
 * Info setup
 * @package wpacademy
 */
function wpacademy_details_setup(){
    $info = array(
        //welcome message
        'welcome-texts' => sprintf(esc_html__('Howdy %1$s, we would like to thank you for installing and activating %2$s theme for your precious site. All of the features provided by the theme are now ready to use. Here, we have gathered all of the essential details and helpful links for you and your better experience with %2$s. Once again, Thanks for using our theme!', 'wpacademy'), get_bloginfo('name'), 'wpAcademy'),
        //geting started section
        'getting_started'=> array(
            'one' => array(
                'title'       => esc_html__( 'Theme Documentation', 'wpacademy' ),
                'icon'        => 'dashicons dashicons-format-aside',
                'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'wpacademy' ),
                'button_text' => esc_html__( 'View Documentation', 'wpacademy' ),
                'button_url'  => 'https://wiki.hsoub.com/%D8%A7%D9%84%D8%B5%D9%81%D8%AD%D8%A9_%D8%A7%D9%84%D8%B1%D8%A6%D9%8A%D8%B3%D9%8A%D8%A9',
                'button_type' => 'link',
                'is_new_tab'  => true,
            ),
            'two' => array(
                'title'       => esc_html__( 'Static Front Page', 'wpacademy' ),
                'icon'        => 'dashicons dashicons-admin-generic',
                'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page & assign "Home" template from page attributes.', 'wpacademy' ),
                'button_text' => esc_html__( 'Static Front Page', 'wpacademy' ),
                'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
                'button_type' => 'primary'      
            ),
            'three' => array(
                'title'       => esc_html__( 'Theme Options', 'wpacademy' ),
                'icon'        => 'dashicons dashicons-admin-customizer',
                'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'wpacademy' ),
                'button_text' => esc_html__( 'Customize', 'wpacademy' ),
                'button_url'  => wp_customize_url(),
                'button_type' => 'primary',
            ),
            'four' => array(
                'title'       => esc_html__( 'Widgets', 'wpacademy' ),
                'icon'        => 'dashicons dashicons-welcome-widgets-menus',
                'description' => esc_html__( 'Theme uses Wedgets API for widget options. Using the Widgets you can easily customize different aspects of the theme.', 'wpacademy' ),
                'button_text' => esc_html__( 'Widgets', 'wpacademy' ),
                'button_url'  => admin_url('widgets.php'),
                'button_type' => 'primary',
            ),
        )
        );
                Wpacademy_Dashboard_Page::init( $info );

}
add_action('after_setup_theme', 'wpacademy_details_setup');
