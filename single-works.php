<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <?php
    // 作品ごとに変わる内容（ACFで入力したもの）
    $terms    = get_the_terms(get_the_ID(), 'works_category');
    $desc     = get_field('works_description');
    $sub_img  = get_field('works_sub_image');
    $target   = get_field('works_target');
    $issue    = get_field('works_issue');
    $concept  = get_field('works_concept');
    $p_design = get_field('works_period_design');
    $p_coding = get_field('works_period_coding');
    $tools    = get_field('works_tools');
    $url      = get_field('works_url');
    ?>

    <div class="works__fix">
        <!-- 縦書きタイトル -->
        <h2 class="fadein_3"><a href="<?php echo esc_url(home_url('/works/')); ?>">Works</a></h2>
    </div>

    <div class="worksItem__container fadein_2">

        <!-- 各作品のFV -->
        <!-- pcでは左に固定 -->
        <div class="worksItem__fixLeft">
            <?php echo moe_plain_img(get_post_thumbnail_id(), '', 'full'); ?>
        </div>

        <!-- 説明文と挿絵 -->
        <!-- pcでは右に固定 -->
        <div class="worksItem__fixRight">
            <section class="worksFv__container">
                <div class="worksFv__title">
                    <!-- タイトル -->
                    <h3 class="worksFv__name">
                        <?php the_title(); ?>
                    </h3>
                    <!-- カテゴリーリンク -->
                    <?php if ($terms && !is_wp_error($terms)) : ?>
                        <div class="worksFv__category">
                            <ul>
                                <?php foreach ($terms as $term) : ?>
                                    <li><a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- 説明文 -->
                <?php if ($desc) : ?>
                    <p class="worksFv__text">
                        <?php echo nl2br(esc_html($desc)); ?>
                    </p>
                <?php endif; ?>
            </section>

            <?php if ($sub_img) : ?>
                <section class="worksImg">
                    <?php echo moe_plain_img($sub_img, 'worksImg__img', 'full'); ?>
                </section>
            <?php endif; ?>

            <!-- プロジェクト情報（入力のある項目だけ表示） -->
            <?php if ($target || $issue || $concept || $p_design || $p_coding || $tools || $url) : ?>
                <section class="project">
                    <dl>
                        <?php if ($target) : ?>
                            <!-- ターゲット -->
                            <div class="project__container">
                                <dt class="project__title">ターゲット</dt>
                                <dd class="project__text">
                                    <?php echo nl2br(esc_html($target)); ?>
                                </dd>
                            </div>
                        <?php endif; ?>

                        <?php if ($issue) : ?>
                            <!-- 課題 -->
                            <div class="project__container">
                                <dt class="project__title">課題</dt>
                                <dd class="project__text">
                                    <?php echo nl2br(esc_html($issue)); ?>
                                </dd>
                            </div>
                        <?php endif; ?>

                        <?php if ($concept) : ?>
                            <!-- デザインコンセプト -->
                            <div class="project__container">
                                <dt class="project__title">デザインコンセプト</dt>
                                <dd class="project__text">
                                    <?php echo nl2br(esc_html($concept)); ?>
                                </dd>
                            </div>
                        <?php endif; ?>

                        <?php if ($p_design || $p_coding) : ?>
                            <!-- 制作期間 -->
                            <div class="project__container">
                                <dt class="project__title">制作期間</dt>
                                <dd class="project__text">
                                    <?php if ($p_design) : ?>
                                        <dl>
                                            <dt>デザイン</dt>
                                            <dd><?php echo esc_html($p_design); ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                    <?php if ($p_coding) : ?>
                                        <dl>
                                            <dt>コーディング</dt>
                                            <dd><?php echo esc_html($p_coding); ?></dd>
                                        </dl>
                                    <?php endif; ?>
                                </dd>
                            </div>
                        <?php endif; ?>

                        <?php if ($tools) : ?>
                            <!-- 使用ツール -->
                            <div class="project__container">
                                <dt class="project__title">使用ツール</dt>
                                <dd class="project__text">
                                    <?php echo esc_html($tools); ?>
                                </dd>
                            </div>
                        <?php endif; ?>

                        <?php if ($url) : ?>
                            <!-- URL(あれば) -->
                            <div class="project__container">
                                <dt class="project__title">URL</dt>
                                <dd class="project__text">
                                    <a href="<?php echo esc_url($url); ?>" target="_blank"
                                        rel="noopener noreferrer"><?php echo esc_html($url); ?></a>
                                </dd>
                            </div>
                        <?php endif; ?>

                    </dl>
                </section>
            <?php endif; ?>
        </div>
    </div>

<?php endwhile; ?>

<!-- Exhibition (制作実績スライダー) -->
<section class="exhibition" aria-labelledby="exhibition-title">
    <div class="exhibition__header">
        <h3 class="exhibition__title fadein" id="exhibition-title">Works</h3>
    </div>

    <!-- Swiper START -->
    <section class="exhibition__showcase swiper mySwiper3" aria-label="制作実績" tabindex="0">
        <div class="exhibition__track swiper-wrapper">

            <?php
            // 登録されている作品を、古い順にすべて並べる
            $exhibition_query = new WP_Query(array(
                'post_type'      => 'works',
                'posts_per_page' => -1,
                'orderby'        => 'date',
                'order'          => 'ASC',
            ));
            if ($exhibition_query->have_posts()) :
                while ($exhibition_query->have_posts()) : $exhibition_query->the_post();
                    $ex_terms = get_the_terms(get_the_ID(), 'works_category');
                    $ex_category = ($ex_terms && !is_wp_error($ex_terms)) ? $ex_terms[0]->name : '';
            ?>
                    <article class="exhibition__card swiper-slide">
                        <a class="exhibition__cardLink" href="<?php the_permalink(); ?>">
                            <span class="exhibition__cardImageWrap">
                                <?php echo moe_plain_img(get_post_thumbnail_id(), 'exhibition__cardImage', 'medium'); ?>
                            </span>
                            <div class="exhibition__cardContent">
                                <h4 class="exhibition__cardTitle"><?php the_title(); ?></h4>
                                <p class="exhibition__cardCategory"><?php echo esc_html($ex_category); ?></p>
                            </div>
                        </a>
                    </article>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>

        </div>

        <!-- 枠(CSSで作成。幅が変わっても台形が崩れない) -->
        <div class="exhibition__frame" aria-hidden="true">
            <span class="exhibition__frameTop"></span>
            <span class="exhibition__frameBottom"></span>
            <span class="exhibition__frameLeft"></span>
            <span class="exhibition__frameRight"></span>
        </div>
        <!-- 植木鉢 -->
        <img class="exhibition__plant" src="<?php echo get_template_directory_uri(); ?>/img/exhibition__plant.svg" alt="" aria-hidden="true">
    </section>
    <!-- Swiper END -->

    <!-- More (トップページと同じボタンを使用) -->
    <div class="exhibition__more">
        <a class="button button--more" href="<?php echo esc_url(home_url('/works/')); ?>" aria-label="制作実績をもっと見る">
            More
            <svg class="button__arrow" role="img" aria-label="もっと見る" xmlns="http://www.w3.org/2000/svg" width="57"
                height="6" viewBox="0 0 57 6" fill="none">
                <path d="M0 4.45806H55.4606L52.2609 0.347198" stroke="#3C3C3C" stroke-width="1" />
            </svg>
        </a>
    </div>
</section>

<?php get_footer(); ?>