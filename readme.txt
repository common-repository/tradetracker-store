=== Plugin Name ===
Contributors: RPG84
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=97K9JBA7Z2K7Q
Tags: tradetracker, store, productfeed, affiliate, daisycon, zanox, cleafs, tradedoubler, paidonresults, M4N, xml productfeed
Requires at least: 4
Tested up to: 5.7.2
Stable tag: 4.6.60

A plugin that lets you import an XML productfeed from TradeTracker. 

== Description ==

This plugin gives you the abillity to add a store to your WordPress, based on a tradetracker productfeed. Tradetracker is an affiliate system that has
the abillity to generate a product feed for you. So you can have a store that brings in money without the hassle of owning a complete webstore. All you need to do is choose a store connected on tradetracker and add it. Users of your blog will then see the products on your blog and when interested they will be sent to the store. When they buy an item you will get a percentage of that sale.

You can also add zanox, daisycon, tradedoubler, paidonresults and cleafs With the new premium addons.
 
Plugin also supports Lightbox. So if you don't have it yet i would advise to install http://wordpress.org/extend/plugins/wp-jquery-lightbox/

So remember: This plugin will not give you the ability to sell you own stuff. It gives you the ability to import product feeds from affiliate networks.

== Installation ==

1. Upload `tradetracker-store` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Adjust all settings in the TT Store on the left side of the admin menu

== Frequently Asked Questions ==
= Do you have an example ? =
You can see the plugin in action on: http://www.debesteschoenen.nl
This site also uses the Statistics addon (The outpage you see before you go to the affiliates website)

= Have you gotten any questions yet? =

You can find als FAQs here: http://wpaffiliatefeed.com/category/frequently-asked-questions/

== Screenshots ==

1. This is how the items will be shown on your site
2. This is the settings menu in the admin area
3. Here you select which products you want to show on your site

== Changelog ==
= 4.6.60 =
- Escaped all echo's of variables

= 4.6.59 =
- Rewrote the importer to fully rely on the download function within Wordpress instead of Curl

= 4.6.58 =
- Loads of changes to fulfill the security review

= 4.6.57 =
- Tested with latest version of Wordpress

= 4.6.56 = 
- Fixed issue with potential SQL injection

= 4.6.55 =
- Fixed issue with importer causing issues in WP 5.6

= 4.6.54 =
- Fixed issue where it still imports duplicate items ( based on productURL )

= 4.6.53 =
- Removed a space in functions.php that only showed up for few people and caused an error.
- Small adjustment in xml.php to fix error in there

= 4.6.52 =
- Solved error loading sites.xml for sidemenu
- Solved php warning when updating premium api key's

= 4.6.51 =
- Fixed another error in the widget related to PHP 7.2

= 4.6.50 =
- Fixed an error in the widget related to PHP 7.2

= 4.6.49 =
- You can now use or while searching for items in item select example: beach or resort
- You can now use and while searching for items in item select example: beach and resort

= 4.6.48 =
- Removed the search in extra fields in item select, mainly because it causes too much issues.
- Counter for amount of items found should be accurate now in item select search results.

= 4.6.47 =
- In item select it also shows description when you hover over the title of the item.
- Debug settings will also show error when premium can't be installed

= 4.6.46 =
- Small adjustment for search in item select, so it allows smaller words to be searched for

= 4.6.45 =
- Small adjustment for PHP 7.1
- Adjustment made in XMLsplit for tradetracker feeds with too much categories

= 4.6.44 =
- Small adjustment for tradetracker feeds to import images

= 4.6.43 =
- Performance Horizon has been added as an extra premium

= 4.6.42 =
- Small fix to see if that removes some errors on item select screen for people that have debug notices on

= 4.6.41 =
- The extra search fields in item select screen are remembered when you go through different pages of items
- Trying a new way to force import on backend to see if that helps solve issues for certain hostings

= 4.6.40 =
- You can now select within which fields you want to search in the item select screen

= 4.6.39 =
- If you deselect a category while you have selected items then it will only display the items of the remaining selected categories.

= 4.6.38 =
- Selecting none in the item select and saving will now also save when no items are selected.

= 4.6.37 =
- Added option in plugin settings to disable price slider
- Made stores in add/edit stores sortable on name

= 4.6.36 =
- It will no longer show multiple pages when using Rand() as sorting method for the items 

= 4.6.35 =
- Ajax call will be playing nice for https too
- Seperate class for .store-more introduced

= 4.6.34 =
- Extra fix for MariaDB hostings

= 4.6.33 =
- Small fix because MariaDB is causing issues around double quotes
- Small fix that will auto select the page amount on your front page of you website when your store option matches one of the default options  

= 4.6.32 =
- Small fix to remove a SQL error when system things you selected a specific feed while you didn't

= 4.6.31 =
- Removed draggable call in Jquery

= 4.6.30 =
- Testing an XML feed will give more information to see what information the server returns

