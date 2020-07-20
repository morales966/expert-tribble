$(document).ready(function(){
	$('.aliados').slick({
	  dots: true,
	  infinite: false,
	  speed: 300,
	  slidesToShow: 5,
	  slidesToScroll: 2,
	  responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 3,
	        infinite: true,
	        dots: true
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 2
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }

	  ]
	});
});

$(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
        $('a.scroll-top').fadeIn('fast');
        $('.nav-custom').addClass('bg-white-shadow');

    	$imgchange = $("#logo").attr("dataattr");
    	$("#logo").attr('src',$imgchange);

    } else {
        $('a.scroll-top').fadeOut('fast');
        $('.nav-custom').removeClass('bg-white-shadow');

        $("#logo").attr('src',"img/crediventas-white.png");
    }
});

$('a.scroll-top').click(function(event) {
    event.preventDefault();
    $('html, body').animate({scrollTop: 0}, 100);
});