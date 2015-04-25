<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
<script src="/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-tooltip.js"></script>  
<script src="/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-popover.js"></script>  
<script>  
	$(function (){
   	 	$('[rel=popover]').popover({ 
       		html : true, 
        	content: function() {
          	return $('#popover_content_wrapper').html();
        }
    	});
    });
    
    function clickedIt(){
    	//alert("SUBMIT BUTTON CLICKED!");
    	var list = document.getElementsByName("blnames");
    	alert(list[0]);
    	//var checkedValue = $('.blchecks:checked').val();
    	//alert(checkedValue);
    	for(var l=0; l< list.length; l++) {
    		alert("BucketList: "+list[l]);
    	}
    }
</script>