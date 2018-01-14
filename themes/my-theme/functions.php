<?php

if ( !defined( 'VIBE_URL' ) )
define('VIBE_URL',get_template_directory_uri());

/**
 * enable sessions required for the immunsystem minikurs
 */
if (!session_id())
    session_start();

/* disables the profile cover image and the second line disables the group cover image */
add_filter( 'bp_is_profile_cover_image_active', '__return_false' );
add_filter( 'bp_is_groups_cover_image_active', '__return_false' );

add_filter( 'lostpassword_redirect', 'my_redirect_home' );
function my_redirect_home( $lostpassword_redirect ) {
	return '/neues-passwort-einrichten/';
}


/* Add speedy space custom functions */
require_once( __DIR__ . '/includes/speedy_functions.php');

/* Add all speedy space event functions */
require_once( __DIR__ . '/includes/speedy_events.php');

/* Add faq-generator functions */
require_once( __DIR__ . '/includes/speedy_faq-generator.php');

/* Add all speedy space country blocking functions */
require_once( __DIR__ . '/includes/speedy_country_block.php');

/* Add all speedy space time-based job scheduler */
require_once( __DIR__ . '/includes/speedy_cron_jobs.php');

/* Add mailchimp functions */
require_once( __DIR__ . '/includes/speedy_mailchimp_controller.php');



/*
 * Load Fonts
 */


function wpb_add_google_fonts() {

wp_enqueue_style( 'wpb-google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700,600', false );
}

add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );



/*
 * Custom post Type Minikurs
 */

function lektion_post_type() {

	$labels = array(
		'name'                => 'Lektion',
		'singular_name'       => 'Lektion',
		'menu_name'           => 'Lektion',
		'parent_item_colon'   => 'Lektion parent',
		'all_items'           => 'Alle Lektionen',
		'view_item'           => 'View Lektion',
		'add_new_item'        => 'Add New Lektion',
		'add_new'             => 'New Lektion',
		'edit_item'           => 'Edit Lektion',
		'update_item'         => 'Update Lektion',
		'search_items'        => 'Search Lektion',
		'not_found'           => 'No Lektionen found',
		'not_found_in_trash'  => 'No Lektionen found in Trash',
	);

	$args = array(
		'label'               => 'lektion',
		'description'         => 'Single Lektion',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'taxonomies' => array('category'),
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'menu_icon'           => 'dashicons-media-document',
		'rewrite' => array('slug' => 'lektion','with_front' => false),
		'capability_type'     => 'page',

	);
	register_post_type( 'lektion', $args );

}

// Hook into the 'init' action
add_action( 'init', 'lektion_post_type', 0 );


/*
 * Custom post Type Slide Lektion
 */

function slidelektion_post_type() {

	$labels = array(
		'name'                => 'SlideLektion',
		'singular_name'       => 'SlideLektion',
		'menu_name'           => 'SlideLektion',
		'parent_item_colon'   => 'SlideLektion parent',
		'all_items'           => 'Alle SlideLektionen',
		'view_item'           => 'View SlideLektion',
		'add_new_item'        => 'Add New SlideLektion',
		'add_new'             => 'New SlideLektion',
		'edit_item'           => 'Edit SlideLektion',
		'update_item'         => 'Update SlideLektion',
		'search_items'        => 'Search SlideLektion',
		'not_found'           => 'No SlideLektionen found',
		'not_found_in_trash'  => 'No SlideLektionen found in Trash',
	);

	$args = array(
		'label'               => 'slidelektion',
		'description'         => 'Single SlideLektion',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'taxonomies' => array('category'),
		'show_in_admin_bar'   => true,
		'menu_position'       => 21,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'menu_icon'           => 'dashicons-media-document',
		'rewrite' => array('slug' => 'slidelektion','with_front' => false),
		'capability_type'     => 'page',

	);
	register_post_type( 'slidelektion', $args );

}

// Hook into the 'init' action
add_action( 'init', 'slidelektion_post_type', 0 );



/*
 * Custom post Type Minikursreihe
 */

