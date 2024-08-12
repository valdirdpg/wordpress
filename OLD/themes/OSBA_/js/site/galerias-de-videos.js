$( document ).ready(function() {
	var $modal = $('#galleyModal');
	var $title = $('#galleyModalAlbum');
	var $video = $('#video-content');

	/*$('.owl-gallery').owlCarousel({
        margin:0,
        padding:0,
        nav:false,  
        dots:false,
        items:1
    });*/


	$modal.on('hidden.bs.modal', function(){
		$title.html('');
		$video.attr('src','');
	});
	
	$('.image-item').on('click', function() {
		$video.attr('src', 'https://www.youtube.com/embed/' + $(this).attr('data-id') + '?autoplay=1');
		$title.html($(this).attr('data-title'));
		$modal.modal('show');
	    return false;
	});
});