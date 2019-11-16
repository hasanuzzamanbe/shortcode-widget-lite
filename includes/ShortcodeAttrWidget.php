<?php

namespace ShortcodeAttr\includes;

class ShortcodeAttrWidget extends \WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'shortcode_widget_with_attribute',
            esc_html__('Shortcode Widget Lite', 'shortcodewidgetlite'),
            array('description' => esc_html__('Use shortcode on your widget', 'shortcodewidgetlite'),)
        );
    }

    public function widget($args, $instance)
    {
        $shortcode = empty($instance['shortcode']) ? '' : $instance['shortcode'];
        if (!$shortcode) {
            return;
        }
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        if ($shortcode != '') {
            echo do_shortcode($shortcode);
        }
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('', 'shortcodewidgetlite');
        }
        if (isset($instance['shortcode'])) {
            $shortcode = $instance['shortcode'];
        } else {
            $shortcode = __('', 'shortcodewidgetlite');
        }

        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('shortcode'); ?>"><?php _e('Shortcode :'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('shortcode'); ?>"
                   name="<?php echo $this->get_field_name('shortcode'); ?>" type="text"
                   value="<?php echo esc_attr($shortcode); ?>"/>
        </p>
        <?php
    }

    public function update($new_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['shortcode'] = (!empty($new_instance['shortcode'])) ? strip_tags($new_instance['shortcode']) : '';
        return $instance;
    }
}