function minikurs_post_type() {

	$labels = array(
		'name'                => 'Minikurs',
		'singular_name'       => 'Minikurs',
		'menu_name'           => 'Minikurs',
		'parent_item_colon'   => 'Minikurs parent',
		'all_items'           => 'Alle Minikurse',
		'view_item'           => 'View Minikurs',
		'add_new_item'        => 'Add New Minikurs',
		'add_new'             => 'New Minikurs',
		'edit_item'           => 'Edit Minikurs',
		'update_item'         => 'Update Minikurs',
		'search_items'        => 'Search Minikurs',
		'not_found'           => 'No Minikurse found',
		'not_found_in_trash'  => 'No Minikurse found in Trash',
	);

	$args = array(
		'label'               => 'minikurs',
		'description'         => 'Single Minikurs',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 21,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'menu_icon'           => 'dashicons-media-document',
		'rewrite' => array('slug' => 'kurs','with_front' => false),
		'capability_type'     => 'page',

	);
	register_post_type( 'minikurs', $args );

}

// Hook into the 'init' action
add_action( 'init', 'minikurs_post_type', 0 );

add_action( 'init', 'create_kurs_kategorie' );

function create_kurs_kategorie() {
	register_taxonomy( 'kurs-kategorie', array( 'minikurs'),
		array(
			'labels' => array(
				'name' => 'Kurs Kategorie',
				'menu_name' => 'Kurs Kategorie',
				'singular_name' => 'Kurs Kategorie',
				'add_new_item' => 'Neue Kurs Kategorie hinzufügen',
				'all_items' => 'Alle Kurs Kategorien',
			),
			'public' => true,
			'hierarchical' => true,
			'show_ui' => true,
			'show_admin_column' => true,
	        'query_var' => 'kurs-kategorie',
			'show_in_nav_menus' => true,
		)
	);
}


//Connect Lektionen mit Minikurs
function my_connection_types() {
    p2p_register_connection_type( array(
        'name' => 'minikurs_to_lektion',
        'from' => 'minikurs',
        'to' => 'lektion',
		'sortable' => 'any',
		'cardinality' => 'one-to-many',
		'title' => array( 'from' => 'Manages', 'to' => 'Managed' ),
		'admin_box' => 'from'
    ) );
	  p2p_register_connection_type( array(
        'name' => 'minikurs_to_slidelektion',
        'from' => 'minikurs',
        'to' => 'slidelektion',
		'sortable' => 'any',
		'cardinality' => 'one-to-many',
		'title' => array( 'from' => 'Manages', 'to' => 'Managed' ),
		'admin_box' => 'from'
    ) );
}
add_action( 'p2p_init', 'my_connection_types' );




/*
 * Custom post Type Tools
 */

function tools_post_type() {

	$labels = array(
		'name'                => 'Tools',
		'singular_name'       => 'Tool',
		'menu_name'           => 'Tools',
		'parent_item_colon'   => 'Tools parent',
		'all_items'           => 'Alle Tools',
		'view_item'           => 'View Tools',
		'add_new_item'        => 'Add New Tools',
		'add_new'             => 'New Tools',
		'edit_item'           => 'Edit Tools',
		'update_item'         => 'Update Tools',
		'search_items'        => 'Search Tools',
		'not_found'           => 'No Tools found',
		'not_found_in_trash'  => 'No Tools found in Trash',
	);

	$args = array(
		'label'               => 'tools',
		'description'         => 'Single Tool',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'taxonomies' => array('category'),
		'show_in_admin_bar'   => true,
		'menu_position'       => 21,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'menu_icon'           => 'dashicons-media-document',
		'rewrite' => array('slug' => 'tools','with_front' => false),
		'capability_type'     => 'page',

	);
	register_post_type( 'tools', $args );

}

// Hook into the 'init' action
add_action( 'init', 'tools_post_type', 0 );



