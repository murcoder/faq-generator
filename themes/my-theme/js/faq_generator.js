



$(document).ready(function(){


  var questions = new Array();

  //Message box
  var close = document.getElementsByClassName("closebtn");
  for (var i = 0; i < close.length; i++) {
      close[i].onclick = function(){
        jQuery.when(jQuery('.faq_msg').fadeOut(600));
      }
  }

    //TODO Remove Question
    // $("#removeQuestionBtn").click(function() {
    //   alert("GOT IT!");
    //     //$("#myList li").eq(1).remove();
    // });

    //Check if User selected a question
    $(".questions_container input:checkbox").on("change", function(e) {

      //Create OBJECT of selected question
      var question = {
        id: $(this).data('nr'),
        category: $(this).data('category'),
        disease: $(this).data('disease'),
        text: $(this).parents('ul.list-inline').children('li.checkboxRight').children('label').text(),
        doctor: $(this).data('doctor')
      };


      /** Build questions array **/
      if($(this).parent().hasClass('active') ){
        //Add question if ACTIVE
        var index = questions.findIndex(question => question.id === $(this).data('nr'));
          if (index == -1) {
              questions.push( question );
          }
      }else{
        //Remove question if NOT ACTIVE
        var index = questions.findIndex(question => question.id === $(this).data('nr'));
          if (index > -1) {
              questions.splice(index, 1);
          }
      }

      //Reset all lists
      resetLists();

      //Create new lists
      for(i=0; i<questions.length; i++){
        if(!questions[i].doctor){
          var listSelector = '.patient-question-list-' + questions[i].category;
          addItemToList( questions[i],listSelector );

          listSelector += " li";

          if($(listSelector).length >= 1)
            $("h4[data-category='" + questions[i].category +"']").show();

        }else{
          addItemToList( questions[i], '.doctor-question-list');
        }
      }

      //console.log(questions);

      //Everything done! Show pdf-box
    	showSelectionBox();
    });


    function addItemToList(item,list){
      var html = '<li data-nr="'+item.id+'"><span class="btn btn-default" id="question_checkbox"></span>'+item.text+'</li><hr>';
      //var html += '<li data-nr="'+item.nr+'">';
      //html += '<button class="btn btn-danger btn-xs" type="button" id="removeQuestionBtn">x</button>';
      $(list).append(html);
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



    /*
    *   Fade in the selection-Box and count the selection
    */
    function showSelectionBox() {
      var len = $("#questions_container1 input[type='checkbox']:checked").length;
      $(".checkbox_counter_patient .counter1").text("(" + len + ")");

      var len2 = $("#questions_container2 input[type='checkbox']:checked").length;
      $(".checkbox_counter_doctor .counter2").text("(" + len2 + ")");

      if(len > 0 || len2 > 0){
        //At least one question selected - SHOW BOX

        if($(window).width() > 1000) {
          //screen width > 1000px
          if($('#selectedQuestionsBox').hasClass('col-sm-12')){
            $('#selectedQuestionsBox').addClass('col-sm-6').removeClass('col-sm-12');
          }
          $('#questions').css('width','50%');
        }else{
          //screen width < 1000px
          if($('#selectedQuestionsBox').hasClass('col-sm-6'))
            $('#selectedQuestionsBox').addClass('col-sm-12').removeClass('col-sm-6');


            jQuery('.faq_msg.filter_info').fadeIn(600);


        }

        $( "#selectedQuestionsBox" ).fadeIn( "slow", function() {  });

      }else{
        //No question selected - HIDE BOX
        jQuery('.faq_msg.filter_info').fadeOut(600);

          $( "#selectedQuestionsBox" ).fadeOut( "slow", function() {
            $('#questions').css('width','100%');
        });

      }
    }



});
