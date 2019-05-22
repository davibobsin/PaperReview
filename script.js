//POP-UP
$(window).load(function () {

	$('.edit').hide();
	$(".trigger_info").click(function(){
	   $('.hover_info').show();
	});

	$('.close_info').click(function(){
		$('.hover_info').hide();
	});

	$(".trigger_upload").click(function(){
	   $('.hover_upload').show();
	});

	$('.close_upload').click(function(){
		$('.hover_upload').hide();
	});

	$(".trigger_edit").click(function(){
	   $('.edit').toggle();
	});
});

//UPLOADER
window.addEventListener("load", function(){
  // GET THE DROP ZONE
  var uploader = document.getElementById('uploader');

  // STOP THE DEFAULT BROWSER ACTION FROM OPENING THE FILE
  uploader.addEventListener("dragover", function (e) {
    e.preventDefault();
    e.stopPropagation();
  });

  // ADD OUR OWN UPLOAD ACTION
  uploader.addEventListener("drop", function (e) {
    e.preventDefault();
    e.stopPropagation();

    // RUN THROUGH THE DROPPED FILES + AJAX UPLOAD
    for (var i = 0; i < e.dataTransfer.files.length; i++) {
    
	}
  });
});