//[minikurslist]
class minikurslist {
	public static function minikurslist_func( $atts ) {

		$atts = shortcode_atts( array(
			'count' => '',
			'columns' => '',
			'exclude' => '',
		), $atts, 'minikurslist' );

		$output = '';

		$excludedarray = explode(',', $atts['exclude']);

		if ( $atts['count'] ) {

			$args = array(
			'orderby'        => 'date',
			'post__not_in' => $excludedarray,
			'posts_per_page' =>  $atts['count'],
			'post_type' => 'minikurs');

			$the_query = new WP_Query( $args );

			// The Loop
				if ( $the_query->have_posts() ) {
					echo '<div class="vc_grid-container-wrapper vc_clearfix">';
					echo '<div class="vc_grid-container vc_clearfix wpb_content_element vc_basic_grid">';
					echo '<div class="vc_grid vc_row vc_grid-gutter-30px vc_pageable-wrapper vc_hook_hover" data-vc-pageable-content="true">';
					echo '<div class="vc_pageable-slide-wrapper vc_clearfix slides" data-vc-grid-content="true">';

					while ( $the_query->have_posts() ) {

						echo '<div class="vc_grid-item vc_clearfix vc_col-sm-'.$atts['columns'].' vc_grid-item-zone-c-bottom vc_visible-item fadeIn animated block courseitem">';

						$the_query->the_post();

						$current_post = get_the_ID();
						$current_link = get_permalink();
						?>

						<div class="block_media"><a href="<?php echo $current_link ?>" title="<?php get_the_title($current_post); ?>">
						<?php the_post_thumbnail( 'medium' );  ?>
						</a></div>
							<div class="block_content">
						<?php
							echo '<div class="description">';
							echo '<h4 class="block_title" style="border-bottom: none"><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></h4>';
							$customlandingexcerpt = get_the_excerpt();
							echo '<p style="margin-bottom: 0px; padding-bottom: 15px; border-bottom: 1px solid #ebebeb;">'.wp_trim_words( $customlandingexcerpt , '13' ) .'</p>';
							$postid = get_the_ID();
						echo '</div>';

						echo '<div class="star-rating" style="padding-top: 12px;">';

						$avgrating =  get_post_meta($postid, '_kksr_avg', 1 );
										if (!empty($avgrating)) {
								echo " <div class='postprev__full-rating'>";
									$perc = $avgrating*20;
									echo "<div class='postprev__full-rating--inner' style='width:".$perc."%'></div>";
								echo"</div>";
							} else {
								echo "<img class='emptyrating' src='https://selpers.com/files/uploads/2016/10/crowns-empty.png' style='margin-top: 5px; float: left' >";
							}
							echo '</div>';
							echo '<div class="custom_credits"><strong>KOSTENLOS</strong>';


						echo '</div>';
						echo '</div>';
						echo '</div>';
					}
					echo '</div></div></div></div>';
				} else {
					// no posts found
					echo 'nothing';
				}

			/* Restore original Post Data */
			wp_reset_postdata();


			return $output;
		} else {
		$output .= '<weee';
		return $output;
		}
	}
 }
 add_shortcode( 'minikurslist', array( 'minikurslist', 'minikurslist_func' ) );


 //[singleminikurs]
class singleminikurs {
	public static function singleminikurs_func( $atts ) {

		$atts = shortcode_atts( array(
			'pid' => '',
		), $atts, 'minikurslist' );

		$output = '';


			$args = array(
			'p' => $atts['pid'],
			'post_type' => 'minikurs');

			$the_query = new WP_Query( $args );

			// The Loop
				if ( $the_query->have_posts() ) {
					echo '<div class="vc_grid-container-wrapper vc_clearfix">';
					echo '<div class="vc_grid-container vc_clearfix wpb_content_element vc_basic_grid">';
					echo '<div class="vc_grid vc_row vc_grid-gutter-30px vc_pageable-wrapper vc_hook_hover" data-vc-pageable-content="true">';
					echo '<div class="vc_pageable-slide-wrapper vc_clearfix slides" data-vc-grid-content="true">';

					while ( $the_query->have_posts() ) {


						echo '<div class="vc_grid-item vc_clearfix vc_col-sm-'.$atts['columns'].' vc_grid-item-zone-c-bottom vc_visible-item fadeIn animated block courseitem">';

						$the_query->the_post();

						$current_post = get_the_ID();
						$current_link = get_permalink();
						?>

						<div class="block_media"><a href="<?php echo $current_link ?>" title="<?php get_the_title($current_post); ?>">
						<?php the_post_thumbnail( 'medium' );  ?>
						</a></div>
							<div class="block_content">
						<?php
							echo '<div class="description">';
							echo '<h4 class="block_title" style="border-bottom: none"><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></h4>';
							echo '<p style="margin-bottom: 0px; padding-bottom: 15px; border-bottom: 1px solid #ebebeb;">'.get_the_excerpt().'</p>';
							$postid = get_the_ID();
						echo '</div>';

						echo '<div class="star-rating" style="padding-top: 12px;">';

						$avgrating =  get_post_meta($postid, '_kksr_avg', 1 );
										if (!empty($avgrating)) {
								echo " <div class='postprev__full-rating'>";
									$perc = $avgrating*20;
									echo "<div class='postprev__full-rating--inner' style='width:".$perc."%'></div>";
								echo"</div>";
							} else {
								echo "<img class='emptyrating' src='https://selpers.com/files/uploads/2016/10/crowns-empty.png' style='margin-top: 5px; float: left' >";
							}
							echo '</div>';
							echo '<div class="custom_credits"><strong>KOSTENLOS</strong>';


						echo '</div>';
						echo '</div>';
						echo '</div>';
					}
					echo '</div></div></div></div>';
				} else {
					// no posts found
					echo 'nothing';
				}

			/* Restore original Post Data */
			wp_reset_postdata();


			return $output;

	}
 }
 add_shortcode( 'singleminikurs', array( 'singleminikurs', 'singleminikurs_func' ) );


 //[kurslist]
