<?php get_header(); ?>

<section class="notFound">
    <img class="notFound__image" src="<?php echo get_template_directory_uri(); ?>/img/404__sorry.svg" alt="sorry...">
    <h1 class="notFound__title">ページが見つかりませんでした</h1>
    <p class="notFound__text">
        お探しのページは、移動または削除された<br>
        可能性があります。<br>
        トップページからお探しください。
    </p>
    <a class="button button--more" href="<?php echo home_url('/'); ?>">
        Top
        <svg class="button__arrow" role="img" aria-label="トップへ戻る" xmlns="http://www.w3.org/2000/svg" width="57"
            height="6" viewBox="0 0 57 6" fill="none">
            <path d="M0 4.45806H55.4606L52.2609 0.347198" stroke="#3C3C3C" stroke-width="1" />
        </svg>
    </a>
</section>

<?php get_footer(); ?>