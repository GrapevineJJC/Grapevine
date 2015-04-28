<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  

<script>

$(document).ready(function() {
	$(".AddToBL").click(function() {
		var eventID = $(this).attr('id');
		//alert(eventID);
		$.ajax({
			type: "POST",
			url: 'wp-content/plugins/grapevine/feed.php',
			data: { eventID : eventID },
			success: function(data)
			{
				alert("SUCCESS!  "+eventID);
			}
		
		});
	
	});

});

</script>