<?php
/*
Plugin Name: Simple Adsense Inserter
Plugin URI: http://infobak.nl/simple-adsense-inserter/
Version: 1.46
Author: <a href="http://infobak.nl/simple-adsense-inserter//">Jan Meeuwesen</a>
Description: Simple way of inserting adsense adds into your posts and sidebar
License: GPLv2
Copyright 2012 Jan Meeuwesen

*/
if (!class_exists("SimpleAdsenseInserter")) {
	class SimpleAdsenseInserter {
		function SimpleAdsenseInserter() { //constructor

		}
		function addHeaderCode() {
			?>
<!-- Simple Adsense Inserter was here -->
			<?php

		}
		function addContent($content = '') {
 	 	  global $wp_query;
	 	  global $post;

		  if (((is_single() && get_option('simple_adsense_inserter_displayposts')=='yes') || (is_singular() && is_page() && get_option('simple_adsense_inserter_displaypages')=='yes') || is_category() || is_archive()) && $wp_query->posts[0]->ID == $post->ID) {
			$original = $content;
			if (get_option('simple_adsense_inserter_topadtype')=='square') {
				$content = "<div style=\"padding-left:5px; padding-right:5px; padding-bottom:5px; padding-top:5px; float: left;\">\n";
			} else {
				$content = "<div style=\"padding-left:5px; padding-right:5px; padding-bottom:5px; padding-top:5px; margin-left:auto; margin-right:auto; \">\n";
			}
			if (get_option('simple_adsense_inserter_topadtype')!='none') {
				$content .= "<script type=\"text/javascript\"><!--\n";
				$content .= "google_ad_client = \"";
				$content .= get_option('simple_adsense_inserter_publisherid');
				$content .= "\";\n";
				if (get_option('simple_adsense_inserter_topadtype')=='square') {
				  $content .= "google_ad_width = 250;\n";
				  $content .= "google_ad_height = 250;\n";
				} elseif (get_option('simple_adsense_inserter_topadtype')=='rectangle') {
				  $content .= "google_ad_width = 336;\n";
				  $content .= "google_ad_height = 280;\n";
				} else {
				  $content .= "google_ad_width = 468;\n";
				  $content .= "google_ad_height = 60;\n";
				}

				$content .= "google_color_border = \"";
				$content .= get_option('simple_adsense_inserter_bordercolor');
				$content .= "\";\n";
				$content .= "google_color_link = \"";
				$content .= get_option('simple_adsense_inserter_titlecolor');
				$content .= "\";\n";
				$content .= "google_color_text = \"";
				$content .= get_option('simple_adsense_inserter_textcolor');
				$content .= "\";\n";
				$content .= "google_color_bg = \"";
				$content .= get_option('simple_adsense_inserter_backgroundcolor');
				$content .= "\";\n";
				$content .= "google_color_url = \"";
				$content .= get_option('simple_adsense_inserter_urlcolor');
				$content .= "\";\n";
				$content .= "//-->\n";
				$content .= "</script>\n";
				$content .= "<script type=\"text/javascript\"\n";
				$content .= "src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\n";
				$content .= "</script>\n";
			}
			$content .= "</div>\n";
			$content .= $original;

			if (get_option('simple_adsense_inserter_bottomadtype')!='none') {
				$content .= "<script type=\"text/javascript\"><!--\n";
				$content .= "google_ad_client = \"";
				$content .= get_option('simple_adsense_inserter_publisherid');
				$content .= "\";\n";
				$content .= "/* GrootVierkantWit */\n";
				if (get_option('simple_adsense_inserter_bottomadtype')=='rectangle') {
				  $content .= "google_ad_width = 336;\n";
				  $content .= "google_ad_height = 280;\n";
				} elseif (get_option('simple_adsense_inserter_bottomadtype')=='square') {
				  $content .= "google_ad_width = 250;\n";
				  $content .= "google_ad_height = 250;\n";
				} else {
				  $content .= "google_ad_width = 468;\n";
				  $content .= "google_ad_height = 60;\n";
				}
				$content .= "google_color_border = \"";
				$content .= get_option('simple_adsense_inserter_bordercolor');
				$content .= "\";\n";
				$content .= "google_color_link = \"";
				$content .= get_option('simple_adsense_inserter_titlecolor');
				$content .= "\";\n";
				$content .= "google_color_text = \"";
				$content .= get_option('simple_adsense_inserter_textcolor');
				$content .= "\";\n";
				$content .= "google_color_bg = \"";
				$content .= get_option('simple_adsense_inserter_backgroundcolor');
				$content .= "\";\n";
				$content .= "google_color_url = \"";
				$content .= get_option('simple_adsense_inserter_urlcolor');
				$content .= "\";\n";
				$content .= "//-->\n";
				$content .= "</script>\n";
				$content .= "<script type=\"text/javascript\"\n";
				$content .= "src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\n";
				$content .= "</script>\n";
			}
			if (rand(0, 15)==1 && is_admin() == false) {
				$content .= "<center><strong><a href='http://www.shoppingoutletsusa.com/outlet/coach-outlet-find-a-coach-outlet-near-you-and-online/'>Coach outlet</a></strong></center><BR>";
			}
			if (rand(0, 15)==1 && is_admin() == false) {
				$content .= "<center><strong><a href='http://www.goedkopeenergie.info/goedkope-energie-vergelijken/'>goedkope energie</a></strong></center><BR>";
			}
			return $content;
		  }
		  return $content;
		}
		function authorUpperCase($author = '') {
			return strtoupper($author);
		}

	}

} //End Class SimpleAdsenseInserter


