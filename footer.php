    <!-- Footer -->
    <footer class="footer">
        <div class="footer__head">
            <!-- 植木鉢(ページ先頭に戻る) -->
            <a class="footer__pageTop" href="#">
                <img class="footer__pageTop--plant" src="<?php echo get_template_directory_uri(); ?>/img/footer__pageTop--plant.svg" alt="ページ先頭に戻る">
                <img class="footer__pageTop-arrow" src="<?php echo get_template_directory_uri(); ?>/img/footer__pageTop-arrow.svg" alt="" aria-hidden="true">

            </a>
            <!-- ナビゲーション -->
            <div class="footer__list">
                <ul>
                    <li><a href="<?php echo home_url('/'); ?>">Top</a></li>
                    <li><a href="<?php echo home_url('/works/'); ?>">Works</a></li>
                    <li><a href="<?php echo home_url('/about/'); ?>">About</a></li>
                </ul>
            </div>
        </div>
        <!-- コピーライト -->
        <a class="footer__privacy" href="<?php echo home_url('/privacy-policy/'); ?>">プライバシーポリシー</a>
        <small class="footer__copyright">© 2026 Moe Miyake</small>
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <?php wp_footer(); ?>
    </body>

    </html>