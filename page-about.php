<?php get_header(); ?>

<div class="about__fix">
    <!-- 縦書きタイトル -->
    <h2 class="fadein_3"><a href="<?php echo esc_url(home_url('/about/')); ?>">About</a></h2>
</div>

<section class="about__me">
    <div class="about__title fadein">
        <h3>わたしのこと</h3>
        <p>About me</p>
    </div>
    <div class="about__img fadein">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/about/about__moemiyake.jpg" alt="三宅萌の写真">
    </div>
    <div class="about__box">
        <div class="about__name fadein">
            <p class="about__name--ja">三宅 萌</p>
            <p class="about__name--en">Moe Miyake</p>
        </div>
        <div class="about__text">
            <?php
            while (have_posts()) : the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</section>

<section class="skill">
    <div class="about__title fadein">
        <h3>できること</h3>
        <p>I can do</p>
    </div>
    <!-- Swiper START -->
    <div class="swiper2 mySwiper2">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide skill__card">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/about/skill1_banner.png" alt="バナー製作" class="skill__img">
                <span class="skill__line"></span>
                <div class="skill__text">
                    <h4>バナー製作</h4>
                    <p>
                        訴求やペルソナに応じたバナーを制作します。サイズ展開やバリエーション展開も可能です。キャッチコピー制作も対応可能す。<br>(Figma,Canva,Photoshop)
                    </p>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide skill__card">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/about/skill_2_movie.png" alt="動画制作" class="skill__img">
                <span class="skill__line"></span>
                <div class="skill__text">
                    <h4>動画制作</h4>
                    <p>
                        運用広告用の動画を制作できます。モーショングラフィックの製作も可能です。(Canva,Figma Motion)
                    </p>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide skill__card">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/about/skill_3_webdesign-coding.png" alt="サイトデザイン・フロントエンドコーディング" class="skill__img">
                <span class="skill__line"></span>
                <div class="skill__text">
                    <h4>
                        サイトデザイン<br>
                        フロントエンドコーディング
                    </h4>
                    <p>
                        ウェブサイトのデザインから、HTML / CSS / JavaScript を用いた実装までワンストップで対応可能です。WordPress化も出来ます。
                    </p>
                </div>
            </div>
            <!-- Slide 4 -->
            <div class="swiper-slide skill__card">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/about/skill_4_kijilp.png" alt="記事型LP製作" class="skill__img">
                <span class="skill__line"></span>
                <div class="skill__text">
                    <h4>記事型LP製作</h4>
                    <p>
                        記事型LP用に執筆された原稿をもとにした画像製作・テキスト反映作業が出来ます。コーディングを用いた要素の追加や、更新管理も可能です。
                    </p>
                </div>
            </div>
            <!-- Slide 5 -->
            <div class="swiper-slide skill__card">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/about/skill_5_customai.png" alt="効率化ツールの作成" class="skill__img">
                <span class="skill__line"></span>
                <div class="skill__text">
                    <h4>
                        効率化ツールの作成<br>
                        (カスタムAI)
                    </h4>
                    <p>
                        カスタムAIにより、業務の効率化を実現。記事の表記ルールチェックや注釈一覧の自動生成を行う「レギュレーションチェッカー」を自作しました。(Claude,GoogleGemini)
                    </p>
                </div>
            </div>
            <!-- Slide 6 -->
            <div class="swiper-slide skill__card">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/about/skill_6_webapp.png" alt="Webアプリの開発" class="skill__img">
                <span class="skill__line"></span>
                <div class="skill__text">
                    <h4>
                        Webアプリの開発<br>
                        (AI活用)
                    </h4>
                    <p>
                        社内向けWebアプリ「コードジェネレーター」を開発。複雑なコードを書けないスタッフの業務支援や、UI設計から開発まで対応できます。<br>(Claude,Google Apps
                        Script)
                    </p>
                </div>
            </div>
            <!-- slide 7 -->
            <div class="swiper-slide skill__card">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/about/skill_7_lecture-manual.png" alt="レクチャー・マニュアル製作" class="skill__img">
                <span class="skill__line"></span>
                <div class="skill__text">
                    <h4>
                        レクチャー<br>
                        マニュアル製作
                    </h4>
                    <p>
                        レギュレーション用データベースの作成や、業務のマニュアル化も可能。レクチャー(業務とデザイン)も対応可能です。
                    </p>
                </div>
            </div>
        </div>

        <div class="swiper2-pagination"></div>
    </div>
    <!-- Swiper END -->
</section>

<!-- 保有資格 -->
<section class="certificate">
    <div class="about__title fadein">
        <h3>保有資格</h3>
        <p>Certificate</p>
    </div>

    <?php
    // 1行 = 1つの資格。行の途中の「//」は改行になる
    $certs = get_field('about_certificates');
    if ($certs) :
        $lines = preg_split('/\r\n|\r|\n/', trim($certs));
    ?>
        <ul>
            <?php foreach ($lines as $line) : if (trim($line) === '') continue; ?>
                <li><?php echo str_replace('//', '<br>', esc_html(trim($line))); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>

<?php get_footer(); ?>