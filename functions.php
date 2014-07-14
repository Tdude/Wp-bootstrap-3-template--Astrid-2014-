<?php // READ THIS: http://wordpress.stackexchange.com/questions/1567/best-collection-of-code-for-your-functions-php-file

/*-----------------------------------------------------------------------------------*/
/*  SHOW LOTS OF DEBUGGING WITH URL A LA BLOCKET, "?debug=2" SEE WP-CONFIG.PHP
/*-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*  LOAD AND INIT MENU CLASS
/*-----------------------------------------------------------------------------------*/
require_once( 'includes/wp_bootstrap_navwalker.php' );
require_once( 'includes/wp_bootstrap_post_type_functions.php' );
require('includes/theme_options.php');


// Get the menu name for header menu call
register_nav_menu('top-bar', __('Primary Menu'));







/////////////////////// TEST


function get_the_taxonomy( $taxonomy, $id = false ) {
  global $post;

  $id = (int) $id;
  if ( !$id )
    $id = (int) $post->ID;

  $categories = get_object_term_cache( $id, $taxonomy );
  if ( false === $categories ) {
    $categories = wp_get_object_terms( $id, $taxonomy );
    wp_cache_add($id, $categories, $taxonomy.'_relationships');
  }

  if ( !empty( $categories ) )
    usort( $categories, '_usort_terms_by_name' );
  else
    $categories = array();

  foreach ( (array) array_keys( $categories ) as $key ) {
    _make_cat_compat( $categories[$key] );
  }

  return $categories;
}







/*-----------------------------------------------------------------------------------*/
/*	REMOVE JUNK FROM HEAD
/*-----------------------------------------------------------------------------------*/
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator'); //removes WP Version # for security
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );



/*-----------------------------------------------------------------------------------*/
/*	OUTPUT WHICH THEME/TEMPLATE FILE IN HEADER W WP_HEAD OR SUCH. SHOULD BE SHORTENED
/*-----------------------------------------------------------------------------------*/
add_action('wp_footer', 'show_template');
function show_template() {
    global $template;
    // whole url to server root if possible
    //print_r($template); 
    // after last slash 
    echo '<small style="color:#ccc">';
    print_r( substr( $template, strrpos( $template, '/' ) + 1 ) );
    echo '</small>';
}



/*-----------------------------------------------------------------------------------*/
/*  ADMIN LOAD EXTRA CSS
/*-----------------------------------------------------------------------------------*/
function admin_register_head() {  
 
  echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/admin.css">';
}
add_action('admin_head', 'admin_register_head');




/*-----------------------------------------------------------------------------------*/
/*	LOAD JS
/*-----------------------------------------------------------------------------------*/
function wpbootstrap_scripts_with_jquery() {
  // Register the script like this for a theme:
	wp_register_script( 'dropdownHover', get_template_directory_uri() . '/js/bootstrap-hover-dropdown.min.js', array( 'jquery' ) );
  
  // ONLY A TEST!!! NEEDS LARGER IMGS THAN 1000px UPLOADED 
  wp_register_script( 'magnify', get_template_directory_uri() . '/js/magnify.js', array( 'jquery' ) );
	
	// For either a plugin or a theme, you can then enqueue the script:
 	wp_enqueue_script( 'bootstrap' );
	wp_enqueue_script( 'carousel' );
	wp_enqueue_script( 'dropdownHover' );
  wp_enqueue_script( 'magnify' );
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );




/*-----------------------------------------------------------------------------------*/
/*    ONLY LOAD CSS AND JS IN WPCF7 WHEN NEEDED
/*-----------------------------------------------------------------------------------*/
function remove_wpcf7_stylesheet() {
    remove_action( 'wp_head', 'wpcf7_wp_head' );
}
 
// Add the Contact Form 7 scripts on selected pages
function add_wpcf7_scripts() {
    if ( is_page('kontakt-page') )
        wpcf7_enqueue_scripts();
}
 
// Change the URL to the ajax-loader image
function change_wpcf7_ajax_loader($content) {
    if ( is_page('kontakt-page') ) {
        $string = $content;
        $pattern = '/(<img class="ajax-loader" style="visibility: hidden;" alt="ajax loader" src=")(.*)(" \/>)/i';
        $replacement = "$1".get_template_directory_uri()."/images/ajax-loader.gif$3";
        $content =  preg_replace($pattern, $replacement, $string);
    }
    return $content;
}
 
// If the Contact Form 7 Exists, do the tweaks
if ( function_exists('wpcf7_contact_form') ) {
    if ( ! is_admin() && WPCF7_LOAD_JS )
        remove_action( 'init', 'wpcf7_enqueue_scripts' );
 
    add_action( 'wp', 'add_wpcf7_scripts' );
    add_action( 'init' , 'remove_wpcf7_stylesheet' );
    add_filter( 'the_content', 'change_wpcf7_ajax_loader', 100 );
}





/*-----------------------------------------------------------------------------------*/
/*  COLORPICKERTESTELITEST
/*-----------------------------------------------------------------------------------*/
function wpboot_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker', get_template_directory_uri() . '/js/color-picker.js', array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'wpboot_color_picker' );

