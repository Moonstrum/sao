(function($) {
  "use strict";

   var  $doc = $(document),
        $win = $(window),
        $partnersSlider = $('.partners-slider'),
        $testimonialSlider = $('.testimonials-slider'),
        $morphtextClass = $(".js-rotating");

  var bxSliderPartners;

  /***************************************/
  /********* Morphtext Animation *********/
  /**************************************/
  if (sao_js_vars.sao_header_animation == '1') {
     $win.ready(function() {
       $morphtextClass.Morphext({
         animation: sao_js_vars.header_title_animation,
         separator: ",",
         speed: sao_js_vars.header_title_animation_speed,
         complete: function() {}
       });
     });
   }

   /***************************************/
  /********* Back to Top Button *********/
  /*************************************/
  if ($('#backtotop').length) {
      var scrollTrigger = 100, // px
        backToTop = function() {
          var scrollTop = $(window).scrollTop();
          if (scrollTop > scrollTrigger) {
            $('#backtotop').addClass('show');
          } else {
            $('#backtotop').removeClass('show');
          }
        };
      backToTop();
      $win.on('scroll', function() {
        backToTop();
      });
      $('#backtotop').on('click', function(e) {
        e.preventDefault();
        $('html,body').animate({
          scrollTop: 0
        }, 800);
      });
  }

  /***************************************/
  /********* Project Gallery*** *********/
  /**************************************/
    var cbSettings = {
      rel: 'project-gallery',
      width: '95%',
      height: 'auto',
      maxWidth: '1060',
      maxHeight: 'auto',
      title: function() {
        return $(this).find('img').attr('alt');
      }
    };

    $('.sp-gallery-image a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]').colorbox(cbSettings);

    $win.on('resize', function() {
      $.colorbox.resize({
        width: window.innerWidth > parseInt(cbSettings.maxWidth) ? cbSettings.maxWidth : cbSettings.width
      });
    });

  function saoGetPartnersSlideParams() {
        var params;
        // get the window width
        var winWidth = $win.width();

        if (winWidth < 991) {
            params = {
                auto: true,
                minSlides: 1,
                maxSlides: 8,
                slideMargin: 30,
                slideWidth: 350,
                ticker: true,
                speed: 20000,
                autoStart: true,
                moveSlides: 4,
                infiniteLoop: true
            };
        } else {
            params = {
                auto: true,
                minSlides: 1,
                maxSlides: 8,
                slideWidth: 300,
                slideMargin: 20,
                ticker: true,
                speed: 20000,
                autoStart: true,
                moveSlides: 4,
                infiniteLoop: true
            };
        }

        return params;
    }


   /**
  * Initialize the bxSlider
  *
  * @param selector
  * @param bxSlider objects
  */
   function saoInitBxSlider($el, params) {
       return $el.bxSlider(params);
   }

   function saoInit() {        /*
            * BxSliders
            */
           var partnersSlideparams = saoGetPartnersSlideParams();

           bxSliderPartners = saoInitBxSlider($partnersSlider, partnersSlideparams);

       }
       saoInit();

   /***************************************/
   /********* Smoothscroll *********/
   /*************************************/
   $doc.ready(function() {
     $('a[href^="#"]').on('click', function(e) {
       e.preventDefault();

       var target = this.hash;
       var $target = $(target);
       var headerHeight = $('#masthead').outerHeight();

       $('html, body').stop().animate({
         'scrollTop': $target.offset().top - headerHeight
       }, 3000);
     });
   });

   /***********************************/
/********* Material Card *********/
/*********************************/
  $('.material-card').materialCard({

    icon_close: 'fas fa-times',
    icon_open: 'fas fa-bars',
    card_activator: 'click' // or hover
  });

/***************************************/
/********* Testimonial Slider *********/
/*************************************/
  $testimonialSlider.slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: sao_js_vars.testimonial_slider_speed,
    prevArrow: '<span class="slider--control left"></span>',
    nextArrow: '<span class="slider--control right"></span>',
  });

  /******************************************************/
  /********* Menu Highlighting current Section *********/
  /****************************************************/
  var lastCall, timeoutId;

  function throttle(fn, interval) {
    var now = new Date().getTime();
    if (lastCall && now < lastCall + interval) {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(function() {
        lastCall = now;
        fn.call();
      }, interval - (now - lastCall));
      return 'aborted';
    } else {
      lastCall = now;
      fn.call();
    }
  }

  var $navigationLinks = $('.primary-navigation > ul > li > a');
  var $sections = $("section");
  var $sectionReversed = $($("section").get().reverse());
  var sectionIdTonavigationLink = {};

  $sections.each(function() {
    sectionIdTonavigationLink[$(this).attr('id')] = $('.primary-navigation > ul > li > a[href="#' + $(this).attr('id') + '"]');
  });

  function optimized() {
    var scrollPosition = $(window).scrollTop();
    var pageMenu = $(".primary-navigation");
    var pageMenuHeight = pageMenu.outerHeight() - 500;

    $sectionReversed.each(function() {
      var currentSection = $(this);
      var $headerSection = $(".header-homepage");
      var sectionTop = currentSection.offset().top + pageMenuHeight;
      var id = currentSection.attr('id');
      var $navigationLink = sectionIdTonavigationLink[id];

      if (scrollPosition >= sectionTop) {

        if (!$navigationLink.hasClass('active')) {
          $navigationLinks.removeClass('active');
          $navigationLink.addClass('active');
        }
        return false;
      } else {
        $navigationLink.removeClass('active');
      }
    });
  }

  function throttleOptimized() {
    return throttle(optimized, 100);
  }

  $win.scroll(function() {
    optimized();
  });

  /************************************/
  /********* Image Slider JS *********/
  /**********************************/
    var sliding = false,
      curSlide = 1,
      numOfSlides = $(".slider--el").length;

    $doc.on("click", ".slider--control", function() {
      if (sliding) return;
      sliding = true;
      $(".slider--el").show();
      $(".slider--el").css("top");
      $(".slider--el.active").addClass("removed");
      ($(this).hasClass("right")) ? curSlide++ : curSlide--;
      if (curSlide < 1) curSlide = numOfSlides;
      if (curSlide > numOfSlides) curSlide = 1;
      $(".slider--el-" + curSlide).addClass("next");

      setTimeout(function() {
        $(".slider--el.removed").hide();
        $(".slider--el").removeClass("active next removed");
        $(".slider--el-" + curSlide).addClass("active");
        sliding = false;
      }, 1800);
    });

  $win.on('load',function() {
    $('.text-box').focus(function() {
      if ($(this).val().trim() == "") {
        $(this).prev().css({
          top: '-10px',
          fontSize: '0.7em'
        });
      }
      $(this).prev().css({
        color: '#06C7CE'
      });
    });

    $('.text-box').blur(function() {
      if ($(this).val().trim() == "") {
        $(this).prev().css({
          top: '5px',
          fontSize: '0.8em'
        });
      }
      $(this).prev().css({
        color: '#FFF'
      });
    });
  });

  /************************************/
  /********* WOW JS Animation *********/
  /**********************************/
  $win.on('load',function(){
  var wow;

   wow = new WOW(
     {
       animateClass: 'wow',
       offset:       100,
       callback:     function(box) {
       // console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
       }
     }
   );
 wow.init();

  });

  /************************************/
  /********* Google Map *********/
  /**********************************/

      window.initMap = function (){
        var lat = parseFloat(Number(sao_js_vars.google_maps_latitude).toFixed(8));
        var lng = parseFloat(Number(sao_js_vars.google_maps_longitude).toFixed(8));

        var center = {
          lat: lat,
          lng: lng
        };

        var map = new google.maps.Map(document.getElementById('map_container'), {
          zoom: 18,
          center: center
        });
        var marker = new google.maps.Marker({
          position: center,
          map: map
        });
      };

})(jQuery);