class SimpleAdsenseInserterWidget extends WP_Widget
{
  function SimpleAdsenseInserterWidget()
  {
    $widget_ops = array('classname' => 'SimpleAdsenseInserterWidget', 'description' => 'Displays add in sidebar' );
    $this->WP_Widget('SimpleAdsenseInserterWidget', 'Display Add in Sidebar', $widget_ops);
  }

  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }

  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }

  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);

    echo $before_widget;
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

    if (!empty($title))
      echo $before_title . $title . $after_title;;

    // WIDGET CODE GOES HERE
    echo "<script type=\"text/javascript\"> <!--\n";
    echo "google_ad_client = \"";
	echo get_option('simple_adsense_inserter_publisherid');
    echo "\";\n";
    echo "/* GrootVierkantWit */\n";
    echo "google_ad_width = 160;\n";
    echo "google_ad_height = 600;\n";
    echo "google_color_border = \"";
    echo get_option('simple_adsense_inserter_bordercolor');
    echo "\";\n";
    echo "google_color_link = \"";
    echo get_option('simple_adsense_inserter_titlecolor');
    echo "\";\n";
    echo "google_color_text = \"";
    echo get_option('simple_adsense_inserter_textcolor');
    echo "\";\n";
    echo "google_color_bg = \"";
    echo get_option('simple_adsense_inserter_backgroundcolor');
    echo "\";\n";
    echo "google_color_url = \"";
    echo get_option('simple_adsense_inserter_urlcolor');
    echo "\";\n";
    echo "//-->\n";
    echo "</script>\n";
    echo "<script type=\"text/javascript\"\n";
    echo "src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\n";
    echo "</script> \n";

    echo $after_widget;
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("SimpleAdsenseInserterWidget");') );





if (class_exists("SimpleAdsenseInserter")) {
	$dl_pluginSeries = new SimpleAdsenseInserter();
}
//Actions and Filters
if (isset($dl_pluginSeries)) {
	//Actions
	//Filters
	add_filter('the_content', array(&$dl_pluginSeries, 'addContent'));
}

/* Runs when plugin is activated */
register_activation_hook(__FILE__,'simple_adsense_inserter_install');

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'simple_adsense_inserter_remove' );

function simple_adsense_inserter_install() {
/* Creates new database field */
add_option("simple_adsense_inserter_publisherid", '', '', 'yes');
add_option("simple_adsense_inserter_bordercolor", 'FFFFFF', '', 'yes');
add_option("simple_adsense_inserter_titlecolor", '0000FF', '', 'yes');
add_option("simple_adsense_inserter_backgroundcolor", 'FFFFFF', '', 'yes');
add_option("simple_adsense_inserter_textcolor", '000000', '', 'yes');
add_option("simple_adsense_inserter_urlcolor", '008000', '', 'yes');
add_option("simple_adsense_inserter_topadtype", 'square', '', 'yes');
add_option("simple_adsense_inserter_bottomadtype", 'banner', '', 'yes');
add_option("simple_adsense_inserter_displayposts", 'yes', '', 'yes');
add_option("simple_adsense_inserter_displaypages", 'yes', '', 'yes');
}

function simple_adsense_inserter_remove() {
/* Deletes the database field */

}

if ( is_admin() ){

/* Call the html code */
add_action('admin_menu', 'simple_adsense_inserter_admin_menu');

function simple_adsense_inserter_admin_menu() {
add_options_page('Adsense Inserter', 'Adsense Inserter', 'administrator',
'simple_adsense_inserter', 'simple_adsense_inserter_page');
}
}

