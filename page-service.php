<?php get_header(); ?>

<div class="contact__fix">
    <!-- 縦書きタイトル -->
    <h2 class="fadein_3"><a href="<?php echo esc_url(home_url('/service/')); ?>">Service</a></h2>
</div>

<main class="contact__main">
    <section class="contact__box">
        <div class="contact__title fadein">
            <h3>料金・メニュー</h3>
            <p>Service</p>
        </div>

        <p class="price__lead">
            ハンドメイド作家さんや、小さなお店におすすめのサービスです。<br>
            「どれを選べばいいかわからない」という場合も、お気軽にご相談ください。
        </p>

        <!-- バナー -->
        <div class="price__group fadein">
            <h4 class="price__heading">バナー</h4>
            <dl class="price__list">
                <div class="price__item">
                    <dt>バナー 1点<span>1サイズ・修正2回まで</span></dt>
                    <dd>5,000<small>円</small></dd>
                </div>
                <div class="price__item">
                    <dt>サイズ展開<span>2サイズ目以降、1サイズごと</span></dt>
                    <dd>+1,500<small>円</small></dd>
                </div>
                <div class="price__item">
                    <dt>バナー 3点セット<span>イベント告知・新作・セールなど</span></dt>
                    <dd>13,500<small>円</small></dd>
                </div>
            </dl>
        </div>

        <!-- 作家さんパック -->
        <div class="price__group price__group--pick fadein">
            <h4 class="price__heading">作家さんパック</h4>
            <dl class="price__list">
                <div class="price__item">
                    <dt>ショップ画像＋<wbr><b class="price__nowrap">Instagram投稿画像3枚</b><span>minne・Creemaのショップ画像と、SNS用の画像をまとめて</span></dt>
                    <dd>15,000<small>円</small></dd>
                </div>
            </dl>
            <p class="price__badge"><span>作家さんに</span><span>おすすめ</span></p>
        </div>

        <!-- LP・サイト -->
        <div class="price__group fadein">
            <h4 class="price__heading">LP・Webサイト</h4>
            <dl class="price__list">
                <div class="price__item">
                    <dt>LPデザイン<span>デザインのみ（Figmaで納品）</span></dt>
                    <dd>30,000<small>円〜</small></dd>
                </div>
                <div class="price__item">
                    <dt>LP制作<span>デザイン＋コーディング</span></dt>
                    <dd>50,000<small>円〜</small></dd>
                </div>
                <div class="price__item">
                    <dt>小さなサイト<span>3〜5ページ、WordPress化もできます</span></dt>
                    <dd>100,000<small>円〜</small></dd>
                </div>
            </dl>
        </div>

        <p class="price__note">※ 価格はすべて税込です。「〜」のメニューは、内容をうかがってからお見積もりします。</p>

        <!-- ご依頼の流れ -->
        <div class="price__group fadein">
            <h4 class="price__heading">ご依頼の流れ</h4>
            <ol class="price__flow">
                <li>
                    <span class="price__flowNum">1</span>
                    <p class="price__flowBody"><b>お問い合わせ</b>フォームから、作りたいものを教えてください。</p>
                </li>
                <li>
                    <span class="price__flowNum">2</span>
                    <p class="price__flowBody"><b>ご相談・お見積もり</b>作品やお店の雰囲気、使う場所を伺い、金額と納期をお伝えします。</p>
                </li>
                <li>
                    <span class="price__flowNum">3</span>
                    <p class="price__flowBody"><b>制作</b>デザイン案をお送りします。</p>
                </li>
                <li>
                    <span class="price__flowNum">4</span>
                    <p class="price__flowBody"><b>修正</b>気になるところを一緒に直します。</p>
                </li>
                <li>
                    <span class="price__flowNum">5</span>
                    <p class="price__flowBody"><b>納品</b>使いやすい形式でお渡しします。</p>
                </li>
            </ol>
        </div>

        <div class="price__cta">
            <a class="price__button" href="<?php echo esc_url(home_url('/contact/')); ?>">お問い合わせはこちら</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
