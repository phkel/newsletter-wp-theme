<?php
$args = array(
    'post_type' => 'quotes',
    'posts_per_page' => -1,
);
$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) : ?>
    <ul id="quote-list" class="relative min-h-[300px] lg:my-10 lg:mdHeight:my-40 pb-12 lg:pb-0 pl-12 pr-6 lg:pr-0 xl:pl-24 text-white">
    <?php while ( $the_query->have_posts() ) : $the_query->the_post();

    $author_image = get_field('quote_photo');
    $medium_image = $author_image['sizes'][ 'medium' ];
    $quote        = get_field('quote_quotation');
    ?>
        <li class="w-[175px] animate__animated animate__fadeIn quote-card-hidden">
            <?php if( $medium_image ): ?>
                <img class="w-16 h-16 mb-1 rounded-full bg-black object-cover" src="<?php echo $medium_image; ?>" alt="<?php esc_html(the_title()); ?>'s quote">
            <?php endif; ?>

            <?php if( $quote ): ?>
            <div class="relative icon-quote">
                <p class="text-base leading-[1.32rem]"><?php echo esc_html($quote); ?></p>
                <?php if( get_the_title() ): ?>
                    <span class="block text-xs"><?php esc_html(the_title()); ?></span>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </li>
    <?php endwhile;?>
    </ul>
<?php wp_reset_postdata(); else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
