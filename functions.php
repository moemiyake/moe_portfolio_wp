<?php
function moe_portfolio_assets()
{
    $dir = get_template_directory();
    $uri = get_template_directory_uri();

    wp_enqueue_style('moe-style', $uri . '/css/style.css', array(), filemtime($dir . '/css/style.css'));

    if (is_front_page()) {
        wp_enqueue_style('moe-top', $uri . '/css/top.css', array('moe-style'), filemtime($dir . '/css/top.css'));
    }

    if (is_page('works') || is_tax('works_category')) {
        wp_enqueue_style('moe-works', $uri . '/css/works.css', array('moe-style'), filemtime($dir . '/css/works.css'));
    }

    if (is_page('about')) {
        wp_enqueue_style('moe-about', $uri . '/css/about.css', array('moe-style'), filemtime($dir . '/css/about.css'));
    }

    if (is_page('contact') || is_page('privacy-policy') || is_page('service')) {
        wp_enqueue_style('moe-contact', $uri . '/css/contact.css', array('moe-style'), filemtime($dir . '/css/contact.css'));
    }

    wp_enqueue_script('moe-script', $uri . '/js/script.js', array(), filemtime($dir . '/js/script.js'), true);
}
add_action('wp_enqueue_scripts', 'moe_portfolio_assets');


// 作品（カスタム投稿タイプ）とカテゴリー
function moe_portfolio_register_works()
{
    register_post_type('works', array(
        'labels' => array(
            'name' => '作品',
            'singular_name' => '作品',
            'add_new_item' => '新しい作品を追加',
            'edit_item' => '作品を編集',
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'work'),
        'menu_icon' => 'dashicons-portfolio',
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    ));

    register_taxonomy('works_category', 'works', array(
        'labels' => array(
            'name' => '作品カテゴリー',
            'singular_name' => '作品カテゴリー',
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'works-category'),
    ));
}
add_action('init', 'moe_portfolio_register_works');

// アイキャッチ画像を使えるようにする
function moe_portfolio_setup()
{
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'moe_portfolio_setup');


// 余計な width/height を付けない img を出力する
function moe_plain_img($id, $class = '', $size = 'full')
{
    if (!$id) return '';
    $src = wp_get_attachment_image_url($id, $size);
    if (!$src) return '';
    $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
    if ($alt === '') $alt = get_the_title($id);
    $class_attr = $class ? ' class="' . esc_attr($class) . '"' : '';
    return '<img' . $class_attr . ' src="' . esc_url($src) . '" alt="' . esc_attr($alt) . '">';
}

// 端が白くてサイトの背景と同化してしまう作品（タイトルで指定）
// ここに作品タイトルを足すと、その作品の画像に薄いグレーの枠線がつく
function moe_works_has_border($post_id = null)
{
    $titles = array('Buon appetito!', 'ポートフォリオ');
    return in_array(trim(get_the_title($post_id)), $titles, true);
}

// 枠線が必要な作品なら 'has-border' を返す（class に足して使う）
function moe_works_border_class($post_id = null)
{
    return moe_works_has_border($post_id) ? 'has-border' : '';
}

// 作品詳細ページだけ works-item.css を読み込む
add_action('wp_enqueue_scripts', function () {
    if (is_singular('works')) {
        wp_enqueue_style(
            'moe-works-item',
            get_template_directory_uri() . '/css/works-item.css',
            array('moe-style'), // ← style.css を読み込んでいるハンドル名に合わせた
            filemtime(get_template_directory() . '/css/works-item.css')
        );
    }
});


// ページごとのタイトル(例: Moemiyake Portfolio | Works)
add_filter('pre_get_document_title', function ($title) {
    $site = 'Moemiyake Portfolio';

    if (is_front_page())              return $site . ' | Top';
    if (is_page('works'))             return $site . ' | Works';
    if (is_tax('works_category'))     return $site . ' | Works | ' . single_term_title('', false);
    if (is_page('about'))             return $site . ' | About';
    if (is_page('service'))             return $site . ' | Service';
    if (is_page('contact'))           return $site . ' | Contact';
    if (is_page('privacy-policy'))    return $site . ' | プライバシーポリシー';
    if (is_singular('works'))         return $site . ' | ' . get_the_title();
    if (is_singular())               return $site . ' | ' . get_the_title();
    if (is_404())                    return $site . ' | ページが見つかりません';
    if (is_search())                 return $site . ' | 検索結果';

    return $title;
});

// サイトマップから、ユーザー(投稿者)のURLを外す
add_filter('wp_sitemaps_add_provider', function ($provider, $name) {
    return ($name === 'users') ? false : $provider;
}, 10, 2);