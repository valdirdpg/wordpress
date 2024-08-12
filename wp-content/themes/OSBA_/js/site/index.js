$( document ).ready(function() {
	$('.owl-banner-highlights').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        items:1,
	    autoplay:true,
	    autoplayTimeout:4000,
	    autoplayHoverPause:true,
         responsive:{
            768:{
                stagePadding: 40,
            },
        }
    });

    $('.owl-last-events').owlCarousel({
       // loop:false,
        margin:10,
        responsiveClass:true,     
        dots:false,        
        nav:true,
        navText: [ "<i class='icon-angle-left'></i>","<i class='icon-angle-right'></i>" ],
        responsive:{
            0:{                
                items:1,
            },
            728:{
                stagePadding: 20,
                items:2,
            },
            992:{
                stagePadding: 20,
                items:3, 
            },
            1400:{
                stagePadding: 40,
                items:4
            }
        }
    });

    $('.owl-projects, .owl-series').owlCarousel({
        margin:0,
        nav:true,
        navText: [ "<i class='icon-angle-left'></i>","<i class='icon-angle-right'></i>" ],
        dots:false,
        items:1
    });

	var $form = $('#newsletter-form');
	$form.on("submit", function (event) {
		event.preventDefault();
	    $.ajax({
		   url: $(this).attr('action'),
		   data: {name:$(this).find('#newsletter-name').val(), email:$(this).find('#newsletter-email').val()},
		   method: "POST",
		   dataType:"json",
		}).done(function( data ) {
			var alert;
			if (data.__error == '0'){
				alert = $form.find('.alert-primary')
				$form[0].reset();
			}
			else {
				alert = $form.find('.alert-danger')	
			}

			alert.html(data.__message);
			alert.fadeIn(function(){
				setTimeout(function(){ 
					alert.fadeOut(function(){
						alert.html('');
					});
				}, 1000);
			});
		});
	    return false;
	});
});

function initEventsCalendar(eventObjs){
	var $picker = $('#events-calendar'),
	    currentDate = "",
	    currentMonth = "";
	var eventDates = [];
	$(eventObjs).each(function(_,el){
		eventDates.push(el.date);
	});
	$picker.datepicker({
	    language: 'pt-BR',
	    onRenderCell: function (date, cellType) {
	        currentDate = date.getDate();
	        currentMonth = (date.getMonth() * 1) + 1;
	        if (cellType == 'day'){
	         	let idx = eventObjs.map(function(e){return e.date;}).indexOf(currentDate + '-' + currentMonth);
	         	if(idx != -1){
	         		let typeClass = eventObjs[idx].type == '1'? 'event' : 'extension';
		            return {
		                html: currentDate + '<span class="dp-note '+typeClass+'"></span>'
		            }
	         	}
	        }
	    },
	    onSelect: function onSelect(fd, date) {
			let day = fd.replace(new RegExp('/', 'g'),'-');
			window.location.href = $picker.attr('data-url') + day;
	    }
	});
}