$( document ).ready(function() {
	var $url = $('.page-content').attr('data-url');
	var $carousel = $('.owl-gallery');
	var optionsCarousel = {
        margin:0,
        padding:0,
        nav:true,  
        navText: [ "<i class='icon-angle-left'></i>","<i class='icon-angle-right'></i>" ],     
        dots:true,
        items:1
    };
	
	//GALERIA DE IMAGENS
    //$carousel.owlCarousel(optionsCarousel);

	$('#galleyModal').on('hidden.bs.modal', function(){
		$('#galleyModalAlbum').html('');
		$('#modal-body-content').html('');
		$carousel.trigger('destroy.owl.carousel');
	});
	
	$('.image-item').on('click', function(){
		$.ajax({
		   url: $url,
		   data: {id:$(this).attr('data-id')},
		   method: "POST",
		   dataType:"json",
		}).done(function( data ) {
			if (data.__error == '0'){
				$('#galleyModalAlbum').html(data.name);
				$('#modal-body-content').html(data.body);
				$carousel.owlCarousel(optionsCarousel);
				$('#galleyModal').modal('show');
			}
			else {
				alert(data.__message);
			}
		});
	    return false;
	});
});