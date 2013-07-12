<?php
/**
 * @version 1.1.2
 */
/*
Plugin Name: Widget to search from ofru.ru
Plugin URI: http://ofru.ru/widgets/?l=en
Description: Enables a Custom Search Engine for your site via a widget. To add goto Appearance > Widgets. Thank you for choosing my widget.
Author: Milyutin Aleksandr Vyacheslavovich (Disabled by cerebral palsy)
Donate link: http://ofru.ru/help/en/ 
Version: 1.1.2
Author URI: http://ofru.ru/
License: GPLv2
Copyright 2013 Milyutin Aleksandr Vyacheslavovich (email : admin@ofru.ru)
*/



function widget_to_search_from_ofruru_domain() {
if (preg_match('/^www./', $_SERVER["HTTP_HOST"])) {
$nowww = substr($_SERVER["HTTP_HOST"],4);
} else {
$nowww = $_SERVER["HTTP_HOST"];
}
return $nowww;
}
// Enable translations
add_action('init', 'widget_to_search_from_ofruru_textdomain');
function widget_to_search_from_ofruru_textdomain() {
load_plugin_textdomain('widget_to_search_from_ofruru', false, dirname(plugin_basename(__FILE__)) . '/lang');
} 
class widget_to_search_from_ofruru extends WP_Widget {
function widget_to_search_from_ofruru() {
parent::WP_Widget(false, $name = __('Search this site from', 'widget_to_search_from_ofruru'). ' ofru.ru');
}

function widget($args, $instance) {
extract( $args );
$instance = array_merge( $this->_get_default_options(), $instance );	
?>
<?php echo $before_title
. $instance['title']
. $after_title;
?>
<form target="_blank" action="http://allislocated.ru/" enctype="application/x-www-form-urlencoded" method="get">
<input type="hidden" name="h" value="<?php if ($instance['h'] == 'www.') echo $instance['h']; echo widget_to_search_from_ofruru_domain(); ?>" />
<input type="text" name="q" size="<?php echo $instance['width']; ?>" />
<input type="hidden" name="l" value="<?php echo $instance['lang']; ?>" />
<input type="submit" name="sa" value="<?php _e('Search'); ?>" />
<br><?php if ($instance['helplink']) _e('This widget can be <a target="_blank" href="http://ofru.ru/widgets/?l=en">downloaded here</a>' , 'widget_to_search_from_ofruru'); ?>
</form>
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
$instance['title'] = esc_attr($new_instance['title']);
$instance['lang'] = $new_instance['lang'];
$instance['h'] = $new_instance['h']; 
$instance['helplink'] = $new_instance['helplink'];
$instance['width'] = $new_instance['width'];
return $instance;
}

function form($instance) {
$instance = array_merge( $this->_get_default_options(), $instance );	
$title = esc_attr($instance['title']);
$h = esc_attr($instance['h']);
$lang = esc_attr($instance['lang']);
$helplink = esc_attr($instance['helplink']);
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</label>
</p>
<p>
<label for="<?php echo $this->get_field_id('h'); ?>"><?php _e('Domain:', 'widget_to_search_from_ofruru'); ?>
<br>
<label for='<?php echo $this->get_field_id('h'); ?>WWW'><input class="radio" id='<?php echo $this->get_field_id('h'); ?>WWW' type="radio" name="<?php echo $this->get_field_name('h'); ?>" value="www." <?php if ($h == 'www.') echo 'checked'; ?>><?php echo 'www.'. widget_to_search_from_ofruru_domain(); ?></label>
<br>
<?php _e('or', 'widget_to_search_from_ofruru'); ?>
<br>
<label for='<?php echo $this->get_field_id('h'); ?>NOWWW'><input class="radio" id="<?php echo $this->get_field_id('h'); ?>NOWWW" type="radio" name="<?php echo $this->get_field_name('h'); ?>" value="0" <?php if ($h == '0') echo 'checked'; ?>><?php echo  widget_to_search_from_ofruru_domain(); ?></label>
</label>
</p>
<p>
<label for="<?php echo $this->get_field_id('lang'); ?>"><?php _e('Language site:', 'widget_to_search_from_ofruru'); ?><br>
<label for='<?php echo $this->get_field_id('lang'); ?>LR'><input class="radio" id='<?php echo $this->get_field_id('lang'); ?>LR' type="radio" name="<?php echo $this->get_field_name('lang'); ?>" value="ru" <?php if ($lang == 'ru') echo 'checked'; ?>><?php _e('Russian', 'widget_to_search_from_ofruru'); ?></label>
<br>
<label for='<?php echo $this->get_field_id('lang'); ?>Lua'><input class="radio" id="<?php echo $this->get_field_id('lang'); ?>Lua" type="radio" name="<?php echo $this->get_field_name('lang'); ?>" value="ua" <?php if ($lang == 'ua') echo 'checked'; ?>><?php _e('Ukrainian', 'widget_to_search_from_ofruru'); ?></label>
<br>
<label for='<?php echo $this->get_field_id('lang'); ?>Len'><input class="radio" id="<?php echo $this->get_field_id('lang'); ?>Len" type="radio" name="<?php echo $this->get_field_name('lang'); ?>" value="en" <?php if ($lang == 'en') echo 'checked'; ?>><?php _e('English', 'widget_to_search_from_ofruru'); ?></label>
</label>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Box Width'); ?>:
<input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $instance['width']; ?>" />
</label>
</p>
<label for='<?php echo $this->get_field_id('helplink'); ?>'><input class="checkbox" id="<?php echo $this->get_field_id('helplink'); ?>" type="checkbox" name="<?php echo $this->get_field_name('helplink'); ?>" value="1" <?php if ($helplink) echo 'checked'; ?>><?php _e('Help promote the plugin: "widget to search from ofru.ru"?', 'widget_to_search_from_ofruru'); ?></label>
</p>

<?php
}
 function _get_default_options() {
        return array(
            'title' => __('Search this site from', 'widget_to_search_from_ofruru'). ' ofru.ru',
            'h' => '0',
            'helplink' => '1',
	    'width' => '17',
            'lang' => 'ru'
        );
    }
}
add_action('widgets_init', create_function('', 'return register_widget("widget_to_search_from_ofruru");'));

?>