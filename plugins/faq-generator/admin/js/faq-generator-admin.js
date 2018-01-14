(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */


	 // function sortTable(n) {
	 //   var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
	 //   table = document.getElementById("myTable");
	 //   switching = true;
	 //   //Set the sorting direction to ascending:
	 //   dir = "asc";
	 //   /*Make a loop that will continue until
	 //   no switching has been done:*/
	 //   while (switching) {
	 //     //start by saying: no switching is done:
	 //     switching = false;
	 //     rows = table.getElementsByTagName("TR");
	 //     /*Loop through all table rows (except the
	 //     first, which contains table headers):*/
	 //     for (i = 1; i < (rows.length - 1); i++) {
	 //       //start by saying there should be no switching:
	 //       shouldSwitch = false;
	 //       /*Get the two elements you want to compare,
	 //       one from current row and one from the next:*/
	 //       x = rows[i].getElementsByTagName("TD")[n];
	 //       y = rows[i + 1].getElementsByTagName("TD")[n];
	 //       /*check if the two rows should switch place,
	 //       based on the direction, asc or desc:*/
	 //       if (dir == "asc") {
	 //         if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
	 //           //if so, mark as a switch and break the loop:
	 //           shouldSwitch= true;
	 //           break;
	 //         }
	 //       } else if (dir == "desc") {
	 //         if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
	 //           //if so, mark as a switch and break the loop:
	 //           shouldSwitch= true;
	 //           break;
	 //         }
	 //       }
	 //     }
	 //     if (shouldSwitch) {
	 //       /*If a switch has been marked, make the switch
	 //       and mark that a switch has been done:*/
	 //       rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
	 //       switching = true;
	 //       //Each time a switch is done, increase this count by 1:
	 //       switchcount ++;
	 //     } else {
	 //       /*If no switching has been done AND the direction is "asc",
	 //       set the direction to "desc" and run the while loop again.*/
	 //       if (switchcount == 0 && dir == "asc") {
	 //         dir = "desc";
	 //         switching = true;
	 //       }
	 //     }
	 //   }
	 // }


	 jQuery(document).ready(function(){
		//  //AJAX request
	  // jQuery('#faq_plugin_form').submit(ajaxSubmit);

				// var category = jQuery("#dCategory").val();
				// var disease = jQuery("#dDisease").val();
				// var text = jQuery("#dText").val();
				// var doctor = jQuery("#dDoctor").val();
        //
        //
				// jQuery.ajax({
				// 		action:  'add_question_to_DB',
				// 		type: 'POST',
				// 		url:  'faq-plugin_ajax'.ajax_url,
				// 		data: {
				// 		"dCategory": category,
				// 		"dDisease": disease,
				// 		"dText": text,
				// 		"dDoctor": doctor
				// 		}, // Sending data dname to 'add_question_to_DB' function.
				// 		success: function(data) { // Show returned data using the function.
				// 		alert(data);
				// 		}
				// });
//-------------
				// function ajaxSubmit() {
			  //   var questionCounter = 0;
			  //    var filterForm = jQuery(this).serialize();
			  //    var vDisease = jQuery("#disease").val();
        //
        //
        //
			  //    jQuery.ajax({
			  //      action:  'filter_questions_ajax',
			  //      type:    'POST',
			  //      url:     'faq-plugin_ajax'.ajax_url,
			  //      data:    'faq-plugin_ajax'.filterForm,
        //
        //
			  //      success: function(data) {
        //
			  //        //Delete previous message
			  //        jQuery.when(jQuery('.faq_msg').hide()).done(function() {
			  //            jQuery('.faq_filter_text').remove();
			  //        });
        //
        //
			  //        jQuery( ".question" ).each(function( index ) {
			  //          // console.log("Filter selected: " + vDisease + ", " + vCancer + "| zum filtern: " + $(this).data('disease'));
			  //          var disease = $(this).data('disease');
        //
			  //          if(vDisease != "Alle"){
			  //              if(vDisease == disease || vCancer == disease){
			  //                jQuery(this).fadeIn();
			  //                questionCounter++;
			  //              }else{
			  //                jQuery(this).hide();
			  //              }
			  //          }else{
			  //            jQuery(this).fadeIn();
			  //            questionCounter = -1;
			  //          }
			  //        });
        //
        //
			  //        //Message handling
			  //        var msg = "";
			  //        var wurdeN = "wurden";
			  //        var FrageN = "Fragen";
        //
			  //        if(questionCounter != 0){
			  //          if(questionCounter == 1){
			  //            wurdeN = "wurde";
			  //            var FrageN = "Frage";
			  //          }
        //
			  //          if(vCancer != ""){
			  //            msg += "Es "+wurdeN+" " + questionCounter + " " + FrageN+" zum Thema <i>" + vCancer + "</i>";
			  //          }else if(vDisease != "Alle"){
			  //            msg += "Es "+wurdeN+" " + questionCounter + " " + FrageN+" zum Thema <i>" + vDisease + "</i>";
			  //          }
        //
			  //          if(msg != ""){
			  //            jQuery('.faq_msg.filter_success').append(jQuery('<span class="faq_filter_text">' +
			  //              msg + ' gefunden</span>'));
			  //            jQuery('.faq_msg.filter_success').fadeIn(600);
			  //          }
        //
			  //        }else{
        //
			  //          //No search results
			  //          jQuery( ".vc_toggle" ).hide();
        //
			  //          if(vCancer != ""){
			  //            msg += "zum Thema <i>" + vDisease +" - "+ vCancer + "</i>";
			  //          }else if(vDisease != "Alle"){
			  //            msg += "zum Thema <i>" + vDisease + "</i>";
			  //          }
        //
			  //          jQuery('.faq_msg.filter_warning').append(jQuery('<span class="faq_filter_text">' +
			  //            'Leider konnten keine Fragen ' + msg + ' gefunden werden</span>'));
			  //          jQuery('.faq_msg.filter_warning').fadeIn(600);
        //
			  //        }
        //
			  //      },
        //
			  //      error: function(errorThrown){console.log(errorThrown);}
        //
			  //    }).done(function()  {
			  //        hideEmptyCategories();
			  //        //resetLists();
			  //    }).fail(function()  {
			  //        console.log("Ajax error: Server unavailable. ");
			  //  });
        //
			  //    return false;
			  //  }
        //



});





})( jQuery );