// ADDED TO ADMIN IN ARRAY: <input type="text" value="#bada55" class="my-color-field" data-default-color="#effeff" />




/*-----------------------------------------------------------------------------------*/
/*  REMOVE THE WORDPRESS UPDATE NOTIFICATION FOR ALL USERS EXCEPT ALL ADMINs
/*-----------------------------------------------------------------------------------*/
global $user_login;
get_currentuserinfo();
if (!current_user_can('update_plugins')) { // checks to see if current user can update plugins 
	add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
	add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}


/*-----------------------------------------------------------------------------------*/
/*	SET THE POST REVISIONS UNLESS THE CONSTANT WAS SET IN wp-config.php
/*-----------------------------------------------------------------------------------*/
if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', 5);



/*-----------------------------------------------------------------------------------*/
/*	MAKE CUSTOM POST TYPES SEARCHABLE
/*-----------------------------------------------------------------------------------*/
function filter_search($query) {
    if ($query->is_search) {
      $query->set('post_type', array('post', 'wpboot_tyger'));
    };
    return $query;
};
add_filter('pre_get_posts', 'filter_search');



/*-----------------------------------------------------------------------------------*/
/* CUSTOM ADMIN MENU LINK FOR ALL SETTINGS
/*-----------------------------------------------------------------------------------*/
function all_settings_link() {
 add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
}
add_action('admin_menu', 'all_settings_link');



// function remove_menus(){
//   
//   remove_menu_page( 'index.php' );                  //Dashboard
//   remove_menu_page( 'edit.php' );                   //Posts
//   remove_menu_page( 'upload.php' );                 //Media
//   remove_menu_page( 'edit.php?post_type=page' );    //Pages
//   remove_menu_page( 'edit-comments.php' );          //Comments
//   remove_menu_page( 'themes.php' );                 //Appearance
//   remove_menu_page( 'plugins.php' );                //Plugins
//   remove_menu_page( 'users.php' );                  //Users
//   remove_menu_page( 'tools.php' );                  //Tools
//   remove_menu_page( 'options-general.php' );        //Settings
//   
// }
// add_action( 'admin_menu', 'remove_menus' );









//  /*-----------------------------------------------------------------------------------*/
//  /*  MANIPULATE TO GET MY OWN CUSTOM FILE FOR TYGER POST TYPE 
//  // http://stanislav.it/create-wordpress-single-template-for-a-specific-category-or-custom-post-type/
//  /*-----------------------------------------------------------------------------------*/
//  function get_custom_post_type_template($single_template) {
//       global $post;
//   
//         if ($post->post_type == 'wpboot_tyger') {
//            $single_template = dirname( __FILE__ ) . '/tyger-template.php';
//       }
//       return $single_template;
//  }
//  add_filter( "single_template", "get_custom_post_type_template" ) ;
//   
//  
//  
//  /*-----------------------------------------------------------------------------------*/
//  /*	MAKE CATEGORY ARCHIVES DISPLAY ALL POSTS, REGARDLESS OF POST TYPE: good for custom post types
//  /*-----------------------------------------------------------------------------------*/
//  function any_ptype_on_cat($request) {
//   if ( isset($request['category_name']) )
//    $request['post_type'] = 'any';
//  
//   return $request;
//  }
//  add_filter('request', 'any_ptype_on_cat');






/*-----------------------------------------------------------------------------------*/
/* ADD PAGE SLUG TO BODY CLASS, IF ON A PAGE
/*-----------------------------------------------------------------------------------*/
function smartestb_pages_bodyclass($classes) {
    if (is_page()) {
        // get page slug
        global $post;
        $slug = get_post( $post )->post_name;
 
        // add slug to $classes array
        $classes[] = $slug;
        // return the $classes array
        return $classes;
    } else { 
        return $classes;
    }
}
add_filter('body_class','smartestb_pages_bodyclass');





/*-----------------------------------------------------------------------------------*/
/*	FEATURED IMAGE IN LISTVIEW IN ADMIN FOR POSTS O WPBOOT_TYGER
/*-----------------------------------------------------------------------------------*/
function wpboot_get_featured_image($post_ID) {  
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);  
    if ($post_thumbnail_id) {  
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'small-thumb');  
        return $post_thumbnail_img[0];  
    }  
}
// ADD NEW COLUMN  
function wpboot_columns_head($defaults) {  
    $defaults['featured_image'] = 'F&ouml;rvald bild';
    return $defaults;  
}
// SHOW THE FEATURED IMAGE  
function wpboot_columns_content($column_name, $post_ID) {  
    if ($column_name == 'featured_image') {  
        $post_featured_image = wpboot_get_featured_image($post_ID);  
        if ($post_featured_image) {  
            echo '<img src="' . $post_featured_image . '" />';  
        }  
    }  
}

// FOR BILDSPEL
add_filter('manage_wpboot_bildspel_posts_columns', 'wpboot_columns_head');  
add_action('manage_wpboot_bildspel_posts_custom_column', 'wpboot_columns_content', 10, 2); 