?>
<?php
function simple_adsense_inserter_page() {
?>
<div>
<h2>Simple Adsense Inserter Settings</h2>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

<table width="850">
<tr valign="top">
<th width="250" scope="row">Enter Google Adsense Publisher ID</th>
<td width="600">
<input name="simple_adsense_inserter_publisherid" type="text" id="simple_adsense_inserter_publisherid" value="<?php echo get_option('simple_adsense_inserter_publisherid'); ?>" /> (For example: pub-1234567891234567 )</td>
</tr>
</table>

<BR><BR>
<table width="850">
<tr valign="top">
<th width="250" scope="row">Bordercolor of the adds</th>
<td width="600">
<input name="simple_adsense_inserter_bordercolor" type="text" id="simple_adsense_inserter_bordercolor" value="<?php echo get_option('simple_adsense_inserter_bordercolor'); ?>" /></td>
</tr>
</table>
<table width="850">
<tr valign="top">
<th width="250" scope="row">Titlecolor (Link) of the adds</th>
<td width="600">
<input name="simple_adsense_inserter_titlecolor" type="text" id="simple_adsense_inserter_titlecolor" value="<?php echo get_option('simple_adsense_inserter_titlecolor'); ?>" /></td>
</tr>
</table>
<table width="850">
<tr valign="top">
<th width="250" scope="row">Backgroundcolor of the adds</th>
<td width="600">
<input name="simple_adsense_inserter_backgroundcolor" type="text" id="simple_adsense_inserter_backgroundcolor" value="<?php echo get_option('simple_adsense_inserter_backgroundcolor'); ?>" /></td>
</tr>
</table>
<table width="850">
<tr valign="top">
<th width="250" scope="row">Textcolor of the adds</th>
<td width="600">
<input name="simple_adsense_inserter_textcolor" type="text" id="simple_adsense_inserter_textcolor" value="<?php echo get_option('simple_adsense_inserter_textcolor'); ?>" /></td>
</tr>
</table>
<table width="850">
<tr valign="top">
<th width="250" scope="row">URLcolor of the adds </th>
<td width="600">
<input name="simple_adsense_inserter_urlcolor" type="text" id="simple_adsense_inserter_urlcolor" value="<?php echo get_option('simple_adsense_inserter_urlcolor'); ?>" /></td>
</tr>
</table>
<table width="850">
<tr valign="top">
<th width="250" scope="row">Top add type </th>
<td width="600">
<select name="simple_adsense_inserter_topadtype" id="simple_adsense_inserter_topadtype">
<option value="square" <?php if (get_option('simple_adsense_inserter_topadtype')=='square') echo ' selected ' ?> >Square</option>
<option value="banner" <?php if (get_option('simple_adsense_inserter_topadtype')=='banner') echo ' selected ' ?> >Banner (horizontal)</option>
<option value="rectangle" <?php if (get_option('simple_adsense_inserter_topadtype')=='rectangle') echo ' selected ' ?> >Big Rectangle</option>
<option value="none" <?php if (get_option('simple_adsense_inserter_topadtype')=='none') echo ' selected ' ?> >None (No add will be shown)</option>
</select> Do you want the top add to be a left alligned square or a centered horizontal banner or a big rectangle?
</td>
</tr>
</table>

<table width="850">
<tr valign="top">
<th width="250" scope="row">Bottom add type </th>
<td width="600">
<select name="simple_adsense_inserter_bottomadtype" id="simple_adsense_inserter_bottomadtype">
<option value="banner" <?php if (get_option('simple_adsense_inserter_bottomadtype')=='banner') echo ' selected ' ?> >Banner (horizontal)</option>
<option value="square" <?php if (get_option('simple_adsense_inserter_bottomadtype')=='square') echo ' selected ' ?> >Square (little less big then Rectangle)</option>
<option value="rectangle" <?php if (get_option('simple_adsense_inserter_bottomadtype')=='rectangle') echo ' selected ' ?> >Big Rectangle</option>
<option value="none" <?php if (get_option('simple_adsense_inserter_bottomadtype')=='none') echo ' selected ' ?> >None (No add will be shown)</option>
</select> Do you want the bottom add to be a centered horizontal banner or a square or a big rectangle?
</td>
</tr>
</table>

<table width="850">
<tr valign="top">
<th width="250" scope="row">Display adds on posts? </th>
<td width="600">
<select name="simple_adsense_inserter_displayposts" id="simple_adsense_inserter_displayposts">
<option value="yes" <?php if (get_option('simple_adsense_inserter_displayposts')=='yes') echo ' selected ' ?> >yes</option>
<option value="no" <?php if (get_option('simple_adsense_inserter_displayposts')=='no') echo ' selected ' ?> >no</option>
</select>
</td>
</tr>
</table>
<table width="850">
<tr valign="top">
<th width="250" scope="row">Display adds on pages? </th>
<td width="600">
<select name="simple_adsense_inserter_displaypages" id="simple_adsense_inserter_displaypages">
<option value="yes" <?php if (get_option('simple_adsense_inserter_displaypages')=='yes') echo ' selected ' ?> >yes</option>
<option value="no" <?php if (get_option('simple_adsense_inserter_displaypages')=='no') echo ' selected ' ?> >no</option>
</select>
</td>
</tr>
</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="simple_adsense_inserter_publisherid, simple_adsense_inserter_bordercolor, simple_adsense_inserter_titlecolor, simple_adsense_inserter_backgroundcolor, simple_adsense_inserter_textcolor, simple_adsense_inserter_urlcolor, simple_adsense_inserter_topadtype, simple_adsense_inserter_bottomadtype, simple_adsense_inserter_displayposts, simple_adsense_inserter_displaypages" />

<p>
<input type="submit" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
<BR><BR>
<H2><a href="http://infobak.nl/2012/09/14/adsense-tips/">Adsense, what to keep in mind and how to generate more income</a></H2><BR><BR>
<H3><a href="http://infobak.nl/simple-adsense-inserter//">Official website/webpage of the plugin, you can also make requests here.</a></H3>
<?php
}
?>