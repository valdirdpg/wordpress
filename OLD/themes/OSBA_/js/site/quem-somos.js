$(document).ready(function(){
	console.log(window.location.href);
	$musician_modal = $("#musicianModal");
	$(".btn-musician-modal").on('click', function(e){
		$.ajax({
			url: window.location.href,
			method: "POST",
		   	dataType:"json",
			data:{id: $(this).data('id')},
			success:function(res){
				if(res.__error == '0'){
					$musician_modal.find('.modal-dialog').html(res.__data.content);
					$musician_modal.modal('show');
				}
			}
		});
	});
});