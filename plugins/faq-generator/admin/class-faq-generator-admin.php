<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.murdesign.at
 * @since      1.0.0
 *
 * @package    Faq_Generator
 * @subpackage Faq_Generator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Faq_Generator
 * @subpackage Faq_Generator/admin
 * @author     Christoph Murauer <office@speedy-space.com>
 */
class Faq_Generator_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->wp_faq_generator_options = get_option($this->plugin_name);
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Faq_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Faq_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/faq-generator-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Faq_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Faq_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/faq-generator-admin.js', array( 'jquery' ), $this->version, false );
		//Include Javascript library
		// wp_enqueue_script('faq-generator-plugin_ajax', plugins_url( '/js/faq-generator-admin.js' , __FILE__ ) , array( 'jquery' ));
		// including ajax script in the plugin Myajax.ajaxurl
		wp_localize_script( $this->plugin_name, 'faq-plugin_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php')));

	}



	/**
 * Register the administration menu for this plugin into the WordPress Dashboard menu.
 *
 * @since    1.0.0
 */

public function add_plugin_admin_menu() {

    /*
     * Add a settings page for this plugin to the Settings menu.
     *
     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
     *
     *        Administration Menus: http://codex.wordpress.org/Administration_Menus
     *
     */
    add_options_page( 'FAQ Generator', 'FAQ Generator', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
    );
}


public function custom_add_menu() {

        add_menu_page( 'FAQ Generator', 'FAQ Generator', 'manage_options', 'faq-generator-dashboard', array($this, 'display_dashboard_page'), plugins_url('img/faq-logo.png', __FILE__),'2.2.9');

        add_submenu_page( 'faq-generator-dashboard', 'FAQ Generator' . ' - Add Question', 'Add Question', 'manage_options', 'faq-generator-dashboard', array($this, 'display_dashboard_page'));

        // add_submenu_page( 'faq-generator-dashboard', 'FAQ Generator' . ' - Settings', 'Settings', 'manage_options', 'faq-generator-settings', array($this, 'display_plugin_setup_page'));
    }



 /**
 * Add settings action link to the plugins page.
 *
 * @since    1.0.0
 */

public function add_action_links( $links ) {
	    /*
	    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
	    */
	   $settings_link = array(
	    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
public function display_plugin_setup_page() {
	    include_once( 'partials/faq-generator-admin-settings.php' );
	}

	/**
	 * Render the dashboard page for this plugin.
	 *
	 * @since    1.0.0
	 */
public function display_dashboard_page() {
	    include_once( 'partials/faq-generator-admin-dashboard.php' );
	}

	/**
	*
	* admin/class-wp-cbf-admin.php
	*
	**/
public function validate($input) {
	    // All checkboxes inputs
	    $valid = array();

	    //Cleanup
	    $valid['debug'] = (isset($input['debug']) && !empty($input['debug'])) ? 1 : 0;
	    $valid['newTag'] = esc_url($input['newTag']);

	    return $valid;
	 }


	 /**
	 *
	 * admin/class-wp-cbf-admin.php
	 *
	 **/
public function options_update() {
			//register a setting and control the input with a callback function
	    register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
			//$_POST[$this->plugin_name . "_newTag"];
	  }




		/**
		* Add a question to the database
		*
		* @since    1.0.0
		*/
public function add_question_to_DB() {
				global $wpdb;

				//choose function by hidden field
		    $hidden_field_name = $this->plugin_name . "-add_question";

				// name-fields of html input
				$category =  $this->plugin_name . "_category";
		    $disease =  $this->plugin_name . "_disease";
				$text =  $this->plugin_name . "_text";
				$doctor =  $this->plugin_name . "_doctor";
				$isFromDoctor = false;

				if($_POST[$doctor])
					$isFromDoctor = true;
				else
					$isFromDoctor = false;

		    // See if the user has posted us some information
		    // If they did, this hidden field will be set to 'Y'
		    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {

					//Add user input to database
						$wpdb->insert( $wpdb->prefix . 'faq_generator_questions', array(
							'added' => current_time( 'mysql' ),
							'category' => $_POST[$category],
							'disease' => $_POST[$disease],
							'question' => $_POST[$text],
							'isFromDoctor' => $isFromDoctor,
			    ));

					//Check for database errors
					if($wpdb->last_error !== ''){
						//Print all database errors
						$this->db_print_error();
					}else{
		        // Put an options updated message on the screen
						$query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );
						?>
						<div class="updated">
							<p><strong><?php _e('Frage hinzugefügt!', $this->plugin_name ); ?></strong><br />
								<?php echo ($this->wp_faq_generator_options['debug'] ? "<code>$query</code>" : ""); ?>
							</p>
						</div>
						<?php
					}
		    }

		}




		/**
		* Remove a question out of the database
		*
		* @since    1.0.0
		*/
public function remove_question_from_DB(){


					global $wpdb;

					//choose function by hidden field
					$hidden_field_name = $this->plugin_name . "-remove_question";
					$id_field_name = $this->plugin_name . '_id';

					if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {

							$wpdb->delete(  $wpdb->prefix . 'faq_generator_questions', array( 'ID' => $_POST[$id_field_name] )  );
							//echo "<script>console.log( 'Debug Objects: " . $_POST[$id_field_name] . "' );</script>";

							//Check for database errors
							if($wpdb->last_error !== ''){
								//Print all database errors
								$this->db_print_error();
							}else{
								// Put an options updated message on the screen
								$query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );
								?>
								<div class="updated">
									<p><strong><?php _e('Frage entfernt!', $this->plugin_name ); ?></strong><br />
										<?php echo ($this->wp_faq_generator_options['debug'] ? "<code>$query</code>" : ""); ?>
									</p>
								</div>
								<?php
							}
					}
}