class kurslist {
	public static function kurslist_func( $atts ) {

		$atts = shortcode_atts( array(
			'count' => '',
			'columns' => '',
			'category' => ''
		), $atts, 'kurslist' );

		$output = '';

		if ( $atts['count'] ) {

			$args = array(
			'orderby'        => 'date',
			'posts_per_page' =>  $atts['count'],
			'course-cat' => $atts['category'],
			'post_type' => 'course');

			$the_query = new WP_Query( $args );
			// The Loop
				if ( $the_query->have_posts() ) {
					echo '<div class="vc_grid-container-wrapper vc_clearfix">';
					echo '<div class="vc_grid-container vc_clearfix wpb_content_element vc_basic_grid">';
					echo '<div class="vc_grid vc_row vc_grid-gutter-30px vc_pageable-wrapper vc_hook_hover" data-vc-pageable-content="true">';
					echo '<div class="vc_pageable-slide-wrapper vc_clearfix slides" data-vc-grid-content="true">';

					while ( $the_query->have_posts() ) {

						echo '<div class="vc_grid-item vc_clearfix vc_col-sm-'.$atts['columns'].' vc_grid-item-zone-c-bottom vc_visible-item fadeIn animated block courseitem">';

						$the_query->the_post();

						$current_post = get_the_ID();
						$current_link = get_permalink();
						?>

						<div class="block_media"><a href="<?php echo $current_link ?>" title="<?php get_the_title($current_post); ?>">
						<?php the_post_thumbnail( 'full' );  ?>
						</a></div>
							<div class="block_content">
						<?php
							echo '<div class="description" style="overflow: hidden">';
							echo '<h4 class="block_title" style="border-bottom: none"><a href="'. get_permalink() .'">'.get_the_title().'</a></h4>';
							echo '<p style="margin-bottom: 0px; padding-bottom: 15px; border-bottom: 1px solid #ebebeb;">'.get_the_excerpt().'</p>';

						echo '</div>';



				 $return = '';
				if(get_post_type($current_post) == 'course'){

                        $rating=get_post_meta($current_post,'average_rating',true);
				        $rating_count=get_post_meta($current_post,'rating_count',true);
                        $meta = '<div class="star-rating">';
                        for($i=1;$i<=5;$i++){

                            if(isset($rating)){
                                if($rating >= 1){
                                    $meta .='<span class="fill"></span>';
                                }elseif(($rating < 1 ) && ($rating > 0.4 ) ){
                                    $meta .= '<span class="half"></span>';
                                }else{
                                    $meta .='<span></span>';
                                }
                                $rating--;
                            }else{
                                $meta .='<span></span>';
                            }
                        }
                        $meta =  apply_filters('vibe_thumb_rating',$meta,$featured_style,$rating);
                        $meta .= '</div>';

                        $free_course = get_post_meta($current_post,'vibe_course_free',true);
						$meta .='<div class="custom_credits">'; //speedyspace
                        $meta .=bp_course_get_course_credits(array('id'=>$current_post));
                        $meta .='</div>';





                        $return .= $meta;
				}

							echo $return;



						echo '</div>';
						echo '</div>';
					}
					echo '</div></div></div></div>';
				} else {
					// no posts found
					echo 'nothing';
				}

			/* Restore original Post Data */
			wp_reset_postdata();


			return $output;
		} else {
		$output .= '<weee';
		return $output;
		}
	}
 }
 add_shortcode( 'kurslist', array( 'kurslist', 'kurslist_func' ) );


 //[toolslist]
