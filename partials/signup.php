<?php
$signup = get_field('newsletter_signup');
if( $signup ): ?>
    <div class="py-6 lg:py-0">
        <div class="lg:h-full pt-4 pb-6 lg:py-[73px] px-6 lg:px-[50px] flex flex-col justify-center bg-white">
            <div class="max-w-[400px]">
                <h1 class="text-2xl font-medium font-title md:text-4xl mb-3"><?php echo $signup['newsletter_title']; ?></h1>
                <p class="mb-[18px]"><?php echo esc_html( $signup['newsletter_description'] ); ?></p>
                <button id="js-open-form" class="mt-3.5 md:mt-[30px] rounded-full bg-gray px-8 py-3 font-semibold"><?php echo esc_html( $signup['newsletter_button_label'] ); ?></button>
            </div>
            <div id="js-form" class="hidden opacity-0 transition duration-200 ease-in">
                <?php echo apply_shortcodes( '[contact-form-7 id="77" title="Newsletter Form"]' ); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
