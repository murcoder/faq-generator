<?php

/**
 * Template Name: FAQ Generator
 * Author:  CHRISTOPH MURAUER
 * last updated: 2017-01-05
 */




 get_header(vibe_get_header());

 if ( have_posts() ) : while ( have_posts() ) : the_post();

 $title=get_post_meta(get_the_ID(),'vibe_title',true);
 if(vibe_validate($title) || empty($title)){


 ?>
 <section id="title">
     <div class="<?php echo vibe_get_container(); ?>">
         <div class="row">
             <div class="col-md-12">
                 <div class="pagetitle">
                     <?php
                         $breadcrumbs=get_post_meta(get_the_ID(),'vibe_breadcrumbs',true);
                         if(vibe_validate($breadcrumbs) || empty($breadcrumbs))
                             vibe_breadcrumbs();
                     ?>
                     <h1><?php the_title(); ?></h1>
                     <?php the_sub_title(); ?>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <?php
 }
      /*** DEBUG ON/OFF ***/
        $debug = false;

      $v_add_content = get_post_meta( $post->ID, '_add_content', true );



 ?>
 <section id="content">
     <div class="<?php echo vibe_get_container(); ?>">
         <div class="row">
             <div class="col-md-12">

                 <div class="<?php echo $v_add_content;?> content">
                     <?php
                         the_content();
                         $page_comments = vibe_get_option('page_comments');
                         if(!empty($page_comments))
                             comments_template();
                      ?>
                      <div class="vc_row wpb_row vc_inner vc_row-fluid">
                          <div class="wpb_column vc_column_container vc_col-sm-12">
                              <div class="vc_column-inner ">
                                  <div class="wpb_wrapper">
                                      <div class="wpb_text_column wpb_content_element  lektion_titel">
                                          <div class="wpb_wrapper">
                                              <h1>Wichtige Fragen für Ihren Arztbesuch</h1>

                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="vc_row wpb_row vc_inner vc_row-fluid">
                          <div class="wpb_column vc_column_container vc_col-sm-8">
                              <div class="vc_column-inner ">
                                  <div class="wpb_wrapper">
                                      <div class="wpb_text_column wpb_content_element ">
                                          <div class="wpb_wrapper">
                                              <p>
                                                  Im hektischen Klinikalltag bleibt häufig kaum Zeit für ausführliche Unterhaltungen. Darüber hinaus können Sie sich nach der Diagnosestellung in einem Gefühlschaos befinden, das Ihnen das strukturierte Denken erschwert. Um sicherzugehen, dass Sie nichts
                                                  vergessen, ist es daher ratsam, sich schon zu Hause auf das Gespräch mit Ihrem Arzt vorzubereiten und die wichtigsten Fragen schriftlich festzuhalten. Um sicherzustellen dass Sie keinen Punkt vergessen, können Sie mit unserem
                                                  Fragengenerator Ihre wichtigsten Fragen selber zusammengestellen.
                                              </p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- Filter -->
                      <div  class="vc_row wpb_row vc_inner vc_row-fluid">
                          <div id="faq_filter" class="wpb_column vc_column_container vc_col-sm-8">
                              <div class="vc_column-inner ">
                                <?php echo getFAQFilter(); ?>
                            </div>
                        </div>
                      </div>

                      <!-- messages -->
                      <div class="faq_messages">
                        <div class="faq_msg filter_info" style="display:none;"><i class="fa fa-info-circle" aria-hidden="true"></i><span class="closebtn">&times;</span><span style="margin-left: 10px;">Sie finden Ihre Vorlage am Ende der Seite</span></div>
                        <div class="faq_msg filter_success" style="display:none;"><i class="fa fa-check-circle" aria-hidden="true"></i><span class="closebtn">&times;</span></div>
                        <div class="faq_msg filter_warning" style="display:none;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i><span class="closebtn">&times;</span></div>
                      </div>


                      <div id="questions">
                        <div class="modal"></div> <!-- Loading animation -->


                        <?php
                        global $wpdb;
                        $table_name = $wpdb->prefix . 'faq_generator_questions';
                        $questions_db = $wpdb->get_results ( "SELECT * FROM $table_name" );

                        $table_name = $wpdb->prefix . 'faq_generator_category';
                        $categories = $wpdb->get_results ( "SELECT * FROM $table_name" );

                        $table_name = $wpdb->prefix . 'faq_generator_disease';
                        $diseases = $wpdb->get_results ( "SELECT * FROM $table_name" );


                        $questions_obj = DBToObjectArray($questions_db);
                        ?>




                        <!-- MEINE FRAGEN -->
                        <div  class="checkbox_counter_patient" id="checkbox_counter"><h3>Meine Fragen an den Arzt <span class="counter1"></span></h3></div>
                        <?php
                        $result .= '<div class="col-xs-12 questions_container" id="questions_container1">';

                        foreach($categories as $category){
                          $result .= do_shortcode('[vc_toggle title='.$category->category.' el_id="container1-'.$category->category.'"]'. getQuestionsAsString($questions_obj,array($category->category,false),$debug) .'[/vc_toggle]');
                        }

                        $result .= '</div>';
                        echo $result;
                        ?>


                        <!-- FRAGEN VOM ARZT -->
                        <div class="checkbox_counter_doctor" id="checkbox_counter"><h3>Mögliche Fragen vom Arzt <span class="counter2"></span></h3></div>
                        <?php
                        $result2 .= '<div class="col-xs-12 questions_container" id="questions_container2">';
                        $result2 .= getQuestionsAsString($questions_obj,array(NULL,true),$debug);
                        $result2 .= '</div>';
                        echo $result2;
                        ?>
                      </div>



                      <!-- PDF-TEMPLATE -->
                      <div id="selectedQuestionsBox" class="col-sm-6">
                          <div class="pdf_header">
                            <p class="pdf_type no-print">Checkliste</p>
                            <picture>
                              <?php echo '<img src="' . get_stylesheet_directory_uri() . '/images/selpers-Gesundes-Lernen.png" data-alt-logo="http://selpers.com/wp-content/uploads/2016/05/selperslogo.png" alt="selpers - Mit der Erkrankung am Leben teilnehmen. Was ich für mich tun kann."></img>'; ?>
                            </picture>
                          </div>
                          <h1>Fragen an meinen Arzt</h1>
                          <p>
                            Im hektischen Klinikalltag bleibt häufig kaum Zeit für ausführliche Unterhaltungen.
                            Um sicherzugehen, dass Sie nichts vergessen, ist es daher ratsam, sich schon zu Hause auf das
                            Gespräch mit Ihrem Arzt vorzubereiten und die wichtigsten Fragen schriftlich festzuhalten.
                          </p>
                          <div class="pdf_content">
                            <!-- TODO dynamic content here -->

                            <div  class="checkbox_counter_patient" id="checkbox_counter_pdf"><h3>Meine Fragen an den Arzt</h3></div>

                            <div class="selectedQuestions" id="selectedQuestions-patient">
                            <?php
                            foreach($categories as $category){

                              if(categoryCount($questions_obj,$category->category) > 0){
                                echo '<h4 class="category_title" style="display:none" data-category="'.$category->category.'">'.$category->category.'</h4>';
                                echo '<div class="selectedQuestions" id="selectedQuestions-patient-'.$category->category.'"></div>';
                              }
                            }
                            ?>
                            </div>



                            <!-- <div class="html2pdf__page-break"></div> -->

                            <div class="checkbox_counter_doctor" id="checkbox_counter_pdf"><h3>Mögliche Fragen vom Arzt</h3></div>
                            <div class="selectedQuestions" id="selectedQuestions-doctor">

                            </div>
                          </div>

                          <div id="pdf_template_footer" class="pdf_footer">
                            <p>Weitere hilfreiche Informationen & Tools finden sie unter: <a href="https://selpers.com/">www.selpers.com</a></p>
                          </div>


                          <div data-html2canvas-ignore="true" id="pdf_template_footer" class="pdf_footer_buttons no-print">
                            <div class="col-md-7 col-sm-12 submitButtons col-md-push-5 col-sm-push-0">
                                <button class="btn btn-primary" onclick="print2()" id="print_btn">Drucken</button>
                                <button class="btn btn-primary" onclick="saveAsPDF()" id="pdf_btn">Als PDF speichern</button>
                            </div>
                            <div class="col-md-5 col-sm-12 deleteButton col-md-pull-7 col-sm-push-0">
                                <button class="btn btn-danger" onclick="location.reload();" type="reset">Zurücksetzen</button>
                            </div>
                        </div>

                      </div>



                    </div>
                 </div>
             </div>
         </div>
 </section>




