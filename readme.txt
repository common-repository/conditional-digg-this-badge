=== WP Conditional Digg This Badge ===
Contributors: SlowWalkere
Donate link: http://www.earn-web-cash.com/scripts-plugins-and-modules/wp-plugin-digg-badge/
Tags: digg, social bookmarking
Requires at least: 2.3.3
Tested up to: 2.3.3
Stable tag: trunk

This plugin checks how many Diggs an article has, and shows a "Digg This" badge if it already has 10 Diggs.

== Description ==

This plugin is designed to automatically add a "Digg This" badge to your articles that already have some popularity on Digg.  This way you can automatically add badges to your articles without having a bunch of "1 Digg" articles.

The plug-in inserts some Javascript into your articles.  This Javascript allows the plug-in to access the Digg API.  Through the API, the plug-in determines if your article has enough Diggs (by default: 10).  If it does, the "Digg This" badge is displayed.  Otherwise, the Javascript is deleted and no badge is shown.

Note on Wordpress version:  This should work on earlier versions.  However, it's only been tested on Versions 2.3.3 and up.  If you successfully use the plug-in on an earlier version of Wordpress, please leave a comment at the plugin homepage so that I can update the information in this readme.

== Installation ==

Follow the normal Wordpress Plugin procedures - no special template tampering is required.

1.  Upload 'wp-digg-conditional.tar.gz' to your plugins folder.
2.  Uncompress the archive, preserving the folder structure.
3.  Activate the plug-in through the "Plugins" section of your dashboard.
4.  (Optional) Edit the $minDiggs variable in "check-digg-stats.php" to customize the number of Diggs are article needs to receive a badge.

== Frequently Asked Questions ==

= How do I customize the number of Diggs it takes to be considered "popular?" =

In future versions, this will be added as an option to the plug-in in your dashboard.  In the meantime, you can manually change this value in the "check-digg-stats.php" page.

Look for the declaration of $minDiggs.  It should be set to 10.  Change '10' to whatever value you want to use as a benchmark.

= Do I have to link to prototype.js again if I'm already using it? =

No.  As long as you have a site-wide link in to the external javascript file prototype.js, you can comment out the line in the plug-in that adds a reference to it.

Open "wp-digg-conditional.php".  Scroll down to about line 37.  Comment out the line that creates a javascript element with src "$root . '/wp-content/plugins/wp-digg-conditional/prototype.js".

= Can I see it in action, please? =

Sure.  This article on [PHP image functions](http://www.earn-web-cash.com/2008/01/30/resize-images-php/ "How to Use PHP to Dynamically Resize Images") has enough Diggs to get a badge.

= How can I get an answer to a new question? =

If you have a problem, question, or feature request, you can send them my way and I'll deal with them when I have the time.

The easiest way would be to go to the [plug-in homepage](http://www.earn-web-cash.com/scripts-plugins-and-modules/wp-plugin-digg-badge/ "Conditional Digg This Plugin Homepage") and leave a comment.

== Screenshots ==

1.  Here you can see where the Digg badge is inserted.  It floats to the left at the very top of the article.

== Change Log ==

**Version 1.1**

1.  The div created by the plug-in is no longer removed from the page if a badge is not going to be inserted.  The DOM code for this may have broken a page in IE in some cases.  This clean-up feature will be back in later versions, once the bug has been fixed.
2.  The plug-in now only operates on single pages (posts and pages).  The multiple requests on index pages were causing other Javascript functions (like Google Analytics) to hang and not load properly.
3.  Tweaked the way the styling of the div to fix a bug in IE.  It should now correctly float in both IE and Firefox.