$( document ).ready(function() {
    //INIT WOW
    new WOW().init();

    var $formSearch = $('#form-search');
    $formSearch.on("submit", function () {
        let term = $(this).find('#search-text').val().replace(/^\s+/g, '');
        if (term == '') return false;
        
        //let input = $(this).serialize();
        let url = $(this).attr('data-url')+ "&term=" + term;
        window.location.href = url;
        return false;
    });

    //campo de busca
    $('.btn-search-toggle').on('click', function() {
        $( ".form-search-box" ).slideToggle( "fast", 
            function(){
             $('input#search-text').focus();
        } );       
        $(this).toggleClass('open');
        return false;
    });

    //footer back to top
    $("#backToTop").click(function (){
        event.preventDefault();
        $('html, body').animate({
              scrollTop: $("#mainHeader").offset().top
        }, 1000);
    });

});