<script type="text/javascript">

   function saveAsPDF(){

     //Fit to A4
      jQuery('#selectedQuestionsBox').css('width',810);

     //html2pdf: https://github.com/eKoopmans/html2pdf
     var pdf = document.getElementById('selectedQuestionsBox');
      html2pdf(pdf, {
        margin:       0.1,
        filename:     'checkliste.pdf',
        image:        { type: 'jpeg', quality: 0.99 },
        html2canvas:  { dpi: 300, letterRendering: true },
        jsPDF:        { unit: 'cm', format: 'letter', orientation: 'portrait' }
      });

      //Resize
      if($('#selectedQuestionsBox').hasClass('col-sm-6'))
         $('#selectedQuestionsBox').css('width','50%');
      else if($('#selectedQuestionsBox').hasClass('col-sm-12'))
        $('#selectedQuestionsBox').css('width','100%');
    }

    function print(){
      $(function(){
          $("#print_btn").printPreview({
              obj2print:'#selectedQuestionsBox',
              width:'810'
          });
      });
    }

    function print2(){
          var divContents = $("#selectedQuestionsBox").html();
          var printWindow = window.open('', '', 'height=400,width=800');
          printWindow.document.write('<html><head><title>Checkliste</title>');
          printWindow.document.write('<link rel="stylesheet" href="https://dev.selpers.com/wp-content/themes/gesundeslernen/style.css" />');
          printWindow.document.write('</head><body onload="window.print()">');
          printWindow.document.write(divContents);
          printWindow.document.write('</body></html>');
          printWindow.document.close();
    }

    function selectAll(){
      $('.question').each(function(index) {
        console.log("NR: " + $(this).data('nr'));
        $(this).find('#question_checkbox').addClass('active');
      });
    }

 </script>


 <?php
 endwhile;
 endif;
 ?>
 <?php
 get_footer( vibe_get_footer() );
