function facebookshare() {
	FB.ui({
 		method: 'share',
 		href: window.location.href,
 	}, function(response){});
}

function twittershare($title) {
	window.open("http://twitter.com/intent/tweet?status="+$title+"+"+window.location.href, "_blank", "width=600,height=400");
}