= 4.6.29 =
- Small fix to make rel=nofollow also work when using lightbox

= 4.6.28 =
- Small fix to make image work in specific tradetracker feed

= 4.6.27 =
- Select all with the item select screen is now also available on top.

= 4.6.26 =
- Added Imailo as a new provider.  a new affiliate network that has a different focus. The drive and passion that they have for affiliate marketing is key to their success. 

= 4.6.25 =
- Added Linkwi.se as a new provider. It is one of the biggest providers in Greece

= 4.6.24 =
- Small fix for hostings that don't alllow longer links to remove selected items

= 4.6.23 =
- Fixed that is sometimes shows less items when using random order

= 4.6.22 =
- small fix to get price sorting working again

= 4.6.21 =
- Last fix to enable translate.wordpress.com so people can help with translations

= 4.6.20 =
- Fixed an issue when you had sorting on Rand() while selected items

= 4.6.19 =
- Improved queries to handle showing items with Rand() option. It will speed up showing those items
- Fully supporting translate.wordpress.org so people can help with translating

= 4.6.18 = 
- Fix for database errors

= 4.6.17 =
- Small fix for when there is no currency in the feed

= 4.6.16 =
- Made product title clickable

= 4.6.15 = 
- Fixed the error for the widget changes in Wordpress 4.3

= 4.6.14 =
- Enabling the order link + price in a fancybox is now an option in the plugin settings

= 4.6.13 =
- Show price and order link in a fancybox/lightbox 

= 4.6.12 =
- Small fix to make the queries go much quicker

= 4.6.11 =
- Yellow bar will now show how many feeds where imported

= 4.6.10 =
- Small fix for when you save an item selection page without items selected 

= 4.6.9 =
- Fix for when feed has a multiple of 100 items

= 4.6.8 =
- New premium addon for EDC Internet feeds (mostly interesting for people in the adult segment)
- Fixed the price sorter
- Small fix for item selection counter, the query didn't run on certain host and caused a white screen

= 4.6.7 = 
- Small fix for some notices in debug.log for the item select.

= 4.6.6 =
- In the XML feed settings you can now select how many feeds are imported every 10 minutes till all feeds are imported. 

= 4.6.5 =
- Some adjustments for spaces between words

= 4.6.4 =
- Small fix to import tradetracker feeds that don't follow the correct category structure

= 4.6.3 =
- Font size fixed
- Link to websafe fonts fixed

= 4.6.2 =
- Extra check for autoimport = no to work more stable

= 4.6.1 =
- Small fix for the import to actually empty the old feed

= 4.6 =
- Major improvements on the importer. 
- Manual importer received a nicer interface
- You can now select which feeds should be auto imported. It will still update all feeds in the manual import

= 4.5.65 = 
- Improved error for write access

= 4.5.64 =
- Added a way to test an XML feed in the XML Feed menu

= 4.5.63 =
- Added link to search pages FAQ 

= 4.5.62 =
- Small fix for when store table is not created in a new installation

= 4.5.61 = 
- Store table was missing 2 collums

= 4.5.60 = 
- Remove duplicate indexes in the database
- Improved check in import to prevent reimporting the same feed over and over again

= 4.5.59 =
- You can now copy a store

= 4.5.58 = 
- Small change so items per page is not adjusted by changing price

= 4.5.57 =
- Added link to the FAQ for import errors in to the email.

= 4.5.56 =
- Small change so you can show first and last page number

= 4.5.55 =
- Added a sorting option for the price for visitors on your site
- Gave the page selection and the price sorter selection a class so you can style it in css

= 4.5.53 =
- Fixed small mistake that removed the price from the slider

= 4.5.52 = 
- Price slider should work on mobile too now

= 4.5.51 =
- Store settings now also have a min price. So you are able to show items between a price range

= 4.5.49 = 
- Store settings allow you to change currency for the price filter


= 4.5.48 = 
- Small update to the z-index of most admin menu's
- Some removals of mysql functions because 3.9 uses mysqli

Full changelog on http://wpaffiliatefeed.com/category/releaselog/

== Upgrade Notice == 
= 4.5.19 =
Two new addons, 1 xml provider called Managementboek and a statistics addon

= 4.5.17 =
Modify Errors issue that came up on certain servers is now resolved 

= 4.5.16 =

This update will make the import of feeds with high amount of extra fields/categories quicker

= 4.5.15 = 
Support for longer XML Feed urls

= 4.5.13 =
Removes the error messages in the admin menu

= 4.5.12 =
This fixes the errors that came up due to the new Wordpress version. Also using the wordpress jquery for the price range so it should work on every site.

= 4.5.4 =
This version will support the changes in the Tradetracker Daily feed

= 4.5.1 = 
This version is needed to get the new Tradetracker feeds working

= 4.1.1 =
Deleting of stores, better error messages for failed import
