<?php
/**
 * Academy Social Icons Widget
 */
class Social_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array(
            'classname' => 'social_widget',
            'description' => __('This widget displays the social icons', 'academy'),
            'customize_selective_refresh' => true,
        );
        parent::__construct(
            'social_widget',
            __('Academy Social Icons', 'academy'),
            $widget_ops
        );
    }

    public function form($instance) {
        $fields = array(
            'title' => __('Widget Title', 'academy'),
            'facebook' => __('Facebook', 'academy'),
            'twitter' => __('Twitter', 'academy'),
            'instagram' => __('Instagram', 'academy'),
            'linkedin' => __('LinkedIn', 'academy'),
        );

        foreach ($fields as $field => $label) {
            $value = !empty($instance[$field]) ? $instance[$field] : '';
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id($field)); ?>">
                    <?php echo esc_html($label); ?>
                </label>
                <input class="widefat"
                       id="<?php echo esc_attr($this->get_field_id($field)); ?>"
                       name="<?php echo esc_attr($this->get_field_name($field)); ?>"
                       type="text"
                       value="<?php echo esc_attr($value); ?>" />
            </p>
            <?php
        }
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        foreach ($new_instance as $key => $value) {
            $instance[$key] = wp_strip_all_tags($value);
        }
        return $instance;
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        $social_networks = array(
            'facebook' => 'fa-facebook-f',
            'twitter' => 'fa-x-twitter',
            'instagram' => 'fa-instagram',
            'linkedin' => 'fa-linkedin',
        );

        echo '<div class="social-icons">';
        foreach ($social_networks as $network => $icon) {
            if (!empty($instance[$network])) {
                echo '<a class="' . esc_attr($network) . '" href="' . esc_url($instance[$network]) . '" target="_blank">';
                echo '<i class="fa-brands ' . esc_attr($icon) . '"></i>';
                echo '</a> ';
            }
        }
        echo '</div>';

        echo $args['after_widget'];
    }
}

// تسجيل الودجت
function register_social_widget() {
    register_widget('Social_Widget');
}
add_action('widgets_init', 'register_social_widget');