// FOR POSTS
add_filter('manage_posts_columns', 'wpboot_columns_head');  
add_action('manage_posts_custom_column', 'wpboot_columns_content', 10, 2);  

// FOR TYGER
add_filter('manage_wpboot_tyger_posts_columns', 'wpboot_columns_head');  
add_action('manage_wpboot_tyger_posts_custom_column', 'wpboot_columns_content', 10, 2); 








/*-----------------------------------------------------------------------------------*/
/*  SORTABLE LISTING IN ADMIN 
/*  http://wp.tutsplus.com/articles/tips-articles/quick-tip-make-your-custom-column-sortable/
/* http://wp.tutsplus.com/tutorials/creative-coding/add-a-custom-column-in-posts-and-custom-post-types-admin-screen/
/*-----------------------------------------------------------------------------------*/
add_filter('manage_wpboot_tyger_columns', 'extra_wpboot_tyger_columns');  
function extra_wpboot_tyger_columns($columns) {  
    $columns['tyger'] =__('Sortera','myplugindomain');  
    return $columns;  
}  

add_action( 'manage_wpboot_tyger_posts_custom_column', 'wpboot_tyger_column_content', 10, 2 );  
function wpboot_tyger_column_content( $column_name, $post_id ) {  
    if ( 'tyger' != $column_name )  
        return;  
    //Get number of posts from post meta  
    $tyger = get_post_meta($post_id, 'tyger', true);  
    echo intval($tyger);  
}  



add_filter( 'manage_wpboot_tyger_sortable_columns', 'sortable_wpboot_tyger_column' );  
function sortable_wpboot_tyger_column( $columns ) {  
    $columns['tyger'] = 'sort';  
  
    //To make a column 'un-sortable' remove it from the array  
    //unset($columns['date']);  
  
    return $columns;  
} 

add_action( 'pre_get_posts', 'wpboot_tyger_orderby' );  
function wpboot_tyger_orderby( $query ) {  
    if( ! is_admin() )  
        return;  
  
    $orderby = $query->get( 'orderby');  
  
    if( 'tyger' == $orderby ) {  
        $query->set('meta_key','tyger');  
        $query->set('orderby','meta_value');  
    }  
}  





/*-----------------------------------------------------------------------------------*/
/* FILTER NUMBER OF WORDS
/* Example: echo excerpt(25); OR echo content(25);
/*-----------------------------------------------------------------------------------*/
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
 
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  } 
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}






/*-----------------------------------------------------------------------------------*/
/* HEADER LOGO URL FOR LOGIN SCREEN (dafaults to wordpress.org)
/*-----------------------------------------------------------------------------------*/
add_filter('login_headerurl', 
    create_function(false,"return 'http://www.astrid.se';"));
 
// Your own login logo title text
function wpboot_login_title() {
    return 'Till startsidan';
}
add_filter('login_headertitle', 'wpboot_login_title');




/*-----------------------------------------------------------------------------------*/
/*	CUSTOM LOGIN LOGOTYPE
/*-----------------------------------------------------------------------------------*/
function custom_login_logo() {
  echo '<style type="text/css">
    h1 a { 
      background-image:url('.get_bloginfo('template_directory').'/images/logo-2013.svg) !important; 
      background-size: 200px 80px!important;
      width: 200px!important;
    }
    </style>';
}

add_action('login_head', 'custom_login_logo');



/*-----------------------------------------------------------------------------------*/
/*	CUSTOM FOOTER IN ADMIN
/*-----------------------------------------------------------------------------------*/
function modify_footer_admin() {
  echo 'Front end kodning av <a href="http://klickomaten.com">Tibor Berki</a>. Ring mig p&aring; 072-7150003. ';
  echo 'Drivs av <a href="http://WordPress.org">WordPress</a>. Bra dokumentation finns d&auml;r.';
}

add_filter('admin_footer_text', 'modify_footer_admin');



/*-----------------------------------------------------------------------------------*/
/*  ADMIN DASHBOARD WIDGET
 *  This function is hooked into the 'wp_dashboard_setup' action below.
/*-----------------------------------------------------------------------------------*/
function astrid_add_dashboard_widgets() {
	wp_add_dashboard_widget(
                 'astrid_dashboard_widget',         // Widget slug.
                 'If all else fails...',         // Title.
                 'astrid_dashboard_widget_function' // Display function.
        );	
}
add_action( 'wp_dashboard_setup', 'astrid_add_dashboard_widgets' );

// Create the function to output the contents of our Dashboard Widget.
function astrid_dashboard_widget_function() {
	// Display whatever it is you want to show.
	echo 'Om du kört fast och inte hittar någon info i <a href="http://codex.wordpress.org/First_Steps_With_WordPress">Wordpress dokumentation</a>,
     maila Tibor Berki som kodat denna site på <a href="mailto:tibbe@klickomaten.com">tibbe@klickomaten.com</a>, eller ring 072-7150003.';
}