class toolslist {
	public static function toolslist_func( $atts ) {

		$atts = shortcode_atts( array(
			'count' => '',
			'columns' => '',
		), $atts, 'toolslist' );

		$output = '';

		if ( $atts['count'] ) {

			$args = array(
			'orderby'        => 'date',
			'posts_per_page' =>  $atts['count'],
			'post_type' => 'tools');

			$the_query = new WP_Query( $args );

			// The Loop
				if ( $the_query->have_posts() ) {
					echo '<div class="vc_grid-container-wrapper vc_clearfix">';
					echo '<div class="vc_grid-container vc_clearfix wpb_content_element vc_basic_grid">';
					echo '<div class="vc_grid vc_row vc_grid-gutter-30px vc_pageable-wrapper vc_hook_hover" data-vc-pageable-content="true">';
					echo '<div class="vc_pageable-slide-wrapper vc_clearfix slides" data-vc-grid-content="true">';

					while ( $the_query->have_posts() ) {

						echo '<div class="vc_grid-item vc_clearfix vc_col-sm-'.$atts['columns'].' vc_grid-item-zone-c-bottom vc_visible-item fadeIn animated block courseitem">';

						$the_query->the_post();

						$current_post = get_the_ID();
						$current_link = get_permalink();
						?>

						<div class="block_media"><a href="<?php echo $current_link ?>" title="<?php get_the_title($current_post); ?>">
						<?php the_post_thumbnail( 'medium' );  ?>
						</a></div>
							<div class="block_content">
						<?php
							echo '<div class="description">';
							echo '<h4 class="block_title" style="border-bottom: none"><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></h4>';
							echo '<p style="margin-bottom: 0px; padding-bottom: 15px; border-bottom: 1px solid #ebebeb;">'.get_the_excerpt().'</p>';
							$postid = get_the_ID();
						echo '</div>';

						echo '<div class="tool-category" style="padding-top: 12px;">';
						$categories = get_the_category();

						if ( ! empty( $categories ) ) {
							echo esc_html( $categories[0]->name );
						}

							echo '</div>';
							echo '<div class="custom_credits"><strong>KOSTENLOS</strong>';


						echo '</div>';
						echo '</div>';
						echo '</div>';
					}
					echo '</div></div></div></div>';
				} else {
					// no posts found
					echo 'nothing';
				}

			/* Restore original Post Data */
			wp_reset_postdata();


			return $output;
		} else {
		$output .= '<weee';
		return $output;
		}
	}
 }
 add_shortcode( 'toolslist', array( 'toolslist', 'toolslist_func' ) );





