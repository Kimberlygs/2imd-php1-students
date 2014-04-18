$(document).ready(function(){
	console.log('ready');
	$("#username").on("focusout", function(e){
				//var clickedLink = $(this);
				console.log('BLURED');
				var user = $("#username").val();
				
				$.ajax({
				  type: "POST",
				  url: "ajax/check_username.php",
				  data: { user: user }
				})
				  /*.done(function( msg ) {
				    
				  });*/

				e.preventDefault();
			});
});