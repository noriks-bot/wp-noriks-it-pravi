<<<<<<< HEAD
=== Advanced Custom Fields Pro ===
Contributors: elliotcondon
Tags: acf, advanced, custom, field, fields, form, repeater, content
Requires at least: 4.7.0
Tested up to: 5.3.0
Requires PHP: 5.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Customize WordPress with powerful, professional and intuitive fields.

== Description ==

Use the Advanced Custom Fields plugin to take full control of your WordPress edit screens & custom field data.

**Add fields on demand.** Our field builder allows you to quickly and easily add fields to WP edit screens with only the click of a few buttons!

**Add them anywhere.** Fields can be added all over WP including posts, users, taxonomy terms, media, comments and even custom options pages!

**Show them everywhere.** Load and display your custom field values in any theme template file with our hassle free developer friendly functions!

= Features =
* Simple & Intuitive
* Powerful Functions
* Over 30 Field Types
* Extensive Documentation
* Millions of Users

= Links =
* [Website](https://www.advancedcustomfields.com)
* [Documentation](https://www.advancedcustomfields.com/resources/)
* [Support](https://support.advancedcustomfields.com)
* [ACF PRO](https://www.advancedcustomfields.com/pro/)

= PRO =
The Advanced Custom Fields plugin is also available in a professional version which includes more fields, more functionality, and more flexibility! [Learn more](https://www.advancedcustomfields.com/pro/)


== Installation ==

From your WordPress dashboard

1. **Visit** Plugins > Add New
2. **Search** for "Advanced Custom Fields"
3. **Activate** Advanced Custom Fields from your Plugins page
4. **Click** on the new menu item "Custom Fields" and create your first Custom Field Group!
5. **Read** the documentation to [get started](https://www.advancedcustomfields.com/resources/getting-started-with-acf/)


== Frequently Asked Questions ==

= What kind of support do you provide? =

**Help Desk.** Support is currently provided via our email help desk. Questions are generally answered within 24 hours, with the exception of weekends and holidays. We answer questions related to ACF, its usage and provide minor customization guidance. We cannot guarantee support for questions which include custom theme code, or 3rd party plugin conflicts & compatibility. [Open a Support Ticket](https://www.advancedcustomfields.com/support/)

**Support Forums.** Our Community Forums provide a great resource for searching and finding previously answered and asked support questions. You may create a new thread on these forums, however, it is not guaranteed that you will receive an answer from our support team. This is more of an area for developers to talk to one another, post ideas, plugins and provide basic help. [View the Support Forum](https://support.advancedcustomfields.com/)


== Screenshots ==

1. Simple & Intuitive

2. Made for developers

3. All about fields


== Changelog ==

= 5.8.7 =
*Release Date - 12 November 2019*

* New - Updated admin CSS for new WordPress 5.3 styling.
* Fix - Fixed various issues affecting dynamic metaboxes in the block editor (requires WordPress 5.3)
* Fix - Fixed performance issue when checking network sites for upgrades.
* Fix - Fixed Select2 clones appearing after duplicating a Relationship field.
* Tweak - Repeater field "Add row" icons will now hide when maximum rows are reached.
* Tweak - Removed ACF Blocks keyword limit for later versions of Gutenberg.

= 5.8.6 =
*Release Date - 24 October 2019*

* New - Added more data to Google Maps field value including place_id, street_name, country and more.
* Fix - Fixed bug in Gallery field incorrectly displaying .pdf attachments as icons.
* Fix - Fixed bug in Checkbox field missing "selected" class after "Toggle All".
* Dev - Added compatibility for Attachments in the Post Taxonomy location rule.
* Dev - Added missing return statement from `acf_get_form()` function.
* Dev - Added "google_map_result" JS filter.

= 5.8.5 =
*Release Date - 8 October 2019*

* New - Added new choice "Add" to the User Form location rule.
* New - Optimized `acf_form()` logic when used in combination with `acf_register_form()`.
* Fix - Fixed bug causing incorrect field order after sync.
* Fix - Fixed bug reverting the first field type to Text in Firefox version 69.0.1.
* Fix - Fixed bug causing tinymce issues when changing between block modes.
* Fix - Fixed bug preventing block registration when category does not exist.
* Fix - Fixed bug preventing block registration when no icon is declared.
* Dev - Added RegExp compatibility for innerBlocks.

= 5.8.4 =
*Release Date - 3 September 2019*

* New - Optimized Relationship field by delaying AJAX call until UI is visible.
* Fix - Fixed bug incorrectly escaping HTML in the Link field title.
* Fix - Fixed bug showing Discussion and Comment metaboxes for newly imported field groups.
* Fix - Fixed PHP warning when loading meta from Post 0.
* Dev - Ensure Checkbox field value is an array even when empty.
* Dev - Added new `ACF_MAJOR_VERSION` constant.

= 5.8.3 =
*Release Date - 7 August 2019*

* Tweak - Changed Options Page location rules to show "page_title" instead of "menu_title".
* Fix - Fixed bug causing Textarea field to incorrectly validate maxlength.
* Fix - Fixed bug allowing Range field values outside of the min and max settings.
* Fix - Fixed bug in block RegExp causing some blocks to miss the "acf/pre_save_block" filter.
* Dev - Added `$block_type` parameter to block settings "enqueue_assets" callback.
* i18n - Added French Canadian language thanks to Bérenger Zyla.
* i18n - Updated French language thanks to Bérenger Zyla.

= 5.8.2 =
*Release Date - 15 July 2019*

* Fix - Fixed bug where validation did not prevent new user registration.
* Fix - Fixed bug causing some "reordered" metaboxes to not appear in the Gutenberg editor.
* Fix - Fixed bug causing WYSIWYG field with delayed initialization to appear blank.
* Fix - Fixed bug when editing a post and adding a new tag did not refresh metaboxes.
* Dev - Added missing `$value` parameter in "acf/pre_format_value" filter.

= 5.8.1 =
*Release Date - 3 June 2019*

* New - Added "Preview Size" and "Return Format" settings to the Gallery field.
* Tweak - Improved metabox styling for Gutenberg.
* Tweak - Changed default "Preview Size" to medium for the Image field.
* Fix - Fixed bug in media modal causing the primary button text to disappear after editing an image.
* Fix - Fixed bug preventing the TinyMCE Advanced plugin from adding `< p >` tags.
* Fix - Fixed bug where HTML choices were not visible in conditional logic dropdown.
* Fix - Fixed bug causing incorrect order of imported/synced flexible content sub fields.
* i18n - Updated German translation thanks to Ralf Koller.
* i18n - Updated Persian translation thanks to Majix.

= 5.8.0 =
*Release Date - 8 May 2019*

* New - Added ACF Blocks feature for ACF PRO.
* Fix - Fixed bug causing duplicate "save metabox" AJAX requests in the Gutenberg editor.
* Fix - Fixed bug causing incorrect Repeater field value order in AJAX requests.
* Dev - Added JS filter `'relationship_ajax_data'` to customize Relationship field AJAX data.
* Dev - Added `$field_group` parameter to `'acf/location/match_rule'` filter.
* Dev - Bumped minimum supported PHP version to 5.4.0.
* Dev - Bumped minimum supported WP version to 4.7.0.
* i18n - Updated German translation thanks to Ralf Koller.
* i18n - Updated Portuguese language thanks to Pedro Mendonça.

= 5.7.13 =
*Release Date - 6 March 2019*

* Fix - Fixed bug causing issues with registered fields during `switch_to_blog()`.
* Fix - Fixed bug preventing sub fields from being reused across multiple parents.
* Fix - Fixed bug causing the `get_sub_field()` function to fail if a tab field exists with the same name as the selected field.
* Fix - Fixed bug corrupting field settings since WP 5.1 when instructions contain `< a target="" >`.
* Fix - Fixed bug in Gutenberg where custom metabox location (acf_after_title) did not show on initial page load.
* Fix - Fixed bug causing issues when importing/syncing multiple field groups which contain a clone field.
* Fix - Fixed bug preventing the AMP plugin preview from working.
* Dev - Added new 'pre' filters to get, update and delete meta functions.
* i18n - Update Turkish translation thanks to Emre Erkan.

= 5.7.12 =
*Release Date - 15 February 2019*

* Fix - Added missing function `register_field_group()`.
* Fix - Fixed PHP 5.4 error "Can't use function return value in write context".
* Fix - Fixed bug causing wp_options values to be slashed incorrectly.
* Fix - Fixed bug where "sync" feature imported field groups without fields.
* Fix - Fixed bug preventing `get_field_object()` working with a field key.
* Fix - Fixed bug causing incorrect results in `get_sub_field()`.
* Fix - Fixed bug causing draft and preview issues with serialized values.
* Fix - Fixed bug causing reversed field group metabox order.
* Fix - Fixed bug causing incorrect character count when validating values.
* Fix - Fixed bug showing incorrect choices for post_template location rule.
* Fix - Fixed bug causing incorrect value retrieval after `switch_to_blog()`.
* i18n - Updated Persian translation thanks to Majix.

= 5.7.11 =
*Release Date - 11 February 2019*

* New - Added support for persistent object caching.
* Fix - Fixed PHP error in `determine_locale()` affecting AJAX requests.
* Fix - Fixed bug affecting dynamic metabox check when selecting "default" page template.
* Fix - Fixed bug where tab fields did not render correctly within a dynamic metabox.
* Tweak - Removed language fallback from "zh_TW" to "zh_CN".
* Dev - Refactored various core functions.
* Dev - Added new hook variation functions `acf_add_filter_variations()` and `acf_add_action_variations()`.
* i18n - Updated Portuguese language thanks to Pedro Mendonça.
* i18n - Updated German translation thanks to Ralf Koller.
* i18n - Updated Swiss German translation thanks to Raphael Hüni.

= 5.7.10 =
*Release Date - 16 January 2019*

* Fix - Fixed bug preventing metaboxes from saving if validation fails within Gutenberg.
* Fix - Fixed bug causing unload prompt to show incorrectly within Gutenberg.
* Fix - Fixed JS error when selecting taxonomy terms within Gutenberg.
* Fix - Fixed bug causing jQuery sortable issues within other plugins.
* Tweak - Improved loading translations by adding fallback from region to country when .mo file does not exit.
* Tweak - Improved punctuation throughout admin notices.
* Tweak - Improved performance and accuracy when loading a user field value.
* Dev - Added filter 'acf/get_locale' to customize the locale used to load translations.
* Dev - Added filter 'acf/allow_unfiltered_html' to customize if current user can save unfiltered HTML.
* Dev - Added new data storage functions `acf_register_store()` and `acf_get_store()`.
* Dev - Moved from .less to .scss and minified all css.
* i18n - Updated French translation thanks to Maxime Bernard-Jacquet.
* i18n - Updated Czech translation thanks to David Rychly.

= 5.7.9 =
*Release Date - 17 December 2018*

* Fix - Added custom metabox location (acf_after_title) compatibility with Gutenberg.
* Fix - Added dynamic metabox check compatibility with Gutenberg.
* Fix - Fixed bug causing required date picker fields to prevent form submit.
* Fix - Fixed bug preventing multi-input values from saving correctly within media modals.
* Fix - Fixed bug where `acf_form()` redirects to an incorrect URL for sub-sites.
* Fix - Fixed bug where breaking out of a sub `have_rows()` loop could produce undesired results.
* Dev - Added filter 'acf/connect_attachment_to_post' to prevent connecting attachments to posts.
* Dev - Added JS filter 'google_map_autocomplete_args' to customize Google Maps autocomplete settings.

= 5.7.8 =
*Release Date - 7 December 2018*

* Fix - Fixed vulnerability allowing author role to save unfiltered HTML values.
* Fix - Fixed all metaboxes appearing when editing a post in WP 5.0.
* i18n - Updated Polish translation thanks to Dariusz Zielonka.
* i18n - Updated Czech translation thanks to Veronika Hanzlíková.
* i18n - Update Turkish translation thanks to Emre Erkan.
* i18n - Updated Portuguese language thanks to Pedro Mendonça.

= 5.7.7 =
*Release Date - 1 October 2018*

* Fix - Fixed various plugin update issues.
* Tweak - Added 'language' to Google Maps API url.
* Dev - Major improvements to the `acf.models.Postbox` model.
* Dev - Added JS filter 'check_screen_args'.
* Dev - Added JS action 'check_screen_complete'.
* Dev - Added action 'acf/options_page/submitbox_before_major_actions'.
* Dev - Added action 'acf/options_page/submitbox_major_actions'.
* i18n - Updated Portuguese language thanks to Pedro Mendonça

= 5.7.6 =
*Release Date - 12 September 2018*

* Fix - Fixed unload prompt not working.
* Dev - Reduced number of queries needed to populate the relationship field taxonomy filter.
* Dev - Added 'nav_menu_item_id' and 'nav_menu_item_depth' to get_field_groups() query.
* Dev - Reordered various actions and filters for more usefulness.
* i18n - Updated Polish language thanks to Dariusz Zielonka

[View the full changelog](https://www.advancedcustomfields.com/changelog/)

== Upgrade Notice ==
=======
=== Advanced Custom Fields (ACF®) PRO ===
Contributors: deliciousbrains, wpengine, elliotcondon, mattshaw, lgladdy, antpb, johnstonphilip, dalewilliams, polevaultweb
Tags: acf, fields, custom fields, meta, repeater
Requires at least: 6.2
Tested up to: 6.9
Requires PHP: 7.4
Stable tag: 6.7.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

ACF helps customize WordPress with powerful, professional and intuitive fields. Proudly powering over 2 million sites, WordPress developers love ACF.

== Description ==

Advanced Custom Fields (ACF®) turns WordPress sites into a fully-fledged content management system by giving you all the tools to do more with your data.

Use the ACF plugin to take full control of your WordPress edit screens, custom field data, and more.

https://www.youtube.com/watch?v=9C6_roqghZQ&rel=0

**Add fields on demand.**
The ACF field builder allows you to quickly and easily add fields to WP edit screens with only the click of a few buttons! Whether it's something simple like adding an “author” field to a book review post, or something more complex like the structured data needs of an ecommerce site or marketplace, ACF makes adding fields to your content model easy.

**Add them anywhere.**
Fields can be added all over WordPress including posts, pages, users, taxonomy terms, media, comments and even custom options pages! It couldn't be simpler to bring structure to the WordPress content creation experience.

**Show them everywhere.**
Load and display your custom field values in any theme template file with our hassle-free, developer friendly functions! Whether you need to display a single value or generate content based on a more complex query, the out-of-the-box functions of ACF make templating a dream for developers of all levels of experience.

**Any Content, Fast.**
Turning WordPress into a true content management system is not just about custom fields. Creating new custom post types and taxonomies is an essential part of building custom WordPress sites. Registering post types and taxonomies is now possible right in the ACF UI, speeding up the content modeling workflow without the need to touch code or use another plugin.

**Simply beautiful and intentionally accessible.**
For content creators and those tasked with data entry, the field user experience is as intuitive as they could desire while fitting neatly into the native WordPress experience. Accessibility standards are regularly reviewed and applied, ensuring ACF is able to empower as close to anyone as possible.

**Documentation and developer guides.**
Over 10 plus years of vibrant community contribution alongside an ongoing commitment to clear documentation means that you'll be able to find the guidance you need to build what you want.

= Features =
* Simple & Intuitive
* Powerful Functions
* Over 30 Field Types
* Extensive Documentation
* Millions of Users

= Links =
* [Website](https://www.advancedcustomfields.com/?utm_source=wordpress.org&utm_medium=free%20plugin%20listing&utm_campaign=ACF%20Website)
* [Documentation](https://www.advancedcustomfields.com/resources/?utm_source=wordpress.org&utm_medium=free%20plugin%20listing&utm_campaign=ACF%20Website)
* [Support](https://support.advancedcustomfields.com)
* [ACF PRO](https://www.advancedcustomfields.com/pro/?utm_source=wordpress.org&utm_medium=free%20plugin%20listing&utm_campaign=ACF%20Pro%20Upgrade)

= PRO =
The Advanced Custom Fields plugin is also available in a professional version which includes more fields, more functionality, and more flexibility. The ACF PRO plugin features:

* The [Repeater Field](https://www.advancedcustomfields.com/resources/repeater/?utm_source=wordpress.org&utm_medium=free%20plugin%20listing&utm_campaign=ACF%20Pro%20Upgrade) allows you to create a set of sub fields which can be repeated again, and again, and again.
* [ACF Blocks](https://www.advancedcustomfields.com/resources/blocks/?utm_source=wordpress.org&utm_medium=free%20plugin%20listing&utm_campaign=ACF%20Pro%20Upgrade), a powerful PHP-based framework for developing custom block types for the WordPress Block Editor (aka Gutenberg).
* Define, create, and manage content with the [Flexible Content Field](https://www.advancedcustomfields.com/resources/flexible-content/?utm_source=wordpress.org&utm_medium=free%20plugin%20listing&utm_campaign=ACF%20Pro%20Upgrade), which provides for multiple layout and sub field options.
* Use the [Options Page](https://www.advancedcustomfields.com/resources/options-page/?utm_source=wordpress.org&utm_medium=free%20plugin%20listing&utm_campaign=ACF%20Pro%20Upgrade) feature to add custom admin pages to edit ACF fields.
* Build fully customisable image galleries with the [Gallery Field](https://www.advancedcustomfields.com/resources/gallery/?utm_source=wordpress.org&utm_medium=free%20plugin%20listing&utm_campaign=ACF%20Pro%20Upgrade).
* Unlock a more efficient workflow for managing field settings by reusing existing fields and field groups on demand with the [Clone Field](https://www.advancedcustomfields.com/resources/clone/?utm_source=wordpress.org&utm_medium=free%20plugin%20listing&utm_campaign=ACF%20Pro%20Upgrade).

[Upgrade to ACF PRO](https://www.advancedcustomfields.com/pro/?utm_source=wordpress.org&utm_medium=free%20plugin%20listing&utm_campaign=ACF%20Pro%20Upgrade)

== Installation ==

From your WordPress dashboard

1. **Visit** Plugins > Add New
2. **Search** for "Advanced Custom Fields" or “ACF”
3. **Install and Activate** Advanced Custom Fields from your Plugins page
4. **Click** on the new menu item "ACF" and create your first custom field group, or register a custom post type or taxonomy.
5. **Read** the documentation to [get started](https://www.advancedcustomfields.com/resources/getting-started-with-acf/?utm_source=wordpress.org&utm_medium=free%20plugin%20listing&utm_campaign=ACF%20Website)


== Frequently Asked Questions ==

= What kind of support do you provide? =

**Support Forums.** Our ACF Community Forums provide a great resource for searching and finding previously answered and asked support questions. You may create a new thread on these forums, however, it is not guaranteed that you will receive an answer from our support team. This is more of an area for ACF developers to talk to one another, post ideas, plugins and provide basic help. [View the Support Forum](https://support.advancedcustomfields.com/)


== Screenshots ==

1. Simple & Intuitive

2. Made for Developers

3. All About Fields

4. Registering Custom Post Types

5. Registering Taxonomies


== Changelog ==

= 6.7.0.2 =
*Release Date 11th December 2025*
*PRO Only Release*

* Fix - Posts with V3 blocks can now be saved without clicking the block

= 6.7.0.1 =
*Release Date 10th December 2025*
*PRO Only Release*

* Fix - Fields in V3 Blocks used as an InnerBlock are now clickable
* Fix - V3 Blocks with a script tag in the render template no longer crash in the editor
* Fix - V3 Blocks with Inline Editing enabled no longer crash the browser tab in some scenarios
* Fix - V3 Blocks with Inline Editing enabled used as an InnerBlock no longer update the field values of the parent block
* Fix - Quickly closing the expanded editor for V3 blocks will no longer prevent field values from being updated

= 6.7.0 =
*Release Date 3rd December 2025*

* [View Release Post](https://www.advancedcustomfields.com/blog/acf-6-7-released/)
* New - ACF Blocks V3 now supports Inline Editing - edit your block content directly in place, right inside the editor. Just opt in to enable it.
* Enhancement - Accordion field accessibility improvements
* Enhancement - Google Maps field accessibility improvements
* Enhancement - Styling improvements to the V3 Blocks expanded editor
* Fix - V3 ACF Blocks validation now clears properly when more than one block is in the editor.
* Fix - Relationship, Post Object, and Page Link fields now sort posts correctly on WordPress 6.8+
* Fix - List tables now respect the convert_field_name_to_lowercase javascript filter
* Fix - WYSIWYG field on attachment pages no longer sends ajax on every keystroke

= 6.6.2 =
*Release Date 29th October 2025*

* Enhancement - Added a new `convert_field_name_to_lowercase` JS filter to allow uppercase letters in ACF field names
* Enhancement - The form for V3 Blocks can now be optionally hidden from the sidebar via a new `hideFieldsInSidebar` setting in block.json
* Enhancement - V3 Blocks now display an "Open Expanded Editor" button in the sidebar for easier access to the full edit form
* Fix - The buttons to reorder ACF metaboxes are no longer hidden for metaboxes in the block editor sidebar
* Fix - V3 Blocks now display a fallback message when the block preview can't be rendered due to invalid HTML being used in field values
* Fix - V3 Blocks no longer show a loading spinner when preloaded
* Fix - V3 Blocks now save default field values even if the block wasn't interacted with before saving
* Fix - Pressing CMD/CTRL + Z no longer causes the fields to disappear in V3 Blocks
* Fix - The form for V3 Blocks now opens on the left side in RTL languages

= 6.6.1 =
*Release Date 16th October 2025*

* Fix - The Color Picker palette now displays correctly with a larger number of custom palette colors
* Fix - The WYSIWYG field no longer displays an extra textarea in ACF Blocks
* Fix - The type signature of the ACF Blocks render function now matches prior to 6.6, resolving potential type hinting errors
* Fix - V3 Blocks now correctly update the block preview when changing text controls
* Fix - V3 Blocks now work correctly in the Widget block editor
* Fix - V3 Blocks no longer render an extra hidden div into the block editor
* Fix - Fields on V3 blocks now consistently render properly when switching between “Post” and “Block” view in the sidebar

= 6.6.0 =
*Release Date 7th October 2025*

* [View Release Post](https://www.advancedcustomfields.com/blog/acf-6-6-released/)
* New - ACF Blocks Version 3 supports WordPress Block API Version 3
* New - ACF now requires WordPress version 6.2 or newer
* Enhancement - Field Groups can now have a separate Display Title
* Enhancement - Accessibility improvements for button groups, checkbox, radio, and image field types
* Enhancement - Color Picker field can now use a custom palette or use theme.json colors as the palette
* Enhancement - ACF admin notices now use WordPress core styles again
* Enhancement - The Flexible Content “Delete Layout” and “Rename Layout” modals now display correctly on mobile
* Fix - Blocks V3: You can now edit ACF blocks in Edit mode inside WP Core's pattern editor
* Fix - Blocks V3: Validation errors now first appear after you click "Save/publish", as opposed to immediately, while you are typing into a field for the first time
* Fix - Blocks V3: After fixing a field validation error it shows as fixed immediately as opposed to needing to click out of the block and back into it
* Fix - Blocks V3: Blocks with radio buttons no longer affect each other's field values
* Fix - Blocks V3: Blocks with required radio buttons now validate correctly
* Fix - Blocks V3: ACF field validation now works in the Site Editor
* Fix - Blocks V3: WYSIWYG fields are no longer affected by typing into other blocks
* Fix - New field names are lowercase only
* Fix - Icon Picker now enforces required validation
* Fix - Calls to jQuery’s deprecated focus function have been updated to use the trigger function
* Fix - Layouts inside cloned Flexible Content fields can now be disabled and renamed
* i18n - Updated PRO Japanese translations (props danielkun)

= 6.5.1 =
*Release Date 10th September 2025*

* Enhancement - The Flexible Content “Expand All” and “Collapse All” button now appear correctly on mobile
* Enhancement - The Flexible Content delete layout button is now back in the main layout header, making it easier to delete layouts
* Enhancement - The JSON import tool now limits the selectable files to JSON files
* Fix - Disabled Flexible Content layouts are no longer counted towards min/max layout validation
* Fix - The top “Add Row” button for layouts is now disabled when layouts have reached the max layouts validation
* Fix - The per-layout “Add Row” and “Duplicate Layout” buttons are now disabled when layouts have reached the max layouts validation
* Fix - Disabling Flexible Content layouts no longer disables layouts in cloned Flexible Content fields using a different post ID on the same page
* Fix - Flexible Content “Add Layout” menu is no longer hidden by some field types
* Fix - Flexible Content layout names can now allow some safe HTML
* Fix - When creating a temporary post type during import, ACF now correctly sets the ACF post type, rather than defaulting to post
* Fix - ACF PRO updates are now shown even when no other plugins have an update available

= 6.5.0.1 =
*Release Date 12th August 2025*
*PRO Only Release*

* Fix - Flexible Content layouts configured with a "Layout" setting of "Table" are now rendered correctly in the post editor
* Fix - Flexible Content "Add Layout" buttons now insert the new layout in the correct position
* Fix - Long Flexible Content layout names no longer extend outside of the "Add Layout" dropdown

= 6.5.0 =
*Release Date 11th August 2025*

* New - Flexible Content layouts can now be renamed in the post editor, giving content editors better clarity when managing layouts
* New - Flexible Content layouts can now be disabled, preventing them from rendering on the frontend without needing to delete their data
* New - Flexible Content layouts can now be collapsed and expanded in bulk for faster content editing
* New - Editing a Flexible Content layout now highlights the layout being edited, making it easier to identify
* New - The Date and Date Time Picker fields can now be configured to default to the current date
* Fix - Custom Icon Picker tabs now work correctly when used inside an ACF Block
* Fix - Duplicating a Field Group no longer causes a fatal error when using Russian translations
* Fix - ACF classes no longer use dynamic class properties, improving compatibility with PHP 8.2+
* Fix - ACF PRO no longer shows an update available immediately after updating to the latest version
* Fix - Field group metabox collapse and expand buttons are no longer misaligned in the post editor
* Fix - The ACF Site Health section no longer causes a PHP warning when field group location rules are incomplete
* Security - HTML is now escaped from field validation errors and tooltips

= 6.4.3 =
*Release Date 22nd July 2025*

* Security - Unsafe HTML in field group labels is now correctly escaped for conditionally loaded field groups, resolving a JS execution vulnerability in the classic editor
* Security - HTML is now escaped from field group labels when output in the ACF admin
* Security - Bidirectional and Conditional Logic Select2 elements no longer render HTML in field labels or post titles
* Security - The `acf.escHtml` function now uses the third party DOMPurify library to ensure all unsafe HTML is removed. A new `esc_html_dompurify_config` JS filter can be used to modify the default behaviour
* Security - Post titles are now correctly escaped whenever they are output by ACF code. Thanks to Shogo Kumamaru of LAC Co., Ltd. for the responsible disclosure
* Security - An admin notice is now displayed when version 3 of the Select2 library is used, as it has now been deprecated in favor of version 4

= 6.4.2 =
*Release Date 20th May 2025*

* New - In ACF PRO, fields can now be added to WooCommerce Subscriptions when using HPOS
* Security - Changing a field type no longer enables the "Allow Access to Value in Editor UI" setting
* Fix - Paginated Repeater fields no longer save duplicate values when saving to a WooCommerce Order with HPOS disabled
* Fix - Blocks registered via acf_register_block_type() with a `parent` value of `null` no longer fail to register

= 6.4.1 =
*Release Date 8th May 2025*

* New - Select fields can now be configured to allow creating new options when editing the field's value (requires the "Stylized UI" and "Multiple" field settings to be enabled)
* Enhancement - The "Escaped HTML" warning notice [introduced in ACF 6.2.5](https://www.advancedcustomfields.com/blog/acf-6-2-5-security-release/) is now disabled by default
* Enhancement - The Icon Picker field now supports supplying an array of icons to a custom tab via a new `acf/fields/icon_picker/{tab_name}/icons` filter
* Fix - ACF Blocks are now forced into preview mode when editing a synced pattern
* Fix - The free ACF plugin once again works with the Classic Widgets plugin and the legacy ACF Options Page addon
* Fix - ACF no longer causes an infinite loop in bbPress when editing replies

= 6.4.0.1 =
*Release Date 8th April 2025*

* Fix - Calling `acf_get_reference()` with an invalid field name no longer causes a fatal error

= 6.4.0 =
*Release Date 7th April 2025*

* New - In ACF PRO, fields can now be added to WooCommerce orders when using HPOS
* Enhancement - ACF now uses Composer to autoload some classes
* Fix - Repeater pagination now works when the Repeater is inside a Group field
* Fix - Various translations are no longer called before the WordPress `init` action hook
* Security - Link field no longer has a minor local XSS vulnerability
* i18n - Various British English translation strings no longer have a quoting issue breaking links
* i18n - Added Dutch (formal) translations (props @toineenzo)

= 6.3.12 =
*Release Date 21st January 2025*

* Enhancement - Error messages that occur when field validation fails due an insufficient security nonce now have additional context
* Fix - Duplicated ACF blocks no longer lose their field values after the initial save when block preloading is enabled
* Fix - ACF Blocks containing complex field types now behave correctly when React StrictMode is enabled

= 6.3.11 =
*Release Date 12th November 2024*

* Enhancement - Field Group keys are now copyable on click
* Fix - Repeater tables with fields hidden by conditional logic now render correctly
* Fix - ACF Blocks now behave correctly in React StrictMode
* Fix - Edit mode is no longer available to ACF Blocks with an WordPress Block API version of 3 as field editing is not supported in the iframe

= 6.3.10.2 =
*Release Date 29th October 2024*
*Free Only Release*

* Fix - ACF Free no longer causes a fatal error when any unsupported legacy ACF addons are active

= 6.3.10.1 =
*Release Date 29th October 2024*
*Free Only Release*

* Fix - ACF Free no longer causes a fatal error when WPML is active

= 6.3.10 =
*Release Date 29th October 2024*

* Security - Setting a metabox callback for custom post types and taxonomies now requires being an admin, or super admin for multisite installs
* Security - Field specific ACF nonces are now prefixed, resolving an issue where third party nonces could be treated as valid for AJAX calls
* Enhancement - A new “Close and Add Field” option is now available when editing a field group, inserting a new field inline after the field being edited
* Enhancement - ACF and ACF PRO now share the same plugin updater for improved reliability and performance
* Fix - Exporting post types and taxonomies containing metabox callbacks now correctly exports the user defined callback

= 6.3.9 =
*Release Date 15th October 2024*

* Security - Editing an ACF Field in the Field Group editor can no longer execute a stored XSS vulnerability. Thanks to Duc Luong Tran (janlele91) from Viettel Cyber Security for the responsible disclosure
* Security - Post Type and Taxonomy metabox callbacks no longer have access to any superglobal values, hardening the original fix from 6.3.8 further
* Fix - ACF fields now correctly validate when used in the block editor and attached to the sidebar

= 6.3.8 =
*Release Date 7th October 2024*

* Security - ACF defined Post Type and Taxonomy metabox callbacks no longer have access to $_POST data. (Thanks to the Automattic Security Team for the disclosure)

= 6.3.7 =
*Release Date 2nd October 2024*

* Security - ACF Free now uses its own update mechanism from WP Engine servers

= 6.3.6 =
*Release Date 28th August 2024*

* Security - Newly added fields now have to be explicitly set to allow access in the content editor (when using the ACF shortcode or Block Bindings) to increase the security around field permissions. [See the release notes for more details](https://www.advancedcustomfields.com/blog/acf-6-3-6/#field-value-access-editor)
* Security Fix - Field labels are now correctly escaped when rendered in the Field Group editor, to prevent a potential XSS issue. Thanks to Ryo Sotoyama of Mitsui Bussan Secure Directions, Inc. for the responsible disclosure
* Fix - Validation and Block AJAX requests nonces will no longer be overridden by third party plugins
* Fix - Detection of third party select2 libraries will now default to v4 rather than v3
* Fix - Block previews will now display an error if the render template PHP file is not found

= 6.3.5 =
*Release Date 1st August 2024*

* Fix - The ACF Shortcode now correctly outputs a comma separated list of values for arrays
* Fix - ACF Blocks rendered in auto mode now correctly re-render their previews after editing fields
* Fix - ACF Block validation no longer raises required validation messages if HTML will automatically select the first value when rendered
* Fix - ACF Block validation no longer raises required validation messages if a default value will be rendered as the field value
* Fix - ACF Block validation no longer raises required validation messages for fields hidden by conditional logic when adding a new block

= 6.3.4 =
*Release Date 18th July 2024*

* Security Fix - The ACF shortcode now prevents access to fields from different private posts by default. View the [release notes](https://www.advancedcustomfields.com/blog/acf-6-3-4) for more information
* Fix - Users without the `edit_posts` capability but with custom capabilities for a editing a custom post type, can now correctly load field groups loaded via conditional location rules
* Fix - Block validation no longer validates a field’s sub fields on page load, only on edit. This resolves inconsistent validation errors on page load or when first adding a block
* Fix - Deactivating an ACF PRO license will now remove the license key even if the server call fails
* Fix - Field types returning objects no longer cause PHP warnings and errors when output via `the_field`, `the_sub_field` or the ACF shortcode, or when retrieved by a `get_` function with the escape html parameter set
* Fix - Server side errors during block rendering now gracefully displays an error to the editor

= 6.3.3 =
*Release Date 27th June 2024*

* Enhancement - All dashicons are now available to the icon picker field type
* Fix - The True/False field now correctly shows it’s description message beside the switch when using the Stylized UI setting
* Fix - Conditional logic values now correctly load options when loaded over AJAX
* Fix - ACF PRO will no longer trigger license validation calls when loading a front-end page
* i18n - Fixed an untranslatable string on Option Page previews

= 6.3.2.1 =
*Release Date 24th June 2024*
*PRO Only Release*

* Fix - ACF Blocks no longer trigger a JavaScript error when fetched via AJAX

= 6.3.2 =
*Release Date 24th June 2024*

* Security Fix - ACF now generates different nonces for each AJAX-enabled field, preventing subscribers or front-end form users from querying other field results
* Security Fix - ACF now correctly verifies permissions for certain editor only actions, preventing subscribers performing those actions
* Security Fix - Deprecated a legacy private internal field type (output) to prevent it being able to output unsafe HTML
* Security Fix - Improved handling of some SQL filters and other internal functions to ensure output is always correctly escaped
* Security Fix - ACF now includes blank index.php files in all folders to prevent directory listing of ACF plugin folders for incorrectly configured web servers

= 6.3.1.2 =
*Release Date 6th June 2024*
*PRO Only Release*

* Fix - ACF Blocks in widget areas no longer cause a fatal error when no context is available
* Fix - ACF Blocks with no fields assigned no longer show a gap in the sidebar where the form would render

= 6.3.1.1 =
*Release Date 6th June 2024*
*PRO Only Release*

* Fix - Repeater and Flexible Content fields no longer error when duplicating or removing rows containing Icon Picker subfields
* Fix - ACF Blocks containing Flexible Content fields now correctly load their edit form
* Fix - ACF Blocks no longer have a race condition where the data store is not initialized when read
* Fix - ACF Blocks no longer trigger a JS error for blocks without fields and with an empty no-fields message
* Fix - ACF Block preloading now works correctly for fields consuming custom block context
* Fix - ACF Block JavaScript debug messages now correctly appear when SCRIPT_DEBUG is true

= 6.3.1 =
*Release Date 4th June 2024*

* Enhancement - Options Pages registered in the UI can now be duplicated
* Fix - ACF Block validation now correctly validates Repeater, Group, and Flexible Content fields
* Fix - ACF Block validation now correctly validates when a field is using a non-default return type
* Fix - Fields moved between field groups now correctly updates both JSON files
* Fix - Icon Picker fields now render correctly when using left-aligned labels
* Fix - Icon Picker fields no longer renders tabs if only one tab is selected for display
* Fix - Icon Picker fields no longer crash the post editor if no icon picker tabs are selected for displayed
* Fix - True/False field now better handles longer On/Off labels
* Fix - Select2 results loaded by AJAX for multi-select Taxonomy fields no longer double encode HTML entities

= 6.3.0.1 =
*Release Date 22nd May 2024*

* Fix - A possible fatal error no longer occurs in the new site health functionality for ACF PRO users
* Fix - A possible undefined index error no longer occurs in ACF Blocks for ACF PRO users

= 6.3.0 =
*Release Date 22nd May 2024*

* New - ACF now requires WordPress version 6.0 or newer, and PHP 7.4 or newer.
* New - ACF Blocks now support validation rules for fields. View the [release notes](https://www.advancedcustomfields.com/blog/acf-6-3-0-released) for more information
* New - ACF Blocks now supports storing field data in the postmeta table rather than in the post content
* New - Conditional logic rules for fields now support selecting specific values for post objects, page links, taxonomies, relationships and users rather than having to enter the ID
* New - New Icon Picker field type for ACF and ACF PRO
* New - Icon selection for a custom post type menu icon
* New - Icon selection for an options page menu icon
* New - ACF now surfaces debug and status information in the WordPress Site Health area
* New - The escaped html notice can now be permanently dismissed
* Enhancement - Tab field now supports a `selected` attribute to specify which should be selected by default, and support class attributes
* Fix - Block Preloading now works reliably in WordPress 6.5 or newer
* Fix - Select2 results loaded by AJAX for post object fields no longer double encode HTML entities
* Fix - Custom post types registered with ACF will now have custom field support enabled by default to better support revisions
* Fix - The first preview after publishing a post in the classic editor now displays ACF fields correctly
* Fix - ACF fields and Flexible Content layouts are now correctly positioned while dragging
* Fix - Copying the title of a field inside a Flexible Content layout no longer adds whitespace to the copied value
* Fix - Flexible Content layout names are no longer converted to lowercase when edited
* Fix - ACF Blocks with attributes without a default now correctly register
* Fix - User fields no longer trigger a 404 when loading results if the nonce generated only contains numbers
* Fix - Description fields for ACF items now support being solely numeric characters
* Fix - The field group header no longer appears above the WordPress admin menu on small screens
* Fix - The `acf/json/save_file_name` filter now correctly applies when deleting JSON files
* i18n - All errors raised during ACF PRO license or update checks are now translatable
* Other - The ACF Shortcode is now disabled by default for new installations of ACF as discussed in the [ACF 6.2.7 release notes](https://www.advancedcustomfields.com/blog/acf-6-2-7-security-release/#security-and-the-acf-shortcode)

= 6.2.10 =
*Release Date 15th May 2024*

* Security Fix - ACF Blocks no longer allow render templates, or render or asset callbacks to be overridden in the block's attributes. For full information, please read [the release blog post](https://www.advancedcustomfields.com/blog/acf-pro-6-2-10-security-release/)

= 6.2.9 =
*Release Date 8th April 2024*

* Enhancement - The Select2 escapeMarkup function can now be overridden when initializing a custom Select2
* Fix - “Hide on Screen” settings are now correctly applied when using conditionally loaded field groups
* Fix - Field names are no longer converted to lowercase when editing the name
* Fix - Field group titles will no longer convert HTML entities into their encoded form

= 6.2.8 =
*Release Date 2nd April 2024*

* New - Support for the Block Bindings API in WordPress 6.5 with a new `acf/field` source. For more information on how to use this, please read [the release blog post](https://www.advancedcustomfields.com/blog/acf-6-2-8)
* New - Support for performance improvements for translations in WordPress 6.5
* Enhancement - A new JS filter, `select2_escape_markup` now allows fields to customize select2's HTML escaping behavior
* Fix - Options pages can no longer set to have a parent of themselves
* Fix - ACF PRO license activations on multisite subsite installs will now use the correct site URL
* Fix - ACF PRO installed on multisite installs will no longer try to check for updates resulting in 404 errors when the updates page is not visible
* Fix - ACF JSON no longer produces warnings on Windows servers when no ACF JSON folder is found
* Fix - Field and layout names can now contain valid non-ASCII characters
* Other - ACF PRO now requires a valid license to be activated in order to use PRO features. [Learn more](https://www.advancedcustomfields.com/resources/license-activations/)

= 6.2.7 =
*Release Date 27th February 2024*

* Security Fix - `the_field` now escapes potentially unsafe HTML as notified since ACF 6.2.5. For full information, please read [the release blog post](https://www.advancedcustomfields.com/blog/acf-6-2-7-security-release/)
* Security Fix - Field and Layout names are now enforced to alphanumeric characters, resolving a potential XSS issue
* Security Fix - The default render template for select2 fields no longer allows HTML to be rendered resolving a potential XSS issue
* Security Enhancement - A `acf/shortcode/prevent_access` filter is now available to limit what data the ACF shortcode is allowed to access
* Security Enhancement - i18n translated strings are now escaped on output
* Enhancement - ACF now universally uses WordPress file system functions rather than native PHP functions

= 6.2.6.1 =
*Release Date 7th February 2024*

* Fix - Fatal JS error no longer occurs when editing fields in the classic editor when Yoast or other plugins which load block editor components are installed
* Fix - Using `$escape_html` on get functions for array returning field types no longer produces an Array to string conversion error

= 6.2.6 =
*Release Date 6th February 2024*

* Enhancement - The `get_field()` and other `get_` functions now support an `escape_html` parameter which return an HTML safe field value
* Enhancement - The URL field will be now escaped with `esc_url` rather than `wp_kses_post` when returning an HTML safe value
* Fix - ACF fields will now correctly save into the WordPress created revision resolving issues with previews of drafts on WordPress 6.4 or newer
* Fix - Multisite subsites will now correctly be activated by the main site where the ACF PRO license allows, hiding the updates page on those subsites
* Fix - Field types in which the `required` property would have no effect (such as the tab, or accordion) will no longer show the option
* Fix - Duplicating a field group now maintains the current page of field groups being displayed
* Fix - Fields in ACF Blocks in edit mode in hybrid themes will now use ACF's styling, rather than some attributes being overridden by the theme
* Fix - Text in some admin notices will no longer overlap the dismiss button
* Fix - The word `link` is now prohibited from being used as a CPT name to avoid a WordPress core conflict
* Fix - Flexible content layouts can no longer be duplicated over their maximum count limit
* Fix - All ACF notifications shown outside of ACF's admin screens are now prefixed with the plugin name
* Fix - ACF no longer checks if a polyfill is needed for <PHP7 and the polyfill has been removed

= 6.2.5 =
*Release Date 16th January 2024*

* Security Fix - The ACF shortcode will now run all output through `wp_kses`, escaping unsafe HTML. This may be a breaking change to your site but is required for security, a message will be shown in WordPress admin if you are affected. Please see the [blog post for this release for more information.](https://www.advancedcustomfields.com/blog/acf-6-2-5-security-release/) Thanks to Francesco Carlucci via Wordfence for the responsible disclosure
* Security - ACF now warns via an admin message, when upcoming changes to `the_field` and `the_sub_field` may require theme changes to your site to avoid stripping unsafe HTML. Please see the [blog post for this release for more information](https://www.advancedcustomfields.com/blog/acf-6-2-5-security-release/)
* Security - Users may opt in to automatically escaping unsafe HTML via a new filter `acf/the_field/escape_html_optin` when using `the_field` and `the_sub_field` before this becomes default in an upcoming ACF release.

= 6.2.4 =
*Release Date 28th November 2023*

* Fix - Custom Post Types labels now match the WordPress 6.4 behavior for "Add New" labels
* Fix - When exporting both post types and taxonomies as PHP, taxonomies will now appear before post types, matching the order ACF registers them. This resolves issues where taxonomy slugs will not work in post type permalinks
* Fix - Advanced Settings for Taxonomies, Post Types or Options Pages now display with the correct top padding when toggled on
* Fix - When a parent option page is set to "Redirect to Child Page", the child page will now correctly show it's parent setting
* Fix - When activated as a must-use plugin, the ACF PRO "Updates" page is now visible. Use the existing `show_updates` setting to hide
* Fix - When activated as a must-use plugin, ACF PRO licenses defined in code will now correctly activate sites
* Fix - When `show_updates` is set or filtered to false, ACF PRO will now automatically still activate defined licenses
* i18n - Maintenance and internal upstream messages from the ACF PRO activation server are now translatable

= 6.2.3 =
*Release Date 15th November 2023*

* [View Release Post](https://www.advancedcustomfields.com/blog/acf-6-2-3/)
* New - An ACF Blocks specific JSON schema for block.json is now available on [GitHub](https://github.com/AdvancedCustomFields/schemas)
* New - Flexible Content fields now show the layout name in the layout's header bar and supports click-to-copy
* New - Duplicating Flexible Content layouts now appends "Copy" to their name and label, matching the behavior of field group duplication
* Enhancement - ACF PRO will now automatically attempt license reactivation when the site URL changes, e.g. after a site migration. This resolves issues where updates may fail
* Enhancement - Presentation setting for "High" placement of the Field Group made clear that it's not supported in the block editor
* Fix - `acf_format_date` now ensures the date parameter is valid to prevent fatal errors if other data types are passed in
* Fix - CPTs with a custom icon URL now display the posts icon in the location column of the field groups screen
* Fix - The ACF JSON import form will now disable on first submit resolving an issue where you could submit the form twice
* Fix - The "Add Row" button in the Flexible Content field now displays correctly when using nested layouts
* Fix - Warning and Error notices no longer flicker on ACF admin pages load
* i18n - ACF PRO license activation success and error messages are now translatable

= 6.2.2 =
*Release Date 25th October 2023*

* Enhancement - ACF Blocks which have not been initialized by the editor will now render correctly
* Enhancement - Added a new `acf/filesize` filter to allow third party media plugins to bypass ACF calling `filesize()` on attachments with uncached file sizes, which may result in a remote download if offloaded
* Enhancement - ACF PRO license status and subscription expiry dates are now displayed on the “Updates” page
* Fix - Product pages for WooCommerce version 8.2 or newer now correctly support field group location rules
* Fix - Relationship field items can now be removed on mobile devices
* Fix - Color picker fields no longer autocomplete immediately after typing 3 valid hex characters
* Fix - Field settings no longer appear misaligned when the viewport is something other than 100%
* Fix - Select fields without an aria-label no longer throw a warning
* Fix - CPTs and Taxonomies with a custom text domain now export correctly when using PHP export

= 6.2.1.1 =
*Release Date 8th September 2023*

* Fix - Editing a field group no longer generates an error when UI options pages are disabled

= 6.2.1 =
*Release Date 7th September 2023*

* New - Options Pages created in the admin UI can now be assigned as child pages for any top-level menu item
* New - Added a "Title Placeholder" setting to ACF Post Types which filters the "Add title" text when editing posts
* Enhancement - ACF PRO will now warn when it can't update due to PHP version incompatibilities
* Enhancement - ACF PRO will now work correctly with WordPress automatic updates
* Enhancement - The internal ACF Blocks template attribute parser function `parseNodeAttr` can now be shortcut with the new `acf_blocks_parse_node_attr` filter.
* Enhancement - Removed legacy code for supporting WordPress versions under 5.8
* Fix - The "Menu Position" setting is no longer hidden for child options pages
* Fix - The tabs for the "Advanced" settings in Post Types and Taxonomies are now rendered inside a wrapper div
* Fix - Options pages will no longer display as a child page in the list view when set to a top level page after previously being a child
* Fix - Conflict with Elementor CSS breaking the ACF PRO banner
* Fix - Errors generated during the block editor's `savePost` function will no longer be caught and ignored by ACF

= 6.2.0 =
*Release Date 9th August 2023*

* [View Release Post](https://www.advancedcustomfields.com/blog/acf-6-2-0-released/)
* New - ACF now requires WordPress version 5.8 or newer, and PHP 7.0 or newer. View the [release post](https://www.advancedcustomfields.com/blog/acf-6-2-0-released/#version-requirements) for more information
* New - Bidirectional Relationships now supported for Relationship, Post Object, User and Taxonomy fields. View the [release post](https://www.advancedcustomfields.com/blog/acf-6-2-0-released/#bidirectional-relationships) for more information
* New - [Options Pages](https://www.advancedcustomfields.com/resources/options-page/) can now be registered and managed by the admin UI in ACF PRO
* New - Link to the [product feedback board](https://www.advancedcustomfields.com/feedback/) added to the plugin footer
* Enhancement - ACF JSON now supports multiple save locations (props Freddy Leitner)
* Enhancement - ACF Post Types and Taxonomies can now be duplicated
* Enhancement - The filename for JSON files can now be customized with the `acf/json/save_file_name` filter
* Fix - REST updates of fields with choices containing integer or mixed keys now behave correctly
* Fix - Using the `block_type_metadata_settings` PHP filter to add usesContext values no longer breaks ACF blocks
* Fix - Notice to import post types/taxonomies from CPTUI no longer flashes on page load
* Fix - Various buttons for fields in blocks now display correctly
* Fix - The settings for the DateTime field are no longer cut off when nested in several fields in the field group editor
* Fix - The newline added to the end of JSON files will now use `PHP_EOL` to detect the correct newline character with a filter `acf/json/eof_newline` to alter it.
* i18n - Updated French and Portuguese translations (Thanks to pedro-mendonca and maximebj)

[View the full changelog](https://www.advancedcustomfields.com/changelog/)

== Upgrade Notice ==
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
