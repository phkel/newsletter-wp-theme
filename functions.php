<?php
/**
 * Theme functions and definitions
 *
 * @package newsletter
 */


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
add_action(
    'after_setup_theme', function () {
        /**
         * Enable plugins to manage the document title
         * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
         */
        add_theme_support('title-tag');

        /**
         * Enable post thumbnails
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        /**
         * Enable HTML5 markup support
         * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
         */
        add_theme_support(
            'html5', [
                'search-form',
                'gallery',
                'caption',
            ]
        );

        /**
         * Hide Advanced Custom Fields UI in live and staging environments for avoiding conflicts.
         * Read more at http://awesomeacf.com/how-to-avoid-conflicts-when-using-the-acf-local-json-feature/
         */
        add_filter(
            'acf/settings/show_admin', function () {
                $site_url = get_bloginfo('url');

                // An array of site urls where ACF is visible.
                $visible = array(
                    'http://newsletter.local'
                );

                if (in_array($site_url, $visible, true)) {
                    return true;
                } else {
                    return false;
                }
            }
        );

        /**
         * Cleanup head
         */
        add_theme_support('automatic-feed-links');
        add_filter('feed_links_show_comments_feed', '__return_false');
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');

        /**
         * Register menus
         */
        register_nav_menus(
            [
              'primary' => __('Primary Menu', 'newsletter')
            ]
        );
    }
);

/**
 * Auto update core (minor and major), plugins and themes.
 */
add_filter('auto_update_plugin', '__return_true');
add_filter('auto_update_theme', '__return_true');
add_filter('allow_minor_auto_core_updates', '__return_true');
add_filter('allow_major_auto_core_updates', '__return_true');

/**
 * Disable XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

add_filter(
    'wp_headers', function ($headers) {
        unset($headers['X-Pingback']);
        return $headers;
    }
);

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 * Function from Twenty Sixteen.
 */
add_action(
    'wp_head', function() {
        echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
    }, 0
);

/**
 * Enqueues scripts and styles.
 */
add_action(
    'wp_enqueue_scripts', function () {
        wp_enqueue_style('main-style', get_theme_file_uri('dist/main.css'), array('fontshare'), filemtime(get_theme_file_path('dist/main.css')), 'screen');
        wp_enqueue_script('main-script', get_theme_file_uri('dist/main.js'), array(), filemtime(get_theme_file_path('dist/main.js')), true);
        wp_enqueue_style('fontshare', 'https://api.fontshare.com/css?f[]=author@500&f[]=switzer@400,600,700&display=swap', array(), null, 'screen');
    }
);

/**
 * Remove text color option from tinymce
 *
 * @param  array $buttons All the buttons.
 * @return array          New array
 */
add_filter(
    'mce_buttons_2', function ($buttons) {
        $remove = array('forecolor');
        return array_diff($buttons, $remove);
    }
);

/**
 *  Remove the H1 tag from the WordPress editor.
 *
 *  @param   array $settings  The array of editor settings.
 *  @return  array            The modified edit settings
 */
add_filter(
    'tiny_mce_before_init', function ($settings) {
        $settings['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;';
        return $settings;
    }
);


/**
 * Disable Block Editor on front page
 */
add_filter('use_block_editor_for_post', 'disable_block_editor_on_front_page', 10, 2);

function disable_block_editor_on_front_page($use_block_editor)
{
    global $post_ID;

    if ((int) get_option('page_on_front') === $post_ID) {
        return false;
    }

    return $use_block_editor;
}

/**
 * Register Quote custom post type
 */
function newsletter_quote_post_type()
{

    $labels = array(
        'name'          => __('Quotes by Author', 'newsletter'),
        'menu_name'     => __('Quotes', 'newsletter'),
        'singular_name' => __('Quote', 'newsletter'),
        'add_new_item'  => __('Add new', 'newsletter'),
    );
    $args   = array(
        'labels'        => $labels,
        'supports'      => array( 'title', 'revisions' ),
        'public'        => true,
        'menu_position' => 10,
        'menu_icon'     => 'dashicons-groups',
        'show_in_rest'  => true,
        'has_archive'   => false,
        'publicly_queryable' => false,
    );
    register_post_type('quotes', $args);
}
add_action('init', 'newsletter_quote_post_type', 0);

function change_default_title( $title ){
    $screen = get_current_screen();

    if  ( $screen->post_type == 'quotes' ) {
        return 'Quote author name';
    }
}

add_filter( 'enter_title_here', 'change_default_title' );
