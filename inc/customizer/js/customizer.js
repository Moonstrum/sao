jQuery(document).ready(function() {
  wp.customize.section('sidebar-widgets-multi-service-widget').panel('services_panel');
  wp.customize.section('sidebar-widgets-multi-service-widget').priority('5');
  wp.customize.section('sidebar-widgets-multi-team-widget').panel('team_panel');
  wp.customize.section('sidebar-widgets-multi-team-widget').priority('5');
  wp.customize.section('sidebar-widgets-multi-testimonial-widget').panel('testimonial_panel');
  wp.customize.section('sidebar-widgets-multi-testimonial-widget').priority('5');
  wp.customize.section('sidebar-widgets-multi-partners-widget').panel('clients_panel');
  wp.customize.section('sidebar-widgets-multi-partners-widget').priority('5');
});