add_shortcode('selper_carousel', 'selpers_custom_post_carousel');
function selpers_custom_post_carousel($atts, $content = null) {



        $error = new VibeErrors();
        if(!isset($atts) || !isset($atts['post_type'])){
          return $error->get_error('unsaved_editor');
        }


	   $attributes = v_get_attributes( $atts, "selpers_custom_post_carousel" );

        if(!isset($atts['auto_slide']))
            $atts['auto_slide']='';

        if($atts['custom_css'] && strlen($atts['custom_css'])>5)
            $output = '<style>'.$atts['custom_css'].'</style>';
        else
            $output= '';

	$output .= "<div {$attributes['class']}{$attributes['inline_styles']}>";

	if(!isset($atts['post_ids']) || strlen($atts['post_ids']) < 2){

        if(isset($atts['term']) && isset($atts['taxonomy']) && $atts['term'] !='nothing_selected'){

            if(isset($atts['taxonomy']) && $atts['taxonomy']!=''){

                        $check=term_exists($atts['term'], $atts['taxonomy']);
                    if($atts['term'] !='nothing_selected'){
                   if ($check == 0 || $check == null || !$check) {
                           $error = new VibeErrors();
                          $output .= $error->get_error('term_taxonomy_mismatch');
                          $output .='</div>';
                          return $output;
                       }
                    }
                       $check=is_object_in_taxonomy($atts['post_type'], $atts['taxonomy']);
                   if ($check == 0 || $check == null || !$check) {
                           $error = new VibeErrors();
                           $output .= $error->get_error('term_postype_mismatch');
                           $output .='</div>';
                           return $output;
                       }
                    }

            if(isset($atts['taxonomy']) && $atts['taxonomy']!=''){
                         if($atts['taxonomy'] == 'category'){
                             $atts['taxonomy']='category_name';
                             }
                          if($atts['taxonomy'] == 'tag'){
                             $atts['taxonomy']='tag_name';
                             }
                     }

          $query_args=array( 'post_type' => $atts['post_type'],$atts['taxonomy'] => $atts['term'], 'posts_per_page' => $atts['carousel_number']);

        }else if(isset($atts['taxonomy_course'])) {


          $query_args=array( 'post_type' => $atts['post_type'],'course-cat' => $atts['taxonomy_course'], 'posts_per_page' => $atts['carousel_number']);

        } else
           $query_args=array('post_type'=>$atts['post_type'], 'posts_per_page' => $atts['carousel_number']);

        if($atts['post_type'] == 'course' && isset($atts['course_style'])){
            switch($atts['course_style']){
                case 'popular':
                  $query_args['orderby'] = 'meta_value_num';
                  $query_args['meta_key'] = 'vibe_students';
                break;
                case 'rated':
                  $query_args['orderby'] = 'meta_value_num';
                  $query_args['meta_key'] = 'average_rating';
                break;
                case 'reviews':
                  $query_args['orderby'] = 'comment_count';
                break;
                case 'start_date':
                  $args['orderby'] = 'meta_value';
                  $args['meta_key'] = 'vibe_start_date';
                  $args['meta_type'] = 'DATE';
                  $args['order'] = 'ASC';
                break;
                case 'random':
                   $query_args['orderby'] = 'rand';
                break;
                case 'free':
                  $query_args['meta_query'] =  array(
                      array(
                        'key'     => 'vibe_course_free',
                        'value'   => 'S',
                        'compare' => '=',
                      ),
                    );
                break;
                default:
                  $query_args['orderby'] = '';
            }
            $query_args['order'] = 'DESC';

            $query_args =  apply_filters('wplms_carousel_course_filters',$query_args);
        }

        $the_query = new WP_Query($query_args);

        }else{

          $cus_posts_ids=explode(",",$atts['post_ids']);
        	$query_args=array( 'post_type' => $atts['post_type'], 'post__in' => $cus_posts_ids , 'orderby' => 'post__in','posts_per_page'=>count($cus_posts_ids));
        	$the_query = new WP_Query($query_args);
        }


        if(isset($atts['title']) && $atts['title'] && $atts['title'] != 'Content'){
            $ntitle= $atts['title'];
            $ntitle = preg_replace('/[^a-zA-Z0-9\']/', '_', $ntitle);
            $ntitle = str_replace("'", '', $ntitle);
            $output .='<div id="'.$ntitle.'"></div>';
        }

        $more= '';
        if(isset($atts['show_more']) && $atts['show_more']) {
            $more = ' <a href="'.$atts['more_link'].'" class="heading_more">Alle anzeigen</a>';
        }
        $noheading='';

        if($atts['show_title'])
            $output .='<div class="carousel-header"><h3 class="heading"><span>'.$atts['title'].'</span></h3>'.$more.'</div>';
        else
            $noheading='noheading';


        $class='slides';




        $output .=
        '<div id="'.$rand.'" class="vibe_carousel flexslider loading '.(($atts['carousel_max']==1)?'onecol':'').' '.$noheading.'
        '.((isset($atts['show_more']) && $atts['show_more'])?'more_heading':'').'" data-directionnav="'.$atts['show_controls'].'" data-controlnav="'.$atts['show_controlnav'].'"
        data-block-width="'.$atts['column_width'].'" data-block-max="'.$atts['carousel_max'].'" data-block-min="'.$atts['carousel_min'].'" data-autoslide="'.$atts['auto_slide'].'">
  	            <ul class="'.$class.'">';
  	     $links='';
         $excerpt='';
         $thumb='';


         if($atts['column_width'] < 311)
             $cols = 'small';

         if(($atts['column_width'] >= 311) && ($atts['column_width'] < 460))
             $cols='medium';

         if(($atts['column_width'] >= 460) && ($atts['column_width'] < 769))
             $cols='big';

         if($atts['column_width'] >= 769)
             $cols='full';

        if( $the_query->have_posts() ) {

        while ( $the_query->have_posts() ) : $the_query->the_post();
        global $post;

        $output .= '<li>';

        $output .= selpers_thumbnail_generator($post,$atts['featured_style'],$cols,$atts['carousel_excerpt_length']);
		$output .= '</li>';
        endwhile;
        }else{
          $error = new VibeErrors();
          $output .= $error->get_error('no_posts');
        }
        wp_reset_postdata();
        $output .= "</ul></div></div>";

	return $output;
}



