(function($) {
  $('.toggle-nav').on('click', function() {
    $('.main-navigation').toggleClass('nav-is-visible');
    $('.primary-navigation').toggleClass('nav-is-visible');
  });

  var breakpoint = 768;
  $(window).resize(function() {
    if ($(document).width() < breakpoint) {
      $('.primary-navigation').removeAttr('style');

    }
  });

  $(document).on("scroll", function(){
		if
      ($(document).scrollTop() > 100){
		  $(".site-branding").addClass("shrink");
		}
		else
		{
			$(".site-branding").removeClass("shrink");
		}
	});

  //Sticky Header
  $(window).on('scroll',function() {
    if ($(window).scrollTop() >= 50) {
      $('.site-header').addClass('fixed-header');
      $('.site-header').removeClass('header-top');
    } else {
      $('.site-header').removeClass('fixed-header');
      $('.site-header').addClass('header-top');
    }
  });
})(jQuery);
