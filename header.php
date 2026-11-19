<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Moemiyake Portfolio | Top</title> -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/destyle.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <?php wp_head(); ?>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Noto+Sans+JP:wght@100..900&family=Noto+Serif+JP:wght@200..900&display=swap"
        rel="stylesheet">

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PR5NB2P3');
    </script>
    <!-- End Google Tag Manager -->
</head>

<?php
$body_class = is_front_page() ? 'top' : (is_singular('works') ? 'worksItem' : ((is_page('works') || is_tax('works_category')) ? 'works' : (is_page('about') ? 'about' : (is_page('service') ? 'service' : (is_page('contact') ? 'contact' : (is_page('privacy-policy') ? 'policy' : ''))))));
?>

<body class="<?php echo esc_attr($body_class); ?>" id="top">
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PR5NB2P3" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->

    <header>
        <!-- SP -->
        <!-- ハンバーガー -->
        <button class="header__hamburger header__hamburger--sp" type="button" aria-label="メニューを開く" aria-expanded="false"
            aria-controls="sp-navigation">
            <span></span>
            <!-- <span></span> -->
        </button>
        <!-- カード -->
        <nav class="header__list header__list--sp" id="sp-navigation" aria-label="メインナビゲーション" aria-hidden="true" inert>
            <ul>
                <li><a href="<?php echo home_url('/'); ?>">Top</a></li>
                <li><a href="<?php echo home_url('/works/'); ?>">Works</a></li>
                <li><a href="<?php echo home_url('/about/'); ?>">About</a></li>
                <!-- Service は一旦非表示（ページは残している） -->
                <!-- <li><a href="<?php echo home_url('/service/'); ?>">Service</a></li> -->
                <li><a href="<?php echo home_url('/contact/'); ?>">Contact</a></li>
            </ul>
            <h1 class="header__name">MOE MIYAKE</h1>
        </nav>

        <!-- PC -->
        <nav class="header__list header__list--pc">
            <ul>
                <li><a href="<?php echo home_url('/'); ?>">Top</a></li>
                <li><a href="<?php echo home_url('/works/'); ?>">Works</a></li>
                <li><a href="<?php echo home_url('/about/'); ?>">About</a></li>
                <!-- Service は一旦非表示（ページは残している） -->
                <!-- <li><a href="<?php echo home_url('/service/'); ?>">Service</a></li> -->
                <li><a href="<?php echo home_url('/contact/'); ?>">Contact</a></li>
            </ul>
        </nav>
    </header>