function selpers_thumbnail_generator($custom_post,$featured_style,$cols='medium',$n=100,$link=0,$zoom=0){
    $return=$read_more=$class='';

    $more = __('Read more','vibe-customtypes');



    if(strlen($custom_post->post_content) > $n)
        $read_more= '<a href="'.get_permalink($custom_post->ID).'" class="link">'.$more.'</a>';

    $cache_duration = vibe_get_option('cache_duration'); if(!isset($cache_duration)) $cache_duration=0;
    if($cache_duration){
        $key= $featured_style.'_'.$custom_post->post_type.'_'.$custom_post->ID;
        if(is_user_logged_in()){
            $user_id = get_current_user_id();
            $user_meta = get_user_meta($user_id,$custom_post->ID,true);
            if(isset($user_meta)){
                $key .= '_'.$user_id;
            }
        }
        $result = wp_cache_get($key,'featured_block');
    }else{$result=false;}

    if ( false === $result ) {

    switch($featured_style){
            case 'course':

                    $return .='<div class="block courseitem" data-id="'.$custom_post->ID.'">';
                    $return .='<div class="block_media">';
                    $return .= apply_filters('vibe_thumb_featured_image',featured_component($custom_post->ID,$cols),$featured_style);
                    $return .='</div>';

                    $return .='<div class="block_content">';


                    $return .= apply_filters('vibe_thumb_heading','<h4 class="block_title" style="border-bottom: 0px"><a href="'.get_permalink($custom_post->ID).'" title="'.$custom_post->post_title.'">'.$custom_post->post_title.'</a></h4>',$featured_style);

                   $customexcerpt = get_the_excerpt();


				   $category='';
                    if(get_post_type($custom_post->ID) == 'course'){

                        $rating=get_post_meta($custom_post->ID,'average_rating',true);
                        $rating_count=get_post_meta($custom_post->ID,'rating_count',true);
                        $meta = '<div class="star-rating">';
                        for($i=1;$i<=5;$i++){

                            if(isset($rating)){
                                if($rating >= 1){
                                    $meta .='<span class="fill"></span>';
                                }elseif(($rating < 1 ) && ($rating > 0.4 ) ){
                                    $meta .= '<span class="half"></span>';
                                }else{
                                    $meta .='<span></span>';
                                }
                                $rating--;
                            }else{
                                $meta .='<span></span>';
                            }
                        }
                        $meta =  apply_filters('vibe_thumb_rating',$meta,$featured_style,$rating);
                        $meta .= '</div>';

                        $free_course = get_post_meta($custom_post->ID,'vibe_course_free',true);
						$meta .='<div class="custom_credits">'; //speedyspace
                        $meta .=bp_course_get_course_credits(array('id'=>$custom_post->ID));
                        $meta .='</div>';






                        $return .= $meta;
                    }
                    $return .=apply_filters('wplms_course_thumb_extras',''); // Use this filter to add Extra HTML to the course featured block


					$avgrating =  get_post_meta( $custom_post->ID, '_kksr_avg', 1 );

					if(get_post_type() != 'course') {

					$return .= '<div class="learnings-meta">';

					if (!empty($avgrating)) {
						$return .='<div class="star-rating">';

						for($i=1;$i<=5;$i++){

                            if(isset($avgrating)){
                                if($avgrating >= 1){
                                    $return .='<span class="fill"></span>';
                                }elseif(($avgrating < 1 ) && ($avgrating > 0.4 ) ){
                                    $return .= '<span class="half"></span>';
                                }else{
                                    $return .='<span></span>';
                                }
                                $avgrating--;
                            }else{
                                $return .='<span></span>';
                            }
                        }

						$return .='</div>';

					} else {
						$return .='<div class="star-rating">';
						$return .='<span class="empty"></span>';
						$return .='<span class="empty"></span>';
						$return .='<span class="empty"></span>';
						$return .='<span class="empty"></span>';
						$return .='<span class="empty"></span>';
						$return .='</div>';
					}


					$return .='</div>';

					$return .= '<div class="learnings_kostenlos-label">Kostenlos</div>';
					}

                    $return .='</div>';
                    $return .='</div>';


                break;







            }
            if($cache_duration)
            wp_cache_set( $course_key,$result,'featured_block',$cache_duration);
        }//end If

        return apply_filters('vibe_featured_thumbnail_style',$return,$custom_post,$featured_style);
}


