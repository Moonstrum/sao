(function($) {
  // Site title and description.

  wp.customize('blogdescription', function(value) {
    value.bind(function(to) {
      $('.site-description').text(to);
    });
  });

  // Header text color.
  wp.customize('header_textcolor', function(value) {
    value.bind(function(to) {
      if ('blank' === to) {
        $('.site-title, .site-description').css({
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        });
      } else {
        $('.site-title, .site-description').css({
          'clip': 'auto',
          'position': 'relative'
        });
        $('.site-title a, .site-description').css({
          'color': to
        });
      }
    });
  });

  wp.customize('header_show_overlay', function(value) {
    value.bind(function(newval) {
      if (newval) {
        $('.site-header').addClass('color-overlay');
      } else {
        $('.site-header').removeClass('color-overlay');
      }
    });
  });


  wp.customize('layout_setting', function(value) {
    value.bind(function(to) {
      $('#site-navigation').removeClass('centered-menu', 'top-menu', 'top-menu-ns');
      $('#site-navigation').addClass(to);
    });
  });
})(jQuery);