/**
* Adds a new category to database
*
* @since    1.0.0
*/
public function add_category_to_DB(){

		global $wpdb;
		$table_name = $wpdb->prefix . 'faq_generator_category';
		$hidden_field_name = $this->plugin_name . "-add_category";

		if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {

			$wpdb->insert(
				$table_name,
				array(
					'added' => current_time( 'mysql' ),
					'category' => $_POST['newCategory']
				)
			);

			//Check for database errors
			if($wpdb->last_error !== ''){
				//Print all database errors
				$this->db_print_error();
			}else{
				// Put an options updated message on the screen
				$query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );
				?>
				<div class="updated">
					<p><strong><?php _e('Thema erstellt!', $this->plugin_name ); ?></strong><br />
						<?php echo ($this->wp_faq_generator_options['debug'] ? "<code>$query</code>" : ""); ?>
					</p>
				</div>
				<?php
			}
		}
}



/**
* Removes an category of the database
*
* @since    1.0.0
*/
public function remove_category_from_DB(){


			global $wpdb;

			//choose function by hidden field
			$hidden_field_name = $this->plugin_name . "-remove_category";
			$id_field_name = $this->plugin_name . '_category_id';

			if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {

					$wpdb->delete(  $wpdb->prefix . 'faq_generator_category', array( 'ID' => $_POST[$id_field_name] )  );

					//Check for database errors
					if($wpdb->last_error !== ''){
						//Print all database errors
						$this->db_print_error();
					}else{
						// Put an options updated message on the screen
						$query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );
						?>
						<div class="updated">
							<p><strong><?php _e('Thema entfernt!', $this->plugin_name ); ?></strong><br />
								<?php echo ($this->wp_faq_generator_options['debug'] ? "<code>$query</code>" : ""); ?>
							</p>
						</div>
						<?php
					}
			}
}





/**
* Adds a new disease to database
*
* @since    1.0.0
*/
public function add_disease_to_DB(){

		global $wpdb;
		$table_name = $wpdb->prefix . 'faq_generator_disease';
		$hidden_field_name = $this->plugin_name . "-add_disease";

		if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {

			$wpdb->insert(
				$table_name,
				array(
					'added' => current_time( 'mysql' ),
					'disease' => $_POST['newDisease']
				)
			);

			//Check for database errors
			if($wpdb->last_error !== ''){
				//Print all database errors
				$this->db_print_error();
			}else{
				// Put an options updated message on the screen
				$query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );
				?>
				<div class="updated">
					<p><strong><?php _e('Krankheit erstellt!', $this->plugin_name ); ?></strong><br />
						<?php echo ($this->wp_faq_generator_options['debug'] ? "<code>$query</code>" : ""); ?>
					</p>
				</div>
				<?php
			}
		}
}



/**
* Remove a disease from the database
*
* @since    1.0.0
*/
public function remove_disease_from_DB(){


			global $wpdb;

			//choose function by hidden field
			$hidden_field_name = $this->plugin_name . "-remove_disease";
			$id_field_name = $this->plugin_name . '_disease_id';

			if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {

					$wpdb->delete(  $wpdb->prefix . 'faq_generator_disease', array( 'ID' => $_POST[$id_field_name] )  );

					//Check for database errors
					if($wpdb->last_error !== ''){
						//Print all database errors
						$this->db_print_error();
					}else{
						// Put an options updated message on the screen
						$query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );
						?>
						<div class="updated">
							<p><strong><?php _e('Krankheit entfernt!', $this->plugin_name ); ?></strong><br />
								<?php echo ($this->wp_faq_generator_options['debug'] ? "<code>$query</code>" : ""); ?>
							</p>
						</div>
						<?php
					}
			}
}




/**
* Print messages for database-errors
*
* @since    1.0.0
*/
public function db_print_error(){

		    global $wpdb;

		    if($wpdb->last_error !== ''){

		        $str   = htmlspecialchars( $wpdb->last_result, ENT_QUOTES );
						$query = "";

						if($this->wp_faq_generator_options['debug'])
		        	$query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );


		        echo "<div class='error'><p><strong>WordPress database error:</strong> [$str]<br /><code>$query</code></p></div>";

		    }

		}





}
