<?php
/*
 	AJAX - Pass the admin.ajax url to javascript
*/
// Register the script
wp_enqueue_script( 'filter_questions_ajax',get_stylesheet_directory_uri() . '/js/faq_generator-filter.js', array( 'jquery' ) );



// Localize the script with new data
wp_localize_script( 'filter_questions_ajax', 'faq_filter_ajax', array( 'ajax_url' => admin_url('admin-ajax.php')) );



/* Add more custom functions here */
