
<?php
$advert_posts = get_field('advert');
$advert_lenght = count($advert_posts);
// echo '<pre>';
// var_dump($advert_items);
// echo '</pre>';
?>
<div class="kb-advanced-slider kb-advanced-slider-1809_3b317c-04 wp-block-kadence-slider">
    <div class="kb-advanced-slider-inner-contain kb-adv-slider-html-version-2">
        <div class="kb-blocks-advanced-carousel kt-blocks-carousel kt-carousel-container-dotstyle-dark">
            <div class="kb-blocks-advanced-slider-init kb-slider-loading kb-blocks-slider kt-carousel-arrowstyle-whiteondark kt-carousel-dotstyle-dark kb-slider-size-fixed kb-slider-ratio-16-9 kb-slider-tab-ratio-inherit kb-slider-mobile-ratio-inherit splide kb-splide splide-initial is-overflow is-initialized splide--fade splide--ltr splide--draggable is-active" 
                    data-slider-anim-speed="400" 
                    data-slider-type="slider" 
                    data-slider-scroll="1" 
                    data-slider-fade="true" 
                    data-slider-arrows="true" 
                    data-slider-dots="true" 
                    data-slider-hover-pause="false" 
                    data-slider-auto="true" 
                    data-dragging="true" 
                    data-slider-speed="7000" 
                    id="splide01" 
                    role="region" 
                    aria-roledescription="carousel">
                <div class="splide__arrows splide__arrows--ltr">
                    <button class="splide__arrow splide__arrow--prev slick-prev" type="button" aria-label="Go to last slide" aria-controls="splide01-track">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40" focusable="false">
                            <path d="m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z"></path>
                        </svg>
                    </button>
                    <button class="splide__arrow splide__arrow--next slick-next" type="button" aria-label="Next slide" aria-controls="splide01-track">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40" focusable="false">
                            <path d="m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z"></path>
                        </svg>
                    </button>
                </div>
                <div class="splide__track splide__track--fade splide__track--ltr splide__track--draggable" 
                    id="splide01-track" 
                    aria-live="off" 
                    aria-atomic="true" 
                    style="padding-left: 0px; padding-right: 0px;" 
                    aria-busy="false">
                    <div class="splide__list" id="splide01-list" role="presentation">
                        <?php
                            if ($advert_posts) {
                                $count = 1;
                                $count_str = str_pad($count, 2, '0', STR_PAD_LEFT);
                                foreach ($advert_posts as $post) {
                                    setup_postdata($post); 
                                    ?>
                                    <div class="wp-block-kadence-slide kb-advanced-slide-item kb-slide-<?php echo $count_str ?> splide__slide is-active is-visible" 
                                        id="splide01-slide<?php echo $count_str ?>" 
                                        role="tabpanel" 
                                        aria-roledescription="slide" 
                                        aria-label="<?php echo $count_str ?> of $advert_lenght " 
                                        style="margin-right: 0px; width: calc(100% + 0px); transform: translateX(0%); transition: opacity 400ms cubic-bezier(0.25, 1, 0.5, 1) 0s;">
                                        <div class="kb-advanced-slide">
                                            <div class="kb-advanced-slide-inner-wrap">
                                                <div class="kb-advanced-slide-inner">
                                                    <div><?php the_content(); ?></div>
                                                    <a href="<?php the_permalink($post->ID); ?>" aria-label="Click here for <?php the_title(); ?>" tabindex="0"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                }
                                wp_reset_postdata(); // Reset the global post object
                            }
                            ?>
                </div>
            </div>
        </div>
    </div>
</div>
<ul class="splide__pagination slick-dots splide__pagination--ltr" role="tablist" aria-label="Select a slide to show"><li role="presentation"><button class="splide__pagination__page is-active" type="button" role="tab" aria-controls="splide01-slide01" aria-label="Go to slide 1" aria-selected="true"></button></li><li role="presentation"><button class="splide__pagination__page" type="button" role="tab" aria-controls="splide01-slide02" aria-label="Go to slide 2" tabindex="-1"></button></li></ul></div></div></div></div>