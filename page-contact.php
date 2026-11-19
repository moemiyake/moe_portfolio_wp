<?php get_header(); ?>

<div class="contact__fix">
    <!-- 縦書きタイトル -->
    <h2 class="fadein_3"><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></h2>
</div>

<main class="contact__main">
    <section class="contact__box">
        <div class="contact__title fadein">
            <h3>お問い合わせ</h3>
            <p>Contact</p>
        </div>

        <p class="contact__lead">
            バナー・LP・Webサイト制作のご相談は、こちらのフォームからお気軽にお問い合わせください。
        </p>

        <ul class="contact__notes">
            <li>・「まだ決まっていないけれど相談したい」という段階でも大丈夫です。</li>
            <li>・2〜3日以内にメールにてご連絡します。</li>
            <li>・料金の目安は 「<a href="<?php echo esc_url(home_url('/service/')); ?>">料金・メニュー</a>」 をご覧ください。</li>
        </ul>

        <div class="contact__form">
            <iframe
                src="https://docs.google.com/forms/d/e/1FAIpQLSfHpErPbGLmav7m6eQMLHEtfpRExG6hHffg-YQQgyW8BArTlg/viewform?embedded=true"
                title="お問い合わせフォーム"
                width="640" height="744"
                frameborder="0" marginheight="0" marginwidth="0"
                loading="lazy">読み込んでいます…</iframe>
        </div>

        <p class="contact__privacy">
            いただいた情報は、お問い合わせへの返信と、ご依頼の対応のみに使用いたします。<br>
            詳しくは <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">プライバシーポリシー</a> をご覧ください。
        </p>
    </section>
</main>

<?php get_footer(); ?>
