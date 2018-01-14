jQuery(document).ready(function(event) {


  $body = jQuery("body");

  jQuery(document).on({
      ajaxStart: function() { $body.addClass("loading");    },
      ajaxStop: function() { $body.removeClass("loading"); }
  });



  //Show or Hide the 'cancer'-selection
  jQuery('#disease').on('change', function(){
    if(this.value == 'Krebs'){
      if($('#faq_filter').hasClass('vc_col-sm-8'))
        $('#faq_filter').addClass('vc_col-sm-12').removeClass('vc_col-sm-8');

      $('.faq_filter_form ul li').css('width','25%');
      $('#cancerFilter').fadeIn('600');
    }else{

      $('#cancerFilter').fadeOut('600', function(){
        if($('#faq_filter').hasClass('vc_col-sm-12'))
          $('#faq_filter').addClass('vc_col-sm-8').removeClass('vc_col-sm-12');

        $('.faq_filter_form ul li').css('width','31%');
      });
    }
  });


  //AJAX request
 jQuery('#faq_filter_form').submit(ajaxSubmit);

 function ajaxSubmit() {
   var questionCounter = 0;
    var filterForm = jQuery(this).serialize();
    var vDisease = jQuery("#disease").val();
    var vCancer = "";


    if($('#cancerFilter:hidden').length == 0)
      var vCancer = jQuery("#cancer").val();



    //Message box
    var close = document.getElementsByClassName("closebtn");
    for (var i = 0; i < close.length; i++) {
        close[i].onclick = function(){
          jQuery.when(jQuery('.faq_msg').fadeOut(600)).done(function() {
              jQuery('.faq_filter_text').remove();
          });
        }
    }


    jQuery.ajax({
      action:  'filter_questions_ajax',
      type:    'POST',
      url:     'faq_filter_ajax'.ajax_url,    // Including ajax file
      data:    'faq_filter_ajax'.filterForm,


      success: function(data) {

        //Delete previous message
        jQuery.when(jQuery('.faq_msg').hide()).done(function() {
            jQuery('.faq_filter_text').remove();
        });


        jQuery( ".question" ).each(function( index ) {
          var disease = $(this).data('disease');

          if(vDisease != "Alle"){
              if(vDisease == disease || vCancer == disease){
                jQuery(this).fadeIn();
                questionCounter++;
              }else{
                jQuery(this).hide();
              }
          }else{
            jQuery(this).fadeIn();
            questionCounter = -1;
          }
        });


        //Message handling
        var msg = "";
        var wurdeN = "wurden";
        var FrageN = "Fragen";

        if(questionCounter != 0){
          if(questionCounter == 1){
            wurdeN = "wurde";
            var FrageN = "Frage";
          }

          if(vCancer != ""){
            msg += "Es "+wurdeN+" " + questionCounter + " " + FrageN+" zum Thema <i>" + vCancer + "</i>";
          }else if(vDisease != "Alle"){
            msg += "Es "+wurdeN+" " + questionCounter + " " + FrageN+" zum Thema <i>" + vDisease + "</i>";
          }

          if(msg != ""){
            jQuery('.faq_msg.filter_success').append(jQuery('<span class="faq_filter_text">' +
              msg + ' gefunden</span>'));
            jQuery('.faq_msg.filter_success').fadeIn(600);
          }

        }else{

          //No search results
          jQuery( ".vc_toggle" ).hide();

          if(vCancer != ""){
            msg += "zum Thema <i>" + vDisease +" - "+ vCancer + "</i>";
          }else if(vDisease != "Alle"){
            msg += "zum Thema <i>" + vDisease + "</i>";
          }

          jQuery('.faq_msg.filter_warning').append(jQuery('<span class="faq_filter_text">' +
            'Leider konnten keine Fragen ' + msg + ' gefunden werden</span>'));
          jQuery('.faq_msg.filter_warning').fadeIn(600);

        }

      },

      error: function(errorThrown){console.log(errorThrown);}

    }).done(function()  {
        hideEmptyCategories();
        //resetLists();
    }).fail(function()  {
        console.log("Ajax error: Server unavailable. ");
  });

    return false;
  }


  function resetLists(){
    //Get categories as array
    var categories = $('#selectedQuestions-patient h4').map(function(){
                   return $.trim($(this).text());
                }).get();


    //Reset doctor list
    $( "#selectedQuestions-doctor ul" ).remove();
    $( "#selectedQuestions-doctor" ).append('<ul class="doctor-question-list"></ul>');

    //Reset patient lists
    for(i=0;i<categories.length; i++){
      $( "#selectedQuestions-patient-" + categories[i] +" ul" ).remove();
      $( "#selectedQuestions-patient-" + categories[i] ).append('<ul class="patient-question-list-'+categories[i]+'"></ul>');
      $("h4[data-category='" + categories[i] +"']").hide();
    }

  }



  function hideEmptyCategories(){

    jQuery( ".vc_toggle" ).each(function( index ) {
      var oneIsVisible = false;

      //Check if there is at least one, visible, question in a toggle
      jQuery(this).children('.vc_toggle_content').children('.question').each(function( index ) {
        if( jQuery(this).css("display") == 'block' ){
          oneIsVisible = true
          return false;
        }
      });

        if(!oneIsVisible){
          jQuery(this).hide();
        }else{
          jQuery(this).show();
        }
    });
  }



});