/*-----------------------------------------------------------------------------------*/
/*	NAVBAR EXTRATEXT IN WIDGET
/*-----------------------------------------------------------------------------------*/
function footer1_widget_init() {
	register_sidebar( array(
		'name' => 'Footer 1 widget',
		'id' => 'footer1-widget',
		'before_title' => '<span class="hidden">',
		'after_title' => '</span>',
		'before_widget' => '',
		'after_widget' => ''
	));
}
add_action( 'widgets_init', 'footer1_widget_init' );



/*-----------------------------------------------------------------------------------*/
/*	FOOTER TEXT IN WIDGETS
/*-----------------------------------------------------------------------------------*/
function footer2_widget_init() {
	register_sidebar(array(
		'name' => 'Footer 2 widget',
		'id' => 'footer2-widget',
		'before_title' => '<span class="hidden">',
		'after_title' => '</span>',
		'before_widget' => '',
		'after_widget' => ''
	));
}
add_action( 'widgets_init', 'footer2_widget_init' );



if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Search widget top',
    'id' => 'search-widget-top',
    'description' => __('Widgets in this area will be shown in the page header area.','adapt'),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Search widget bottom',
    'id' => 'search-widget-bottom',
    'description' => __('Widgets in this area will be shown in the footer area.','adapt'),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
));



/*-----------------------------------------------------------------------------------*/
/*	REMOVE STUPID EDITING OF PHP-FILES FROM WP ADMIN
/*-----------------------------------------------------------------------------------*/
add_action('admin_init', 'my_remove_menu_elements', 102);
function my_remove_menu_elements() {
	remove_submenu_page( 'themes.php', 'theme-editor.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	IMAGES SIZES N STUFF
/*-----------------------------------------------------------------------------------*/
if (function_exists( 'add_theme_support') ) {
	add_theme_support( 'post-thumbnails');
	set_post_thumbnail_size( 'thumbnail', 196, 96, true ); // WP ORIGINAL THUMB. TRUE = HARDCROPPED
}

if ( function_exists('add_image_size') ) {
	// THEME THUMBS
	add_image_size( 'img-big',  2000, 1000, true );
	add_image_size( 'slider-small',  1000, 500, true );
	add_image_size( 'thumb-grid-6',  492, 310, true );
	add_image_size( 'thumb-grid-4',  324, 200, true );
	add_image_size( 'thumb-grid-3',  240, 150, true );
	add_image_size( 'small-thumb',  50, 50, true );

}

// FOR MEDIA LIBRARY IN ADMIN
add_filter( 'image_size_names_choose', 'my_custom_sizes' );


function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'full-size' => __('Fullstorlek'),
        'slider-small' => __('Slider p&aring; framsidan'),
        'thumb-grid-6' => __('2 bilder i rad'),
        'thumb-grid-4' => __('3 bilder i rad'),
        'thumb-grid-3' => __('4 bilder i rad'),
    ) );
}

// REMOVE DEFAULT IMG SIZES IN THEME
function astrid_filter_image_sizes( $sizes) {
	unset( $sizes['thumbnail']);
	unset( $sizes['medium']);
	unset( $sizes['large']);
	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'astrid_filter_image_sizes');




/*-----------------------------------------------------------------------------------*/
/*	GET FIRST IMAGE IN POST AND THEN FILTER
/*-----------------------------------------------------------------------------------*/
/* http://www.livexp.net/wordpress/get-the-first-image-from-the-wordpress-post-and-display-it.html
/*-----------------------------------------------------------------------------------*/
function get_first_image() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches [1] [0];

	if(!empty($first_img)){ //Defines a default image
		//$first_img = '/images/default.jpg';
		return '<img src="' .$first_img. '" alt="first image" />';
	}
}





