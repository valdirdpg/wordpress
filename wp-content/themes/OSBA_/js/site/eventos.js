$( document ).ready(function() {
});

function initEventsCalendar(eventDates, selectDate){
	var $picker = $('#events-calendar'),
	    $content = $('#event-content'),
	    currentDate = "",
	    currentMonth = "";

	$picker.datepicker({
	    language: 'pt-BR',
	    onRenderCell: function (date, cellType) {
	        currentDate = date.getDate();
	        currentMonth = (date.getMonth() * 1) + 1;
	        if (cellType == 'day' && eventDates.indexOf(currentDate + '-' + currentMonth) != -1) {
	            return {
	                html: currentDate + '<span class="dp-note"></span>'
	            }
	        }
	    },
	    onSelect: function onSelect(fd, date) {
	    	let h = $content.height();
	    	$content.css({height:h});

	    	$content.find('.event-item').fadeOut(function(){
	    		$(this).remove();
	    	});

	    	setTimeout(function(){ 
	    		$.ajax({
				   url: $content.attr('data-url'),
				   data: {data:fd},
				   method: "POST"
				}).done(function( data ) {
					$content.append(data);
					$content.fadeIn();
					$content.removeAttr('style');
				});
	    	}, 500);
	    }
	});

	if (selectDate != "")
	{
		selectDate = selectDate.split('-');
		$picker.data('datepicker').selectDate(new Date(selectDate[2], (selectDate[1] * 1) - 1, selectDate[0]));
	}
}