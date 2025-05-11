<?php
/**
 * Academy Dashboard page
 * @package Academy
 */
class Wpacademy_Dashboard_Page {
    private $info;
    private $theme_name;
    private $theme_version;
    private $page_slug;
    private $page_url;
    private $notice;

    /** @var Wpacademy_Dashboard_Page $instance */
    private static $instance;

    public static function init($info){
        self::$instance = new self;
        if (!empty($info) && is_array($info)) {
            self::$instance->info = $info;
            self::$instance->configure();
            self::$instance->hooks();
        }
    }

    public function configure(){
        $theme = wp_get_theme();
        $this->theme_name = $theme->get('Name');
        $this->theme_version = $theme->get('Version');
        $this->page_slug = strtolower(str_replace(' ', '_', $this->theme_name)) . '_options';
        $this->page_url = admin_url('admin.php?page=' . $this->page_slug);

        $this->notice = '<p>' . sprintf(
            esc_html__('Welcome! Thank you for choosing %1$s. To fully take advantage of our theme features, please make sure you visit theme details page.', 'wpacademy'),
            esc_html($this->theme_name)
        ) . '</p><p><a href="' . esc_url($this->page_url) . '" class="button button-primary">' .
        esc_html(sprintf(__('Get started with %1$s', 'wpacademy'), $this->theme_name)) .
        '</a>&nbsp;<a href="themes.php?dismiss=true" class="button button-secondary">' .
        esc_html__('Dismiss this notice', 'wpacademy') . '</a></p>';
    }

    // render the dashboard page
    public function render_page(){
    ?>
    <div class="wrap about-wrap">
        <h1><?php echo esc_html($this->theme_name); ?>&nbsp;-&nbsp;<?php echo esc_html($this->theme_version); ?></h1>
        <div style="display:flex;">
            <?php if (isset($this->info['welcome-texts']) && !empty($this->info['welcome-texts'])): ?>
                <div style="display:flex;">
                    <p class="about-text">
                        <?php echo esc_html($this->info['welcome-texts']); ?>
                    </p>
                </div>
            <?php endif; ?>

            <a href="https://academy.hsoub.com" target="_blank">
                <img src="<?php echo get_template_directory_uri() . "/assets/images/logo_160x160.png"; ?>" alt="" style="width:160px; height:86px">
            </a>
        </div>

        <div style="border-bottom:0.5rem solid #cccccc; padding-top:1rem; margin:0; padding-bottom:0;"></div>

        <?php
        if (isset($this->info['getting_started']) && !empty($this->info['getting_started'])) {
            $this->getting_startedd();
        }
        ?>

        <div style="border-bottom:0.5rem solid #cccccc; padding-top:1rem; margin:0; padding-bottom:0;"></div>
      <form action="options.php" method="post">
        <?php
        settings_fields('academy_settings');
        do_settings_sections('academy_Options');
        submit_button();
        ?>
      </form>
    </div>
    <?php
}

public function getting_startedd(){
    $content = isset($this->info['getting_started']) ? $this->info['getting_started'] : array();
    ?>
    <div style="display:flex; justify-content:space-between;">
        <?php
        foreach ($content as $item):
            $this->render_item_info($item);
        endforeach;
        ?>
    </div>
    <?php
}

 /* render item info for getting started section
 */
private function render_item_info($item){
    ?>
    <div style="margin-top:20px; margin-right:10px; flex:1;align-self:flex-start;">
        <?php if(isset($item['title']) && !empty($item['tittle'])):?>
            <h3>
             <?php if(isset($item['icon']) && !empty($item['icon'])):?>
             <span class="<?php echo esc_attr($item['icon']); ?>"></span>
             <?php endif; ?>
             <?php echo esc_html($item['title']); ?>
            </h3>
        <?php endif; ?>
                 <?php if(isset($item['description']) && !empty($item['description'])):?>
                  <p>
                    <?php 
                    echo wp_kses_post($item['description']);
                    ?>
                  </p>
                  <?php endif; ?>
                  <?php if(isset($item['button_text']) && !empty($item['button_text']) && isset($item['button_url'])&& !empty($item['button_url'])): ?>
                    <?php 
                    $button_target = (isset($item['is_new_tab']) && true === $item['is_new_tab']) ? '_blank' : '_self';
                     $button_class='';
                     if (isset($item['button_type']) && !empty($item['button_type'])) {
                        if('primary' === $item['button_type']){
                            $button_class='button button-primary';

                        }
                       elseif('secondary' === $item['button_type']){
                            $button_class='button button-secondary';

                        }
                     }
                     ?>
                     <a href="<?php echo esc_url($item['button_url']); ?>"
                     class="<?php echo esc_attr($button_class) ;?>"
                     target="<?php echo esc_attr($button_target); ?>" >
                     <?php echo esc_html($item['button_text']); ?>
                    </a>
                    <?php endif; ?>
                    </div>
                    <?php
}

