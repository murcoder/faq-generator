<?php

/**
 * Fired during plugin activation
 *
 * @link       www.murdesign.at
 * @since      1.0.0
 *
 * @package    Faq_Generator
 * @subpackage Faq_Generator/includes
 */





/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Faq_Generator
 * @subpackage Faq_Generator/includes
 * @author     Christoph Murauer <office@speedy-space.com>
 */
class Faq_Generator_Activator {

	/**
	* The current version of the database.
	*
	* @since    1.0.0
	* @access   protected
	* @var      string    $version    The current version of the plugin.
	*/
 static $db_version = '1.0.0';

 //Call the static version variable
 public static function getDatabaseVersion() {
		 return self::$db_version;
 }


 public static function activate() {

				 //Create database table
				 global $wpdb;
				 $plugin_version = get_option( 'faq_generator_version', '1.0.0' );
				 $charset_collate = $wpdb->get_charset_collate();

				 //--- FAQ - FRAGEN (question)
				 $table_name = $wpdb->prefix . 'faq_generator_questions';
				 $sql = "CREATE TABLE $table_name (
					 id mediumint(9) NOT NULL AUTO_INCREMENT,
					 -- question_nr int NOT NULL,
					 category varchar(255) NOT NULL,
					 disease varchar(255) NOT NULL,
					 question varchar(255) NOT NULL,
					 isFromDoctor boolean NOT NULL,
					 added datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					 PRIMARY KEY  (id)
				 ) $charset_collate;";

				 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
				 dbDelta( $sql );
				 add_option( 'faq_generator_db_version', Faq_Generator_Activator::getDatabaseVersion() );


				 if ( Faq_Generator_Activator::getDatabaseVersion() != $plugin_version ) {
					 //Insert UPDATES here
					 $sql = "CREATE TABLE $table_name (
						 id mediumint(9) NOT NULL AUTO_INCREMENT,
						 -- question_nr int NOT NULL,
             category varchar(255) NOT NULL,
  					 disease varchar(255) NOT NULL,
  					 question varchar(255) NOT NULL,
  					 isFromDoctor boolean NOT NULL,
						 added datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
						 PRIMARY KEY  (id)
					 ) $charset_collate;";

					 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
					 dbDelta( $sql );
					 add_option( 'faq_generator_db_version', Faq_Generator_Activator::getDatabaseVersion() );

				 }




				 //--- FAQ - THEMA (category)
				 $table_name = $wpdb->prefix . 'faq_generator_category';
				 $sql = "CREATE TABLE $table_name (
					 id mediumint(9) NOT NULL AUTO_INCREMENT,
					 category varchar(255) NOT NULL,
					 added datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					 PRIMARY KEY  (id)
				 ) $charset_collate;";

				 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
				 dbDelta( $sql );

				 if ( Faq_Generator_Activator::getDatabaseVersion() != $plugin_version ) {
					 //Insert UPDATES here
					 $sql = "CREATE TABLE $table_name (
						 id mediumint(9) NOT NULL AUTO_INCREMENT,
						 category varchar(255) NOT NULL,
						 added datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
						 PRIMARY KEY  (id)
					 ) $charset_collate;";

					 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
					 dbDelta( $sql );
					 update_option( 'faq_generator_db_version', Faq_Generator_Activator::getDatabaseVersion() );

				 }



				 //--- FAQ - KRANKHEIT (disease)
				 $table_name = $wpdb->prefix . 'faq_generator_disease';
				 $sql = "CREATE TABLE $table_name (
					 id mediumint(9) NOT NULL AUTO_INCREMENT,
					 disease varchar(255) NOT NULL,
					 added datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					 PRIMARY KEY  (id)
				 ) $charset_collate;";

				 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
				 dbDelta( $sql );

				 if ( Faq_Generator_Activator::getDatabaseVersion() != $plugin_version ) {
					 //Insert UPDATES here
					 $sql = "CREATE TABLE $table_name (
						 id mediumint(9) NOT NULL AUTO_INCREMENT,
						 disease varchar(255) NOT NULL,
						 added datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
						 PRIMARY KEY  (id)
					 ) $charset_collate;";

					 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
					 dbDelta( $sql );
					 update_option( 'faq_generator_db_version', Faq_Generator_Activator::getDatabaseVersion() );

				 }

				 //Add initial Data
				 Faq_Generator_Activator::faq_generator_initial_data();

	 }


	 //Database tester
	 public static function faq_generator_initial_data() {
		 global $wpdb;

		 $initial_categories = array('Diagnose','Therapie','Operation','Chemotherapie');
		 $initial_diseases = array('COPD','Hämophilie','Myelom','Lymphomen','Lungenkrebs','Prostatakrebs','Darmkrebs','Brustkrebs');


		 $table_name = $wpdb->prefix . 'faq_generator_category';

			 foreach ( $initial_categories as $category ){

				 $duplicate = $wpdb->get_var(
												 $wpdb->prepare(
														 "SELECT category FROM ".$table_name."
														 WHERE category = %d",
														 $category
												 )
										 );

					 if ( $duplicate <= 0 ){
						 $wpdb->insert(
							 $table_name,
							 array(
								 'added' => current_time( 'mysql' ),
								 'category' => $category
							 )
						 );
				 	}
			 }



			$table_name = $wpdb->prefix . 'faq_generator_disease';

			foreach ( $initial_diseases as $disease ){

				$duplicate = $wpdb->get_var(
												$wpdb->prepare(
														"SELECT disease FROM ".$table_name."
														WHERE disease = %d",
														$disease
												)
										);

					if ( $duplicate <= 0 ){
						$wpdb->insert(
							$table_name,
							array(
								'added' => current_time( 'mysql' ),
								'disease' => $disease
							)
						);
					}
			}


	 }

}
