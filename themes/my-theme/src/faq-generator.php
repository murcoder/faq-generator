<?php


require_once( __DIR__ . '/class-question.php');

function custom_js_faq() {
  echo '<script src="' . get_stylesheet_directory_uri() . '/js/faq_generator.js" type="text/javascript"></script>';
  echo '<script src="' . get_stylesheet_directory_uri() . '/js/printPreview.js" type="text/javascript"></script>';
  echo '<script src="' . get_stylesheet_directory_uri() . '/js/html2pdf.bundle.min.js" type="text/javascript"></script>';
}
// Add hook for admin <head></head>
add_action('admin_head', 'custom_js_faq');
// Add hook for front-end <head></head>
add_action('wp_head', 'custom_js_faq');



/**
* Get question as String
* @param array,array,boolean questions, filteroption ('category' & 'isDoctor'), debuggin on/off
* @return string the filtered questions
*/
function getQuestionsAsString($questions,$options = array(),$debug=false){
  // echo "option0: " . $options[0] . " | option1: " .$options[1] . "<br />";

  $result = "";

  if(is_array($options)){
    //options param has to be an array
    $isFromDoctor = $options[1];
    $category = $options[0];

    foreach($questions as $question){

        if($debug){
        echo "<pre>";
        echo $question->getText() . "<br />";
        echo "Nr: ".$question->getNr()." | doctor: " .  $question->isFromDoctor() . " | category: " .  $question->getCategory() . " | disease: " .  $question->getDisease();
        echo "</pre>";
        }


      if(!$isFromDoctor){
        //Questions by patient
        if(!$question->isFromDoctor() && strcmp($question->getCategory(),$category) == 0)
          $result .= $question->__toString();
      }else{
        //Questions by doctor
        if( $question->isFromDoctor() )
          $result .= $question->__toString();
      }
    }
  }

  return $result;
}





/**
*   Converts an database array of 'questions' to object array
*
*/
function DBToObjectArray($questions_db){#

  $questions_obj = array();


  foreach($questions_db as $question_db){
    $question_obj  = new question();
    $question_obj->setNr($question_db->id);
    $question_obj->setCategory($question_db->category);
    $question_obj->setDisease($question_db->disease);
    $question_obj->setText($question_db->question);
    $question_obj->setIsFromDoctor($question_db->isFromDoctor);
    $questions_obj[] = $question_obj;
  }

  return $questions_obj;
}




/**
* Count how many questions of a specific category exists
* @return int number of questions of one category
*/
function categoryCount($questions,$category){
  $counter = 0;

  foreach($questions as $question){
    if(!$question->isFromDoctor() && strcmp($question->getCategory(), $category) == 0 ){
      $counter++;
      // echo "<script>console.log( '".$counter." HIT!  ".$question->getCategory() . " with category: ".$category."' );</script>";

    }
  }

  return $counter;
}


/**
*   Get Diseases from DB or get static data
*   (Requires the plugin 'faq-generator' for dynamic data)
*/

function getDiseases(){
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    $diseases_str = array();

    if(is_plugin_active("faq-generator/faq-generator.php") ){
      //Get Tags from Database | this requires the plugin Event_Creator to be active!
      global $wpdb;
      $table_name = $wpdb->prefix . 'faq_generator_disease';
      $diseases_db = $wpdb->get_results ( "SELECT * FROM $table_name" );

      //add string to array
      foreach($diseases_db as $disease)
          $diseases_str[] = $disease->disease;

    }else{
      //Get static diseases
      $diseases_str = Disease::getDiseases();
    }
    return $diseases_str;
}


/**
*   Get all cancer-types out of an array
*/

function getCancers($diseases){
    $cancers = array();

    foreach($diseases as $disease){
      if(strcmp($disease,'Ovarialkarzinom') === 0
      || strcmp($disease,'CLL') === 0
      || strcmp($disease,'Myelom') === 0
      || strcmp($disease,'Lymphomen') === 0
      || preg_match("/krebs/", $disease)){
        $cancers[] = $disease;
      }
    }

    return $cancers;
}





/**
*   Returns the filter-form as html-string
*/
function getFAQFilter(){

  $AllDiseases = getDiseases();
  $cancers = getCancers($AllDiseases);
  $diseases = array();

  foreach($AllDiseases as $disease){
    if(strcmp($disease,'Ovarialkarzinom') !== 0
    && strcmp($disease,'CLL') !== 0
    && strcmp($disease,'Myelom') !== 0
    && strcmp($disease,'Lymphomen') !== 0
    && !preg_match("/krebs/", $disease) )
      $diseases[] = $disease;
    }

  $result = '<form id="faq_filter_form" class="faq_filter_form" action="" method="post">' .
              '<ul>'.
                '<li><h4>Krankheit</h4>'.
                '<label>'.
                  '<select id="disease" name="disease">';

                  if(isset($_POST['disease']))
                    $result .= '<option selected disabled>'.$_POST['disease'].'</option>';
                  else
                    $result .= '<option selected>Alle</option>';

                  foreach ( $diseases as $disease )
                    $result .= '<option value="'.$disease.'">'.$disease.'</option>';


  $result .=       '</select>'.
                '</label>'.
                '</li>';

  $result .=    '<li id="cancerFilter" style="display:none"><h4>Krebsart</h4>'.
                '<label>'.
                  '<select id="cancer" name="cancer">';

                  if(isset($_POST['cancer']))
                    $result .= '<option selected disabled>'.$_POST['cancer'].'</option>';
                  else
                    $result .= '<option selected>Allgemein</option>';

                  foreach ( $cancers as $cancer )
                    $result .= '<option value="'.$cancer.'">'.$cancer.'</option>';

  $result .=       '</select>'.
                '</label>'.
                '</li>' .
                '<li><h4>Filter anwenden</h4>'.
                  '<input type="hidden" name="action" value="filterQuestions"/>'.
                  '<input id="filter_btn" class="faq_filter_btn" type="submit" value="FILTERN"></input>'.
                '</li>';
$result .=      '<li><h4>Alle Fragen wählen</h4>' .
                '<button id="filter_all_btn" class="faq_filter_btn" onclick="selectAll()" value="ALLES AUSWÄHLEN">ALLES WÄHLEN</button>'.
                '</li>' .
              '</ul>'.
            '</form>';
  return $result;
}