     public function display_admin_notice() {
        $screen_id = null;
        $current_screen = get_current_screen();
        if ($current_screen) {
            $screen_id = $current_screen->id;
        }

        $user_id = get_current_user_id();
        add_user_meta($user_id, 'academy_dismiss_status', 0);
        if (isset($_GET['dismiss'])) {
            update_user_meta($user_id, 'academy_dismiss_status', 1);
        }

        $dismiss_status = get_user_meta($user_id, 'academy_dismiss_status', true);

        if (current_user_can('edit_theme_options') && 'themes' === $screen_id && 1 !== absint($dismiss_status)) : ?>
            <div class="notice notice-info">
                <?php echo $this->notice; ?>
            </div>
        <?php endif;
    }
    //handle theme page
    public function theme_change(){
        $user_id = get_current_user_id();
        update_user_meta($user_id,'academy_dismiss_status',0);
    }

    //  register settings for theme options
    public function academy_theme_settings(){
       register_setting('academy_settings','copyright');
       register_setting('academy_settings','author');
       register_setting('academy_settings','authorurl');
       register_setting('academy_settings','admin_logo_url');

       add_settings_section(
        'academy_settings',
        __('Academy Theme Options','academy'),
        array($this,'academy_callback'),
        'academy_Options'
       );

        add_settings_field(
            'copyright',
            __('Copyrights','academy'),
            array($this,'copyright_callback'),
             'academy_Options',
              'academy_settings'
        );
         add_settings_field(
            'author',
            __('Author Name:','academy'),
            array($this,'author_callback'),
             'academy_Options',
              'academy_settings'
        );
         add_settings_field(
            'authorurl',
            __('Author website:','academy'),
            array($this,'authorurl_callback'),
             'academy_Options',
             'academy_settings'
        );
        add_settings_field(
            'admin_logo_url',
            __('login page logo:','academy'),
            array($this,'admin_logo_url_callback'),
             'academy_Options',
             'academy_settings'
        );

    }
    //callback function for academy theme section
    public function academy_callback(){
        ?>
        <h3><?php echo __('Admin dashboard footer','academy'); ?></h3>
       <?php
    }

    public function copyright_callback($args){
        ?>
          <input type="text" name="copyright" id="copyright" value='<?php echo get_option('copyright'); ?>'>        
        <?php
        }
        
    public function author_callback($args){
        ?>
          <input type="text" name="author" id="author" value='<?php echo get_option('author'); ?>'>        
        <?php
        }
         public function authorurl_callback($args){
        ?>
          <input type="text" name="authorurl" id="authorurl" value='<?php echo get_option('authorurl'); ?>'>        
        <?php
        }
        //callback function for Admin logo URL field
        public function admin_logo_url_callback($args){
            $default_image=get_template_directory_uri().'/assets/images/logo_160x160.png';
            $admin_logo_url = get_option('admin_logo_url',$default_image);
            ?>
            <input type="hidden" name="admin_logo_url" id="admin_logo_url" value='<?php echo esc_attr($admin_logo_url);?>'>
            <br>
            <img id="preview" style="width:115px;height:115px;"
             data-src="<?php echo esc_attr($default_image);?>"
              src="<?php echo esc_attr($admin_logo_url); ?>">
              <br>
              <button class="upload_image_button button">
                <?php echo __('Upload','academy'); ?>
              </button>
              <button class="remove_image_button button">
               &times;
            </button>
            <?php
            }

            /**
             * enqueue admin scripts
             */
            public function academy_load_admin_scripts(){
                wp_enqueue_media();
                wp_enqueue_script('academy-admin',get_template_directory_uri().'/js/admin.js',array('jquery'));

            }
    // register dashboard page
    public function register_dashboard_page(){
        add_menu_page(
           "Academy",__("Academy","academy"),
            'manage_options',
            $this->page_slug,
            array($this, 'render_page'),
            get_template_directory_uri() . '/assets/images/logo_20x20.png',
            2
        );
    }

    public function hooks(){
        add_action('admin_menu', array($this, 'register_dashboard_page'));
        add_action('admin_notices', array($this, 'display_admin_notice'));
        add_action('switch_theme', array($this, 'theme_change'));
        add_action('admin_init', array($this, 'academy_theme_settings'));
       add_action('admin_enqueue_scripts', array($this, 'academy_load_admin_scripts'));

    }   
}
