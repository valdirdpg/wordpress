
(function() {

	var triggerBttn = document.getElementById( 'trigger-overlay' ),
		overlay = document.querySelector( 'div.menu-overlay' ),
		closeBttn = overlay.querySelector( 'button.overlay-close' );
	

	function toggleOverlay() {
		if( classie.has( overlay, 'open' ) ) {
			$('body').css({overflow:''});
			classie.remove( overlay, 'open' );
			classie.add( overlay, 'menu-close' );


			var onEndTransitionFn = function( ev ) {
				
				classie.remove( overlay, 'menu-close' );
			};
			setTimeout(onEndTransitionFn, 700);
			
		}
		else if( !classie.has( overlay, 'menu-close' ) ) {
			classie.add( overlay, 'open' );

			$('body').css({overflow:'hidden'});
		}
	}

	triggerBttn.addEventListener( 'click', toggleOverlay );
	closeBttn.addEventListener( 'click', toggleOverlay );

	$('div.menu-overlay').find('.nav-item a').on('click', function(){
		closeBttn.click();    	    
    });

})();