<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.murdesign.at
 * @since      1.0.0
 *
 * @package    Faq_Generator
 * @subpackage Faq_Generator/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

     <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
     <a class="button button-primary" target="_blank" href="<?php echo get_site_url(); ?>/faq-generator"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> zur Webseite</a>

     <div class="flexbox">


         <!-- FRAGE -->
         <section class="card">
           <div class="faq_form">

             <h2><?php _e('Frage', $this->plugin_name);  ?></h2>


              <form id="faq_plugin_form" method="post" name="faq_generator_add" action="">

              <?php
                //Output nonce, action, and option_page fields for a settings page.
                //Please note that this function must be called inside of the form tag for the options page.
                settings_fields($this->plugin_name);
                do_settings_sections($this->plugin_name);
              ?>

              <!-- Use hidden field to select a form -->
              <input type="hidden" name="<?php echo $this->plugin_name; ?>-add_question" value="Y">
              <input type="hidden"  id="<?php echo $this->plugin_name; ?>-id" name="<?php echo $this->plugin_name; ?>_id" />

              <?php
                global $wpdb;
                $table_name = $wpdb->prefix . 'faq_generator_category';
                $categories = $wpdb->get_results ( "SELECT * FROM $table_name" );
               ?>

              <fieldset>
              <label><?php _e('Thema', $this->plugin_name); ?></label><br />
                <select id="dCategory" name="<?php echo $this->plugin_name; ?>_category">
                  <?php
                  foreach ( $categories as $category )   {
                  ?>
                  <option value="<?php echo $category->category; ?>"><?php echo $category->category; ?></option>
                  <?php
                }
                  ?>
                </select>
              </fieldset>

              <?php
                global $wpdb;
                $table_name = $wpdb->prefix . 'faq_generator_disease';
                $diseases = $wpdb->get_results ( "SELECT * FROM $table_name" );
               ?>

              <fieldset>
              <label><?php _e('Krankheit', $this->plugin_name); ?></label><br />
                <select id="dDisease" name="<?php echo $this->plugin_name; ?>_disease">
                  <?php
                  foreach ( $diseases as $disease )   {
                  ?>
                  <option value="<?php echo $disease->disease; ?>"><?php echo $disease->disease; ?></option>
                  <?php
                }
                  ?>
                </select>
              </fieldset>

              <fieldset>
                    <label><?php _e('Vom Arzt?', $this->plugin_name); ?></label><br>
                    <input  type="checkbox" class="faq-doctor" id="dDoctor" name="<?php echo $this->plugin_name; ?>_doctor" />
              </fieldset>


              <fieldset>
                    <label><?php _e('Neue Frage erstellen', $this->plugin_name); ?></label><br>
                    <textarea placeholder="Neue Frage" required rows="3" cols="44" class="faq-text" id="dText" name="<?php echo $this->plugin_name; ?>_text" ></textarea>
              </fieldset>

              <?php submit_button(__('Frage erstellen', $this->plugin_name), 'primary','submit', TRUE); ?>
              </form>
            </div>
          </section>



          <!-- THEMA -->
          <section class="card">
              <?php
                //Output nonce, action, and option_page fields for a settings page.
                //Please note that this function must be called inside of the form tag for the options page.
                settings_fields($this->plugin_name);
                do_settings_sections($this->plugin_name);
              ?>

            <h2><?php _e('Thema', $this->plugin_name);  ?></h2>

              <!-- create a new Tag -->
            <form method="post" name="faq_generator_add_category" action="">
                <fieldset>
                      <p><?php _e('Neues Thema erstellen', $this->plugin_name);  ?>:</p>
                      <input type="hidden" name="<?php echo $this->plugin_name; ?>-add_category" value="Y">
                      <input class="faq-new-category" id="<?php echo $this->plugin_name; ?>-newCategory" name="newCategory" placeholder="Neues Thema" />
                </fieldset>

              <?php
              //Usage: submit_button( $text, $type, $name, $wrap, $other_attributes );
              submit_button(__('Thema erstellen', $this->plugin_name), 'primary','submit', TRUE);
              ?>
            </form>

                <?php
                global $wpdb;
                $table_name = $wpdb->prefix . 'faq_generator_category';
                $categories = $wpdb->get_results ( "SELECT * FROM $table_name" );
                 ?>

                <div class="faq_list">
                <table summary="This table lists all categories">
                	<caption><?php _e('Alle Themen', $this->plugin_name); ?></caption>

                	<tbody>
                  <?php
                  foreach ( $categories as $category )   {
                  ?>
                   	<tr>
                      <th hidden scope="row" name="category_id"><?php echo $category->id;?></th>
                  		<th scope="row" class="column1"><?php echo $category->category; ?></th>
                      <th scope="row" class="column7"><form class="delete" name="category_delete" action="" method="post">
                          <input type="hidden" name="<?php echo $this->plugin_name; ?>-remove_category" value="Y">
                          <input type="hidden" name="<?php echo $this->plugin_name; ?>_category_id" value="<?php echo $category->id;?>">  <!-- get id -->
                          <?php submit_button( __( 'X', $this->plugin_name ), 'delete button-primary', FALSE ); ?></form>
                      </th>
                  	</tr>
                    <?php } ?>
                	</tbody>
                </table>
              </div>
          </section>



          <!-- KRANKHEIT -->
          <section class="card">
              <?php
                //Output nonce, action, and option_page fields for a settings page.
                //Please note that this function must be called inside of the form tag for the options page.
                settings_fields($this->plugin_name);
                do_settings_sections($this->plugin_name);
              ?>

            <h2><?php _e('Krankheit', $this->plugin_name);  ?></h2>

              <!-- create a new Tag -->
            <form method="post" name="faq_generator_add_disease" action="">
                <fieldset>
                      <p><?php _e('Neue Krankheit erstellen', $this->plugin_name);  ?>:</p>
                      <input type="hidden" name="<?php echo $this->plugin_name; ?>-add_disease" value="Y">
                      <input class="faq-new-disease" id="<?php echo $this->plugin_name; ?>-newDisease" name="newDisease" placeholder="Neue Krankheit" />
                </fieldset>

              <?php
              //Usage: submit_button( $text, $type, $name, $wrap, $other_attributes );
              submit_button(__('Krankheit erstellen', $this->plugin_name), 'primary','submit', TRUE);
              ?>
            </form>

                <?php
                global $wpdb;
                $table_name = $wpdb->prefix . 'faq_generator_disease';
                $diseases = $wpdb->get_results ( "SELECT * FROM $table_name" );
                 ?>

                <div class="faq_list">
                <table summary="This table lists all categories">
                	<caption><?php _e('Alle Krankheiten', $this->plugin_name); ?></caption>

                	<tbody>
                  <?php
                  foreach ( $diseases as $disease )   {
                  ?>
                   	<tr>
                      <th hidden scope="row" name="disease_id"><?php echo $disease->id;?></th>
                  		<th scope="row" class="column1"><?php echo $disease->disease; ?></th>
                      <th scope="row" class="column7"><form class="delete" name="disease_delete" action="" method="post">
                          <input type="hidden" name="<?php echo $this->plugin_name; ?>-remove_disease" value="Y">
                          <input type="hidden" name="<?php echo $this->plugin_name; ?>_disease_id" value="<?php echo $disease->id;?>">  <!-- get id -->
                          <?php submit_button( __( 'X', $this->plugin_name ), 'delete button-primary', FALSE ); ?></form>
                      </th>
                  	</tr>
                    <?php } ?>
                	</tbody>
                </table>
              </div>
          </section>
        </div>




  <!-- FRAGENKATALOG -->
  <?php
    global $wpdb;
    $table_name = $wpdb->prefix . 'faq_generator_questions';
    $results = $wpdb->get_results ( "SELECT * FROM $table_name" );
    $rowcount = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
   ?>

  <div class="faq_list">
    <table id="speedy-plugin-table" summary="This table lists all questions">
    	<caption><?php _e('Fragenkatalog (' . $rowcount . ')', $this->plugin_name); ?></caption>

    	<thead>
    	<tr class="odd">
        <th scope="col" abbr="category" onclick="sortTable(0)"><?php _e('Thema', $this->plugin_name); ?></th>
    		<th scope="col" abbr="disease" onclick="sortTable(1)"><?php _e('Krankheit', $this->plugin_name); ?></th>
        <th scope="col" abbr="text" onclick="sortTable(2)"><?php _e('Frage', $this->plugin_name); ?></th>
    		<th scope="col" abbr="doctor" onclick="sortTable(3)"><?php _e('Vom Arzt?', $this->plugin_name); ?></th>
    	</tr>
    	</thead>

    	<tbody>
      <?php
      foreach ( $results as $question )   {
      ?>
       	<tr>
          <td scope="row" class="column2"><?php echo $question->category;?></td>
          <td scope="row" class="column3"><?php echo $question->disease;?></td>
          <td scope="row" class="column1"><?php echo $question->question;?></td>
          <td scope="row" class="column4"><?php echo $question->isFromDoctor;?></td>
          <td hidden scope="row" name="question_id"><?php echo $question->id;?></td>
          <td scope="row" class="column8"><form class="delete" name="faq_generator_delete" action="" method="post">
              <input type="hidden" name="<?php echo $this->plugin_name; ?>-remove_question" value="Y">
              <input type="hidden" name="<?php echo $this->plugin_name; ?>_id" value="<?php echo $question->id;?>">  <!-- get id -->
              <?php submit_button( __( 'X', $this->plugin_name ), 'delete button-primary', FALSE ); ?></form>
          </td>
      	</tr>
        <?php } ?>
    	</tbody>
    </table>
  </div>
</div>
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("speedy-plugin-table");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc";
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