// files and functions for immunesystem quiz
include( dirname(__FILE__) . "/immunesystem_quiz/is_questionary_shortcode.php");

 //[singlekurs]
class singlekurs {
	public static function singlekurs_func( $atts ) {

		$output = '';


			$args = array(
			'p' => $atts['pid'],
			'post_type' => 'minikurs');

			$the_query = new WP_Query( $args );

			// The Loop
				if ( $the_query->have_posts() ) {
					echo '<div class="vc_grid-container-wrapper vc_clearfix">';
					echo '<div class="vc_grid-container vc_clearfix wpb_content_element vc_basic_grid">';
					echo '<div class="vc_grid vc_row vc_grid-gutter-30px vc_pageable-wrapper vc_hook_hover" data-vc-pageable-content="true">';
					echo '<div class="vc_pageable-slide-wrapper vc_clearfix slides" data-vc-grid-content="true">';

					while ( $the_query->have_posts() ) {


						echo '<div class="vc_grid-item vc_clearfix vc_col-sm-'.$atts['columns'].' vc_grid-item-zone-c-bottom vc_visible-item fadeIn animated block courseitem">';

						$the_query->the_post();

						$current_post = get_the_ID();
						$current_link = get_permalink();
						?>

						<div class="block_media"><a href="<?php echo $current_link ?>" title="<?php get_the_title($current_post); ?>">
						<?php the_post_thumbnail( 'medium' );  ?>
						</a></div>
							<div class="block_content">
						<?php
							echo '<div class="description">';
							echo '<h4 class="block_title" style="border-bottom: none"><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></h4>';
							$postid = get_the_ID();
						echo '</div>';

						echo '<div class="star-rating" style="padding-top: 12px;">';

						$avgrating =  get_post_meta($current_post, '_kksr_avg', 1 );
										if (!empty($avgrating)) {
						echo '<div class="star-rating">';

						for($i=1;$i<=5;$i++){

                            if(isset($avgrating)){
                                if($avgrating >= 1){
                                    echo '<span class="fill"></span>';
                                }elseif(($avgrating < 1 ) && ($avgrating > 0.4 ) ){
                                    echo '<span class="half"></span>';
                                }else{
                                    echo '<span></span>';
                                }
                                $avgrating--;
                            }else{
                                echo '<span></span>';
                            }
                        }

						echo '</div>';
										}						else {
								echo "<img class='emptyrating' src='https://selpers.com/files/uploads/2016/10/crowns-empty.png' style='margin-top: 5px; float: left' >";
							}
							echo '</div>';
							echo '<div class="custom_credits"><strong>KOSTENLOS</strong>';


						echo '</div>';
						echo '</div>';
						echo '</div>';
					}
					echo '</div></div></div></div>';
				} else {
					// no posts found
					echo 'nothing';
				}

			/* Restore original Post Data */
			wp_reset_postdata();


			return $output;

	}
 }
 add_shortcode( 'singlekurs', array( 'singlekurs', 'singlekurs_func' ) );

?>
