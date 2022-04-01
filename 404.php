<?php
/**
 * Template for 404 page
 *
 * @package newsletter
 */

get_header();
?>

  <div class="container flex flex-col justify-center text-center">
    <div class="text-6xl font-semibold">404</div>
    <div><?php _e('Page not found', 'newsletter'); ?></div>
  </div>

<?php get_footer(); ?>
