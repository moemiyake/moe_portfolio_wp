<?php
// 作品一覧（Works）の中身。page-works.php と taxonomy-works_category.php の両方から使う
$current_term = is_tax('works_category') ? get_queried_object() : null;
$paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));

$args = array(
    'post_type'      => 'works',
    'posts_per_page' => 8, // 1ページに表示する作品数
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC', // 新しい作品が先頭
);
if ($current_term) {
    $args['tax_query'] = array(array(
        'taxonomy' => 'works_category',
        'field'    => 'term_id',
        'terms'    => $current_term->term_id,
    ));
}
$works_list = new WP_Query($args);
$all_terms  = get_terms(array('taxonomy' => 'works_category', 'hide_empty' => true));
?>

    <div class="works__fix">
        <!-- 縦書きタイトル -->
        <h2 class="fadein_3"><a href="<?php echo esc_url(home_url('/works/')); ?>">Works</a></h2>
        <div class="works__headerCategory fadein_3">
            <ul>
                <li><a href="<?php echo esc_url(home_url('/works/')); ?>"<?php echo $current_term ? '' : ' class="is-current"'; ?>>All</a></li>
                <?php if ($all_terms && !is_wp_error($all_terms)) : foreach ($all_terms as $t) : ?>
                <li><a href="<?php echo esc_url(get_term_link($t)); ?>"<?php echo ($current_term && $current_term->term_id === $t->term_id) ? ' class="is-current"' : ''; ?>><?php echo esc_html($t->name); ?></a></li>
                <?php endforeach; endif; ?>
            </ul>
        </div>
    </div>

    <section>
        <?php if ($works_list->have_posts()) : while ($works_list->have_posts()) : $works_list->the_post();
            $w_terms = get_the_terms(get_the_ID(), 'works_category');
            $w_cat   = ($w_terms && !is_wp_error($w_terms)) ? $w_terms[0]->name : '';
        ?>
        <div class="works__container fadein_2">
            <a href="<?php the_permalink(); ?>"><?php echo moe_plain_img(get_post_thumbnail_id(), '', 'large'); ?></a>
            <div class="works__content">
                <h3 class="works__title">
                    <?php the_title(); ?>
                </h3>
                <p class="works__category">
                    <?php echo esc_html($w_cat); ?>
                </p>
            </div>
        </div>
        <?php endwhile; wp_reset_postdata(); else : ?>
        <p>作品がまだありません。</p>
        <?php endif; ?>
    </section>

    <?php if ($works_list->max_num_pages > 1) : $total = $works_list->max_num_pages; ?>
    <nav>
        <div class="works__pagination">
            <?php if ($paged > 1) : ?>
            <a href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>">&laquo;</a>
            <?php else : ?>
            <span aria-hidden="true">&laquo;</span>
            <?php endif; ?>

            <div class="works__pagination--number">
                <?php for ($i = 1; $i <= $total; $i++) : ?>
                <a href="<?php echo esc_url(get_pagenum_link($i)); ?>"<?php echo $i === $paged ? ' class="is-current" aria-current="page"' : ''; ?>><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>

            <?php if ($paged < $total) : ?>
            <a href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>">&raquo;</a>
            <?php else : ?>
            <span aria-hidden="true">&raquo;</span>
            <?php endif; ?>
        </div>
    </nav>
    <?php endif; ?>
