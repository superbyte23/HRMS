<script>
	$('a#delete').confirm({
 		icon: 'fa fa-spinner fa-spin',
 		theme: "dark",
 		type: 'red',
	    title: 'Delete Data!',
	    animation: 'rotateX',
    	closeAnimation: 'rotateX',

	    animationSpeed: 400,
	     buttons: {
	        Yes: function () {
            location.href = this.$target.attr('href');
	        },
	        cancel: function () {
	            //$.alert('Canceled!');
	        }
		    }
	});	
</script>