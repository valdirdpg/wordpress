/* jQuery Simple Slider v1 */
/* Etienne Fardet */

(function($){
    
	$.fn.simpleSlider = function(options) {
					
			var defaults = {
				navigation: true,
				prevText: "Précédent",
				nextText: "Suivant",
				pagination: true,
				autoplay: false,
				delay: 8000,
				speed: 500,
				numItems: 1
			};
			var options = $.extend(defaults, options);

			var animateSlider = function(elem, compteur, opts) {
				elem.animate({
					marginLeft: -compteur + "%",
					marginTop: 0
				},  { 
					queue:false, 
					duration:opts.speed 
				});
			}
			
			return this.each(function() {
			
				var opts 		= options;
				var $this 		= $(this);              
				var elements 	= $this.children("div");
				var element		= elements.eq(0);
				var compteur 	= 0;
				var tmp_width = elements.width();
				var parentWidth = elements.parent().width();
				var percent = (100*tmp_width/parentWidth)/elements.length;
				var numItems = (opts.numItems > elements.length || opts.numItems < 1) ? parseInt(elements.length) : parseInt(opts.numItems);
				var largeur = ((100/numItems)*tmp_width/parentWidth);

				elements.addClass("slide").css({"width": percent + "%"});
				
				$this.css({"width": (100/numItems)*elements.length+"%"});
	
				if (opts.navigation) {
					if (elements.length > 1) {
						var navigation_slider = $(document.createElement('div'));
						navigation_slider.attr("class", "carousel-nav");
						
						var prev_link = $("<a/>", {
							href: "#",
							html: opts.prevText
						}).addClass("precedent");
						
						var next_link = $("<a/>", {
							href: "#",
							html: opts.nextText
						}).addClass("suivant");
						
						navigation_slider.append(prev_link, next_link);
						$this.parent().after(navigation_slider);
					
						prev_link.bind("click", function(e){
							if (compteur <= 0) compteur = largeur*(elements.length-numItems);
							else compteur -= largeur;
							animateSlider($this, compteur, opts);
							e.preventDefault();
						});
				
						next_link.bind("click", function(e){
							if (compteur >= largeur*(elements.length-numItems)) compteur = 0;
							else compteur += largeur;
							animateSlider($this, compteur, opts);
							e.preventDefault();
						});
					}
				}

				if (opts.pagination) {
					if (elements.length > 1) {
						var pagination_slider = $(document.createElement('div'));
						pagination_slider.attr("class", "carousel-index");
						
						elements.each(function(i) {
							var lien = $("<a/>", {
								href: "#",
								html: i+1
							}).addClass("slide-index slide-"+(i+1));
							pagination_slider.append(lien);
						});
						
						$this.parent().after(pagination_slider);

						pagination_slider.find("a").bind("click", function(e){
							var index_lien = $(this).index()+1;
							var parite_divs = elements.length % 2 == 0 ? 1 : 0;
							var parite_items = numItems % 2 == 0 ? 0 : 0.5;
							
							if (numItems > 1) {
								if (index_lien == 1 || index_lien <= (numItems/2)-parite_divs-parite_items) {
										compteur = 0;
								} else if (index_lien > (numItems/2)-parite_items && index_lien < (elements.length-((numItems/2)-1-parite_items)) ) {
									compteur = largeur*(index_lien-(numItems/2)-parite_items);
								} else if (index_lien >= elements.length) {
									compteur = largeur*(index_lien-numItems);
								} 
							} else {
								if (index_lien == 1) {	
									compteur = 0;
								} else {
									compteur = largeur*(index_lien-numItems);
								}
							}

							pagination_slider.find("a").not($(this)).removeClass("clic");
							$(this).addClass("clic");
							animateSlider($this, compteur, opts);
							e.preventDefault();
						});
					}
				}
		
				if (opts.autoplay) {
					if (elements.length > 1) {
						window.setInterval(function(){
							if (compteur >= largeur*(elements.length-numItems)) compteur = 0;
							else compteur += largeur;
							animateSlider($this, compteur, opts);
						}, opts.delay);
					}
				}
			});
		};
})(jQuery);