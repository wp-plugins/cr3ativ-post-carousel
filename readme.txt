=== Cr3ativ RecentPosts Carousel ===
Contributors: Cr3ativ
Tags: carousel, recent posts
Requires at least: 3.0.1
Tested up to: 4.0
Stable tag: 1.0.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Cr3ativ RecentPosts Carousel plugin is taken from your posts within WordPress and displays them in a carousel based on variables you choose.


== Description ==

Easily add as many carousel items as you'd like by category.  

Using the owl script available here http://owlgraphic.com/owlcarousel/ - we have created an easy to use plugin based on the content area.

You can include these items by carousel category in a post or page using the short code:

[recentposts-carousel columns="1" category="standard" number="3" image="yes"]  

Above is an example of that short code.  We state how many columns we want to display, which category, how many posts and if we want the featured image displayed (yes/no).  If you want to pull from all categories, just leave off the category part of the short code like this:

[recentposts-carousel columns="1" number="3" image="yes"]

We also provide a widget for this plugin to utilize the same as the short code with the exception of you can tell the carousel how to sort the items and the carousel category is provided by a drop down menu.

For your convenience, the plugin also contains a directory called languages, you will find the mo/po files used for this plugin here.



== Plugin Installation ==

1. Upload the `cr3ativ-recentposts-carousel` folder to your to the `/wp-content/plugins/` directory or alternatively upload the cr3ativ-recentposts-carousel.zip via the plugin page of WordPress by clicking 'Add New' and select the zip from your local computer.

2. Activate the plugin once uploaded.


3. Using either the short code or the drag and drop widget, just create your carousel where ever you want it to appear.



== Styling ==
Styling for these page templates are included in the includes directory under :

/css/owl.carousel.css
/css/owl.theme.css
/css/owl.transitions.css



== Changelog ==

= 1.0.5 =
* Updated to combine all 3 CSS files into one for quicker loading on CSS file.

= 1.0.4 =
* Updated plugin readme.txt and version # on cr3ativ-recentposts.php and updated the text based short code, one of the functions was deprecated.

= 1.0.3 =
* Updated plugin readme.txt and version # on cr3ativ-recentposts.php and added banners to /assets directory.

= 1.0.2 =
* Updated plugin so when the shortcode is used, the excerpt is wrapped in p tags to pick up the format.

= 1.0.1 =
* Updated plugin to include ability to choose ‘All’ from the widget category drop down or to leave the category selection off the short code to pull all categories and updated the language files.

= 1.0 =
* First release.