/*-----------------------------------------------------------------------------------*/
/*	SLIDER CAROUSEL CUSTOM POST TYPE SETTINGS
/*-----------------------------------------------------------------------------------*/
/*  http://generatewp.com/taxonomy/
/*  http://justintadlock.com/archives/2010/04/29/custom-post-types-in-wordpress
/*-----------------------------------------------------------------------------------*/
function create_bildspel_post_types() {
	register_post_type( 'wpboot_bildspel',
		array( 'labels' => array(
				'name' => __( 'Bildspel' ),
				'singular_name' => __( 'Bildspel &amp; text' ),
				'add_new' => __( 'Skapa nytt inl&auml;gg' ),
				'add_new_item' => __( 'H&auml;r l&auml;gger du till bild &amp; text i bildspelet p&aring; startsidan.' ),
				'edit' => __( '&Auml;ndra' ),
				'edit_item' => __( '&Auml;ndra i bildspel' ),
				'new_item' => __( 'Nytt bildspelinl&auml;gg' ),
				'view' => __( 'Se bildspel' ),
				'view_item' => __( 'Visa sidan' ),
				'search_items' => __( 'S&ouml;k i bildspel' ),
				'not_found' => __( 'Inget bildspelsinl&auml;gg hittat' ),
				'not_found_in_trash' => __( 'Inget bildspelsinl&auml;gg hittat i papperskorgen' ),
				'parent' => __( 'Huvudkategori till bildspel' ),
				'description' => __( 'Bildspelet &auml;ndras h&auml;r. <a href="#" class="button insert-media add_media" data-editor="content" 
                    title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a>' ),

                // FOR MEDIA IFRAME
                //'register_meta_box_cb' => 'my_meta_box_cb',
			),

		'public' => true,
		'show_ui' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'menu_position' => 5,
		'show_in_nav_menus' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/but-admin-bildspel.png',
		'query_var' => true,
		'supports' => array('title', 'thumbnail', 'excerpt' , 'wpboot_spiderfood','page-attributes'),
		'rewrite' => array( 'slug' => 'bildspel', 'with_front' => false ), 
		//'rewrite' => array( 'slug' => 'wpboot_bildspel' ),
		)
	);
}

add_action ( 'init', 'create_bildspel_post_types' );




/*-----------------------------------------------------------------------------------*/
/*  BILD-KATEGORIER CUSTOM POST TYPE TAXONOMY
/*-----------------------------------------------------------------------------------*/
function register_bildspel_custom_taxonomy()  {
    $labels = array(
        'name'                       => __( 'Bildkategorier', 'Bildkategorier', 'text_domain' ),
        'singular_name'              => __( 'Bildkategorier', 'Bildkategorier', 'text_domain' ),
        'menu_name'                  => __( 'Bildkategorier', 'text_domain' ),
        'all_items'                  => __( 'Alla Bildkategorier', 'text_domain' ),
        'parent_item'                => __( 'Parent Bildkategori', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Bildkategori:', 'text_domain' ),
        'new_item_name'              => __( 'Ny Bildkategori', 'text_domain' ),
        'add_new_item'               => __( 'Spara denna Bildkategori', 'text_domain' ),
        'edit_item'                  => __( '&Auml;ndra Bildkategori', 'text_domain' ),
        'update_item'                => __( 'Updatera Bildkategori', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separera med komma', 'text_domain' ),
        'search_items'               => __( 'S&ouml;k Bildkategori', 'text_domain' ),
        'add_or_remove_items'        => __( 'L&auml;gg till/radera Bildkategori', 'text_domain' ),
        'choose_from_most_used'      => __( 'V&auml;lj bland de mest anv&auml;nda Bildkategorierna', 'text_domain' ),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
 //       'taxonomies'                 => array('category'),
    );
    register_taxonomy( 'bildspel', 'wpboot_bildspel', $args );
}

add_action ( 'init', 'register_bildspel_custom_taxonomy' );




/*-----------------------------------------------------------------------------------*/
/*	TYGER CUSTOM POST TYPE SETTINGS
/*-----------------------------------------------------------------------------------*/
function create_tyger_post_types() {
    register_post_type('wpboot_tyger',
        array( 'labels' => array(
                'name'                  => __( 'Tyger' ),
                'singular_name'         => __( 'Tyger' ),
                'add_new'               => __( 'Skapa nytt inl&auml;gg' ),
                'add_new_item'          => __( 'H&auml;r l&auml;gger du till bild &amp; text i tyger.' ),
                'edit'                  => __( '&Auml;ndra' ),
                'edit_item'             => __( '&Auml;ndra i tyger' ),
                'new_item'              => __( 'Nytt tyger-inl&auml;gg' ),
                'view'                  => __( 'Se tyger' ),
                'view_item'             => __( 'Visa sidan' ),
                'search_items'          => __( 'S&ouml;k i tyger' ),
                'not_found'             => __( 'Inget tyger-inl&auml;gg hittat' ),
                'not_found_in_trash'    => __( 'Inget tyger-inl&auml;gg hittat i papperskorgen' ),
                'parent'                => __( 'Huvudkategori till tyger' ),
                'description'           => __( 'Kategorin tyger &auml;ndras h&auml;r. Det g&aring;r bara att ha ett tyger p&aring; sajten.' ),
            ),
                'capability_type'       => 'post',
                'public'                => true,
                'show_ui'               => true,
                'hierarchical'          => true, 
                'publicly_queryable'    => true,
                'exclude_from_search'   => false,
                'menu_position'         => 4,
                'menu_icon'             => get_stylesheet_directory_uri() . '/images/but-admin-tyger.png',
                'query_var'             => true,
               // 'taxonomies'          => array( 'category', 'post_tag' ), // ENDAST OM RUTAN CATEGORIES SKA SYNAS SOM PA POSTS
                'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
                'rewrite'               => array( 'slug' => 'tyg', 'with_front' => false ),
        )
    );
}

add_action( 'init', 'create_tyger_post_types' );



/*-----------------------------------------------------------------------------------*/
/*  TYGER CUSTOM POST TYPE TAXONOMY
/*-----------------------------------------------------------------------------------*/
function tygsorter_custom_taxonomy()  {
    $labels = array(
        'name'                       => _x( 'Tygsorter', 'Tygsort', 'text_domain' ),
        'singular_name'              => _x( 'Tygsort', 'Tygsort', 'text_domain' ),
        'menu_name'                  => __( 'Tygkategorier', 'text_domain' ),
        'all_items'                  => __( 'Alla tyger', 'text_domain' ),
        'parent_item'                => __( 'Parent tygsorter', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent tygsorter:', 'text_domain' ),
        'new_item_name'              => __( 'Nytt tyg', 'text_domain' ),
        'add_new_item'               => __( 'L&auml;gg till nytt tyg', 'text_domain' ),
        'edit_item'                  => __( '&Auml;ndra tyg', 'text_domain' ),
        'update_item'                => __( 'Updatera tyg', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separera tyg med komma', 'text_domain' ),
        'search_items'               => __( 'S&ouml;k tyg', 'text_domain' ),
        'add_or_remove_items'        => __( 'L&auml;gg till/radera tyg', 'text_domain' ),
        'choose_from_most_used'      => __( 'V&auml;lj bland de mest anv&auml;nda tygerna', 'text_domain' ),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'exclude_from_search'   => false,
    );
    register_taxonomy( 'tyger', 'wpboot_tyger', $args );

}

// Hook into the 'init' action
add_action( 'init', 'tygsorter_custom_taxonomy', 0 );

// NOT permanent, just for flushing:
//flush_rewrite_rules();

// functions run on activation of theme –> important flush to clear rewrites
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
$wp_rewrite->flush_rules();
}






/*-----------------------------------------------------------------------------------*/
// WP ADMIN LISTVIEW FILTER CATEGORIES
/*-----------------------------------------------------------------------------------*/
function taxonomy_filter_restrict_manage_posts() {
    global $typenow;

    // If you only want this to work for your specific post type,
    // check for that $type here and then return.
    // This function, if unmodified, will add the dropdown for each
    // post type / taxonomy combination.

    $post_types = get_post_types( array( '_builtin' => false ) );

    if ( in_array( $typenow, $post_types ) ) {
        $filters = get_object_taxonomies( $typenow );

        foreach ( $filters as $tax_slug ) {
            $tax_obj = get_taxonomy( $tax_slug );
            wp_dropdown_categories( array(
                'show_option_all'   => __('Visa alla '.$tax_obj->label ),
                'taxonomy'          => $tax_slug,
                'name'              => $tax_obj->name,
                'orderby'           => 'name',
                'selected'          => $_GET[$tax_slug],
                'hierarchical'      => $tax_obj->hierarchical,
                'show_count'        => false,
                'hide_empty'        => true
            ) );
        }
    }
}

add_action( 'restrict_manage_posts', 'taxonomy_filter_restrict_manage_posts' );

function taxonomy_filter_post_type_request( $query ) {
  global $pagenow, $typenow;

  if ( 'edit.php' == $pagenow ) {
    $filters = get_object_taxonomies( $typenow );
    foreach ( $filters as $tax_slug ) {
      $var = &$query->query_vars[$tax_slug];
      if ( isset( $var ) ) {
        $term = get_term_by( 'id', $var, $tax_slug );
        $var = $term->slug;
      }
    }
  }
}

add_filter( 'parse_query', 'taxonomy_filter_post_type_request' );




/*-----------------------------------------------------------------------------------*/
/*  WP HELP MENU IN ADMIN (top right) 
/*-----------------------------------------------------------------------------------*/
// function wpboot_contextual_help( $contextual_help, $screen_id, $screen ) { 
//     if ( 'wpboot_tyger' == $screen->id ) {
// 
//         $contextual_help = '<h2>Tyger</h2>
//         <p>Products show the details of the items that we sell on the website. You can see a list of them on this page in reverse chronological order - the latest one we added is first.</p> 
//         <p>You can view/edit the details of each product by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.</p>';
// 
//     } elseif ( 'edit-product' == $screen->id ) {
// 
//         $contextual_help = '<h2>Uppdatera tyger</h2>
//         <p>This page allows you to view/modify product details. Please make sure to fill out the available boxes with the appropriate details (product image, price, brand) and <strong>not</strong> add these details to the product description.</p>';
// 
//     }
//     return $contextual_help;
// }
// add_action( 'contextual_help', 'wpboot_contextual_help', 10, 3 );





/*-----------------------------------------------------------------------------------*/
/*  DEACTIVATE WYSIWYG EDITOR (OR ANYTHING) IN ADMIN 
/*-----------------------------------------------------------------------------------*/
function remove_post_type_support_for_pages() {
    // UNCOMMENT if you want to remove some stuff
    // Replace 'page' with 'post' or a custom post/content type
    // remove_post_type_support( 'page', 'title' );
    // remove_post_type_support( 'wpboot_tyger', 'editor' );
    // remove_post_type_support( 'page', 'thumbnail' );
    // remove_post_type_support( 'page', 'page-attributes' );
    // remove_post_type_support( 'page', 'excerpt' );
}
add_action( 'admin_init', 'remove_post_type_support_for_pages' );



/*-----------------------------------------------------------------------------------*/
/*  INSERT NORMAL TEXTFIELD, NO WYSIWYG
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
    'id' => 'wpboot_texteditor',
    'title' => 'Infobox intro',
    'pages' => array('wpboot_tyger'),

    'fields' => array(
    array(
        'name' => 'Skriv h&auml;r',
        'id' => 'txt_fritext',
        'type' => 'textarea',
        'std' => '',
        'desc' => 'Detta f&auml;lt &auml;r sidans potentiella textf&auml;lt. Du m&aring;ste inte skriva n&aring;got h&auml;r.'
    )
)
);


/*-----------------------------------------------------------------------------------*/
/*	IMAGE UPLOAD FOR CAROUSEL AND TYGER IF YOU WANT IT SEPARATE (not featured img)
/*-----------------------------------------------------------------------------------*/
/*
$meta_boxes[] = array(

	'id'		=> 'wpboot_imgupload',
	'title'		=> 'Bilder',
	'pages'		=> array( 'wpboot_tyger', 'wpboot_bildspel', 'pages', 'post'),
	'fields'	=> array(

	array(
	'name'		=> 'Bild',
	'id'		=> 	'wpboot_img',
	'type'		=> 'image',
	'desc'		=> '',
	),
		
	array(
	'name'		=> 'Bildtext',
	'id'		=> 	'wpboot_text',
	'default'	=> '',
	'desc'		=> 'Anv&auml;nd detta f&auml;lt f&ouml;r texter till bilder.',
	'type'		=> 'textarea',
	),
));		

*/

/*-----------------------------------------------------------------------------------*/
/*	SPIDERFOOD FOR POSTS, PAGES AND WPBOOT_BILDSPEL
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id'		=>	'wpboot_spiderfood',
	'title'		=> 	'S&ouml;kmotormat',
	'pages'		=> 	array('post', 'page', 'wpboot_tyger' , 'wpboot_bildspel'),
	'fields'	=> 	array(
	
		array(
		'name'		=>	'SEO till svenska eller engelska sidor.',
		'id'		=> 	'wpboot_spiderfood',
		'default'	=>	'Din spindelmat h&auml;r.',
		'desc'		=>	'Skriv meningar laddade med s&ouml;kuttryck. Ex: "Specialtyger fr&aring;n Astrid. Tyger f&ouml;r offentliga milj&ouml;er."',
		'type'		=>	'text',
		),
));




/*-----------------------------------------------------------------------------------*/
/*  BACKGROUND COLOR HEX PICKER 
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
  'id'        =>  'wpboot_bgcolor_set',
  'title'     =>  'Layout',
  'pages'     =>  array('post', 'page', 'wpboot_tyger', 'wpboot_bildspel'),
  'fields'    =>  array(

    array(
    'name'    =>  'Bakgrundsfärg för text och bilder.',
    'id'      =>  'wpboot_bgcolor',
    'default' =>  '#bada55',
    'desc'    =>  'Hexf&auml;rg (Gröna: #dbe9d4, #cce3c5, #82bb97, #295f3a)  (Gula: #f7f0c5, #d9b737) (Peach: #f3b8a0, #db856a) (Grå: #ded7cf, #b9b9b9, #acaba4).',
    'class'   =>  'my-color-field',
    'type'    =>  'text'
    ),

        
    array(
        'name' => 'Bildernas storlek i listningsvy',
        'id' => 'wpboot_img_size',
        'type' => 'radio',
        'options' => array( 
            'xs' => ' Pytteynke',
            's' => ' Liten',
            'm' => ' Mellan',
            'l' => ' Stor',
            'xl' => ' Gigantisch',
        ),
        'std' => 's',
    ),
    
    array(
        'name'      => 'Stor rubrik',
        'id'        => 'wpboot_bigblock',
        'type'      => 'checkbox_list',
        'options'   => array( 'big-block' => ' Stor rubrik tack!'),
    ) 

));



// CALL WITH $checkbox_list = get_post_meta(get_the_ID(), 'wpboot_bigblock', false);
//
// echo '<input type="text" value="#bada55" class="my-color-field" data-default-color="#effeff" />';

$meta_boxes[] = array(
    'id' => 'wpboot_additional',
    'title' => 'Mer information',
    'pages' => array('wpboot_tyger'),

    'fields' => array(

        
    
        array(
            'name' => 'Artikel',
            'id' => 'wpboot_artikel',
            'type' => 'text',
            'std' => '',
            'desc' => 'Info. Detta f&auml;lt &auml;r sidans/tygets rubrik.'
        ),
        
        array(
            'name' => 'Användningsområde',
            'id' => 'wpboot_anvandning',
            'type' => 'text',               // WYSIWYG eller text editor
            'std' => '',
            'desc' => 'Usage'
        ),

        array(
            'name' => 'Martindale',
            'id' => 'wpboot_martindale',
            'type' => 'text',
            'std' => '',
            'desc' => 'Ex: Martin? Dale?'
        ),

        array(
            'name' => 'Komposition',
            'id' =>  'wpboot_komposition',
            'type' => 'text',
            'std' => '',
            'desc' => 'Ex: 100% Lin'
        ),
        
        array(
            'name' => 'Antal färger',
            'id' => 'wpboot_farger',
            'type' => 'text',
            'std' => '',
            'desc' => 'Antal p&aring; lager. Tillg&auml;ngliga för beställning inom parantes'
            ),

        array(
            'name' => 'Bredd',
            'id' => 'wpboot_bredd',
            'type' => 'text',
            'std' => '',
            'desc' => 'Ex: 300 cm'
        ),

        array(
            'name' => 'Vikt',
            'id' => 'wpboot_vikt',
            'type' => 'text',
            'std' => '',
            'desc' => 'Ex: 190 gr/m2'
        ),

        array(
            'name' => 'Rapport',
            'id' => 'wpboot_rapport',
            'type' => 'text',
            'std' => '',
            'desc' => 'Ex: Enfärgat'
        ),

        array(
            'name' => 'Krympning efter tvätt',
            'id' => 'wpboot_krympning',
            'type' => 'text',
            'std' => '',
            'desc' => 'Ex: +/- 2%'
        ),

        array(
            'name' => 'Infärgning',
            'id' => 'wpboot_infargning',
            'type' => 'text',
            'std' => '',
            'desc' => 'Ex: Styckinfärgad'
        ),

        array(
            'name' => 'Flamsäkert',
            'id' => 'wpboot_flamsakert',
            'type' => 'text',
            'std' => '',
            'desc' => 'Ex:'
        ),

        array(
            'name' => 'Ljusäkthet',
            'id' => 'wpboot_ljusakthet',
            'type' => 'text',
            'std' => '',
            'desc' => 'Ex: 5-6'
        ),

        array(
            'name' => 'Färghärdighet efter tvätt ',
            'id' => 'wpboot_farghardighet',
            'type' => 'text',
            'std' => '',
            'desc' => 'Ex:'
        ),
    )
);


$meta_boxes[] = array(
    'id' => 'ikoner',
    'title' => 'Care labels',
    'pages' => array('wpboot_tyger'),

    'fields' => array(
        array(
            'name' => 'Ikoner',
            'id' => 'wpboot_ikon',
            'type' => 'checkbox_list',
            'options' => array(             // key => value (key cannot contain space)
                'ikon-1' => '1',            // kalla upp med: $checkbox_list = get_post_meta(get_the_ID(), 'meta_name', false);
                'ikon-2' => '2',            // and use: if (in_array($checkbox_list['checkbox-1']) {// do stuff}
                'ikon-3' => '3',
                'ikon-4' => '4',
                'ikon-5' => '5',
                'ikon-6' => '6',
                'ikon-7' => '7',
                'ikon-8' => '8',
                'ikon-9' => '9',
                'ikon-10' => '10',
                'ikon-11' => '11',
                'ikon-12' => '12',
                'ikon-13' => '13',
                'ikon-14' => '14',
                'ikon-15' => '15',
                'ikon-16' => '16',
                'ikon-17' => '17',
                'ikon-18' => '18',
                'ikon-19' => '19',
                'ikon-20' => '20',
                'ikon-21' => '21',
                'ikon-22' => '22',
                'ikon-23' => '23',
                'ikon-24' => '24',
                'ikon-25' => '25',
                'ikon-26' => '26',
                'ikon-27' => '27',
                'ikon-28' => '28',
                'ikon-29' => '29',
                'ikon-30' => '30',
                'ikon-31' => '31',
                'ikon-32' => '32',
                'ikon-33' => '33',
                'ikon-34' => '34',
                'ikon-35' => '35',
                'ikon-36' => '36',
                'ikon-37' => '37',
                'ikon-38' => '38',
                'ikon-39' => '39',
                'ikon-40' => '40',
                'ikon-41' => '41',
                'ikon-42' => '42',
                'ikon-43' => '43'
            )
        )
    )
);



foreach ($meta_boxes as $meta_box) {
	$my_box = new wpboot_meta_box_taxonomy($meta_box);
}





/*-----------------------------------------------------------------------------------*/
/*  BOOTSTRAP PAGINATION
/*-----------------------------------------------------------------------------------*/

function bootstrap_pagination($pages = '', $range = 2) {
    $showitems = ($range * 2)+1;

    global $paged;
    if(empty($paged)) $paged = 1;

    if( $pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if( !$pages ) {
            $pages = 1;
        }
    }

    if(1 != $pages) {
    echo '<div class="pagination pagination-centered"><ul class="pagination">';
    if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<li><a href="' . get_pagenum_link(1). '">&laquo;</a></li>';
    if($paged > 1 && $showitems < $pages) echo '<li><a href="'.get_pagenum_link($paged - 1) . '">&lsaquo;</a></li>';

    for ( $i=1; $i <= $pages; $i++ ) {
        if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
            echo ($paged == $i)? '<li class="active"><span class="current">' . $i . '</span></li>' : '<li><a href="' . get_pagenum_link($i). 
            '" class="inactive" >' . $i . '</a></li>';
        }
    }

        if ($paged < $pages && $showitems < $pages) echo '<li><a href="' . get_pagenum_link($paged + 1) . '">&rsaquo;</a></li>';
        if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo '<li><a href="' . get_pagenum_link($pages) . '">&raquo;</a></li>';
        echo '</ul></div>';
    }
}






/*------------------------------------------------------------*/
/*  THATS ALL FOLKS! QUESTIONS? ASK Tdude: tibbemail@gmail.com
/*------------------------------------------------------------*/
?>