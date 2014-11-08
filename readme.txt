=== Quick WP htmlentities ===
Contributors: willrich33
Donate link: http://www.brimbox.com/wordpress/
Tags: codeblocks, formatting, htmlentities
Requires at least: 3.9.1
Tested up to: 4.0
Stable tag: 1.0 Beta
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This is a shortcode plugin that applies the PHP htmlentities function to text in a post.

== Description ==

= Overview =

This is a short plugin that emulates the PHP htmlentities function.  With this plugin, HTML and other code can automatically be formatted into HTML entities using a shortcode within posts.  In addition, customizable parameter options are available.

An outer optional HTML "tag" can be added to wrap the shortcode content along with parameters "style" and "class" to style the "tag" if "tag" is declared.  You can define the "style" value inline and the "class" value should be previously defined, probably in the "style.css" file. An inner html tag "wrapper" without "class" or "style" can also be specified.

You can also use this shortcode inline by declaring the "inline" parameter as "true", and the shortcode will render the content inline.  As previously discussed, you can use the "wrapper" parameter along with the "style" and "class" parameters if "tag" is defined.  

= Important =

This plugin is intended to work when `wpautop` is in the default state and does not alter the `the_content` hook. If the `the_content` hook has been altered this plugin may not work.  You should leave one empty line above and below both beginning and ending shortcodes when invoking standard formatting. If using the inline parameter leave a space after the begining shortcode and before the ending shortcode.  

= Standard Block Usage =

`Lorem ipsum dolor sit amet, consectetur adipiscing elit. 

[quick-wp-htmlentities]

<span style="color:blue">Using a style.</span>

[/quick-wp-htmlentities]

Donec mauris metus, scelerisque id fermentum id, ornare at metus.`

= Code Block with PRE spaces =

`[quick-wp-htmlentities tag="code" style="white-space:pre-wrap;"]

function output_span()
    {
    echo "<span style=\"color:blue\">Use a class & a span.</span>";
    }

[/quick-wp-htmlentities]`


= Standard Inline Usage =

`Lorem ipsum dolor sit amet, consectetur adipiscing elit. [quick-wp-htmlentities inline="true"]

<span style="color:blue" class="sample">This is how you use a style and a class called sample.</span>

[/quick-wp-htmlentities] Donec mauris metus, scelerisque id fermentum id, ornare at metus.`


= Custom Block with all Parameters =

`Lorem ipsum dolor sit amet, consectetur adipiscing elit.

[quick-wp-htmlentities tag="div" style="margin:0 20px;" class="example" wrapper="code"]

<span style="color:blue" class="sample">This is how you use a style and a class called sample.</span>

[/quick-wp-htmlentities]

Donec mauris metus, scelerisque id fermentum id, ornare at metus.`

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `quick-wp-htmlentities` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place shortcode in your posts or pages.

== Frequently Asked Questions ==

= Why do you need this plugin? =

In general, it would seem like you could just make a shortcode like this to format text with htmlentities.

`add_shortcode('my_htmlentities', 'my_htmlentities_func');     
function my_htmlentities_func($atts, $content = null) {     
    return htmlentities($content);    
}`

However, the problem is this also formats the paragraphs and breaks Wordpress automatically adds.

There are online suggestions to alter the `the_content` hook to reorder the shortcode and formatting options, but this could mess up other shortcodes and altering the default `the_content` hook behavior is not something the author would take lightly.

So, it is a programming task to make a shortcode to add htmlentities to the shortcode content.

== Screenshots ==

No screenshots as this is just a shortcode.

== Changelog ==
= 1.0 =
* Plugin created.

= 1.1 =
* Fixed problem with ampersands (&) which caused plugin to fail (wpautop already substitutes htmlentitities for ampersands).
* **Now purges line breaks, tabs and carriage returns from output so <pre> tags and related styles work.**

== Upgrade Notice ==
= 1.0 =
* This is the initial beta release on 7/1/2014

= 1.1 =
* Fixed problem with ampersands (&) which caused plugin to fail (wpautop already substitutes htmlentitities for ampersands).
* **Now purges line breaks, tabs and carriage returns from output so <pre> tags and related styles work.**
