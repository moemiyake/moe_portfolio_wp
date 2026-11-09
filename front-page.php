<?php get_header(); ?>

<!-- ローディング画面(最初の1回だけ) -->
<div id="loader" class="loader" aria-hidden="true">
    <!-- <img class="loader__plant" src="<?php echo get_template_directory_uri(); ?>/img/footer__pageTop--plant.svg" alt=""> -->
    <svg class="loader__plant" width="41" height="60" viewBox="0 0 41 60" fill="none" aria-hidden="true">
        <g class="loader__fill">
            <path d="M2 31.4258H20.0682H38.1364L30.7962 57.3987H9.3402L2 31.4258Z" fill="#F6CE72" />
            <path d="M20.0682 25.2147C21.3857 22.1722 26.392 16.087 35.8778 16.087C34.5604 20.1887 29.554 27.7565 20.0682 25.2147Z" fill="#AACF53" />
            <path d="M20.0682 25.2147C19.5036 22.1722 13.1158 16.087 4.08168 16.087C4.5 21.1802 10 25.6802 20.0682 25.2147Z" fill="#AACF53" />
            <path d="M20.0682 11.6636C19.1271 8.84046 14.5 2.18018 6.08168 3.19415C6.83452 6.97549 11.4858 13.9633 20.0682 11.6636Z" fill="#AACF53" />
            <path d="M20.0682 11.6636C21.3857 8.08762 25.392 1.38733 34.8778 3.19415C33.5604 7.07635 29.554 14.2053 20.0682 11.6636Z" fill="#AACF53" />
        </g>
        <path class="loader__line" pathLength="1" d="M20.0682 31.4258H2L9.3402 57.3987H30.7962L38.1364 31.4258H20.0682ZM20.0682 31.4258V25.2147M20.0682 11.6636C21.3857 8.08762 25.392 1.38733 34.8778 3.19415C33.5604 7.07635 29.554 14.2053 20.0682 11.6636ZM20.0682 11.6636C19.1271 8.84046 14.5 2.18018 6.08168 3.19415C6.83452 6.97549 11.4858 13.9633 20.0682 11.6636ZM20.0682 11.6636V25.2147M20.0682 25.2147C21.3857 22.1722 26.392 16.087 35.8778 16.087C34.5604 20.1887 29.554 27.7565 20.0682 25.2147ZM20.0682 25.2147C19.5036 22.1722 13.1158 16.087 4.08168 16.087C4.5 21.1802 10 25.6802 20.0682 25.2147Z" stroke="#37383C" stroke-width="1.12926" />
    </svg>
</div>
<script>
    // 2回目以降は、表示されるまえに消す(ちらつき防止)
    try {
        if (sessionStorage.getItem('moeLoaded')) document.getElementById('loader').remove();
    } catch (e) {}
</script>

<!-- FV -->
<section class="fv">
    <div class="fv__box">
        <div class="fv__nameBox">
            <!-- SVGにする -->
            <h1 class="fv__name fadein" style="font-family: 'Noto Serif JP', serif;">MOE MIYAKE</h1>
        </div>

        <div class="fv__illust">
            <!-- 屋根 -->
            <svg class="fv__roof" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none"
                aria-hidden="true" focusable="false">
                <polygon points="0,10 50,0 100,10" fill="#fff" />
            </svg>
            <!-- 煙突 -->
            <svg class="fv__chimney" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" preserveAspectRatio="none"
                aria-hidden="true" focusable="false">
                <rect width="10" height="10" fill="#fff" />
            </svg>
        </div>

        <!-- 吹き出し（煙突の上） -->
        <img class="fv__fog1" src="<?php echo get_template_directory_uri(); ?>/img/fv__fog_1.svg" alt="" aria-hidden="true">
        <img class="fv__fog2" src="<?php echo get_template_directory_uri(); ?>/img/fv__fog_2.svg" alt="" aria-hidden="true">

        <!-- 中央の吹き出し＋メッセージ -->
        <div class="fv__message">
            <img class="fv__message_img" src="<?php echo get_template_directory_uri(); ?>/img/fv__fog_3.svg" alt="" aria-hidden="true">
            <p class="fv__message_text">
                ご覧くださり<br>
                ありがとうございます。<br>
                “人の手で作る温かさ”を<br>
                大切にしながら<br>
                丁寧に制作します。
            </p>
        </div>
    </div>


</section>

<!-- Works -->
<section class="top__works">

    <h2 class="fadein">Works</h2>
    <!-- ☆Wordpressと連動して、最新情報を表示させたい。 -->
    <!-- Swiper -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php
            $works_query = new WP_Query(array(
                'post_type'      => 'works',
                'posts_per_page' => 7,
                'orderby'        => 'date',
                'order'          => 'ASC',
                'meta_query'     => array(
                    array(
                        'key'   => 'show_on_top',
                        'value' => '1',
                    ),
                ),
            ));
            if ($works_query->have_posts()) :
                while ($works_query->have_posts()) : $works_query->the_post();
                    $terms = get_the_terms(get_the_ID(), 'works_category');
                    $category_name = ($terms && !is_wp_error($terms)) ? $terms[0]->name : '';
            ?>
                    <div class="swiper-slide">
                        <a class="top__works__link" href="<?php the_permalink(); ?>">
                            <div class="top__works__image">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                            <div class="top__works__content">
                                <h3 class="top__works__title"><?php the_title(); ?></h3>
                                <p class="top__works__category"><?php echo esc_html($category_name); ?></p>
                            </div>
                        </a>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>



    <div class="top__works__more">
        <a class="button button--more" href="<?php echo home_url('/works/'); ?>">
            More
            <svg class="button__arrow" role="img" aria-label="もっと見る" xmlns="http://www.w3.org/2000/svg" width="57"
                height="6" viewBox="0 0 57 6" fill="none">
                <path d="M0 4.45806H55.4606L52.2609 0.347198" stroke="#3C3C3C" stroke-width="1" />
            </svg>
        </a>
    </div>
</section>

<!-- About -->
<section class="top__about">
    <h2 class="fadein">About</h2>
    <div class="about__box">
        <div class="about__img">
            <img src="<?php echo get_template_directory_uri(); ?>/img/about/about__moemiyake.jpg" alt="Profile Photo">
        </div>
        <div class="about__name">
            <p class="about__name--ja">三宅 萌</p>
            <p class="about__name--en">Moe Miyake</p>
        </div>
        <div class="about__text">
            <p>
                「コツコツやれば何でも作れる」という言葉をモットーに、丁寧かつスピーディに制作をします。<br>
                親しみやすさと、ユーザーの心を動かすデザイン制作を目指しています。
            </p>
            <p>
                特技は、小さな子供と仲良くなること。
            </p>
        </div>
    </div>
    <div class="top__about__more">
        <a class="button button--more" href="<?php echo home_url('/about/'); ?>">
            More
            <svg class="button__arrow" role="img" aria-label="もっと見る" xmlns="http://www.w3.org/2000/svg" width="57"
                height="6" viewBox="0 0 57 6" fill="none">
                <path d="M0 4.45806H55.4606L52.2609 0.347198" stroke="#3C3C3C" stroke-width="1" />
            </svg>
        </a>
    </div>
</section>

<?php get_footer(); ?>