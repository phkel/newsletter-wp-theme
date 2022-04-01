<?php
/**
 * The template for displaying the front page
 *
 * @package newsletter
 */

get_header(); ?>

<main class="h-full lg:grid lg:grid-cols-2 lg:px-20 xl:px-[120px]">
    <?php get_template_part('partials/signup'); ?>
    <?php get_template_part('partials/quotes'); ?>
</main>

<?php
get_footer();
