$(document).ready(function() {
	function searchUser() {
		var query_value1 = $('#newUserID').val();
		if(query_value1 !== ''){
			$.ajax({
				type: "POST",
				url: "newUser.php",
				data: { query: query_value1 },
				cache: false,
				success: function(html){
					// console.log(html);
					$("#userIdMessage").html(html);
				}
			});
		}return false;    
	}

	$("#newUserID").live("keyup", function(e) {
		// Set Timeout
		// console.log("HEY THERE!!");
		clearTimeout($.data(this, 'timer'));

		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("#userIdMessage").fadeOut();
		}else{
			$("#userIdMessage").fadeIn();
			$(this).data('timer', setTimeout(searchUser, 100));
		};
	});

	
});