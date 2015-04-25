<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
<script src="/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-tooltip.js"></script>  
<script src="/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-popover.js"></script>  
<script>  
	$(function (){
   	 	$('[rel=popover]').popover({ 
       		html : true, 
        	content: function() {
          	return $('.popover_content_wrapper').html();
        }
    	});
    });
    
    function clickedIt(){
    		var input = $("#eventid").val();
    		alert(input);
    	
    	//var blnames = $("input[name='blnames']").val();
    	//alert(blnames);
    	//var str = new Array();
    	//$("input:checkbox[name=blnames]:checked").each(function() {
    	//	str.push($(this).val());
    	//});
    	//alert(str);
    	//var list = document.getElementsByName("blnames");
    	//var eventid = document.getElementsByName("eventid").value;
    	//alert(eventid);
    	//var checkedValue = $('.blchecks:checked').val();
    	//alert(checkedValue);
    	//for(var l=0; l< list.length; l++) {
    	//	alert("BucketList: "+list[l]);
    	//}
    }
</script>