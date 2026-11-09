// ハンバーガーメニュー
const header = document.querySelector('header');
const hamburger = document.querySelector('.header__hamburger');
const mobileNavigation = document.querySelector('.header__list--sp');

if (header && hamburger && mobileNavigation) {
  const setMenuOpen = (isOpen) => {
    header.classList.toggle('is-open', isOpen);
    hamburger.setAttribute('aria-expanded', String(isOpen));
    hamburger.setAttribute('aria-label', isOpen ? 'メニューを閉じる' : 'メニューを開く');
    mobileNavigation.setAttribute('aria-hidden', String(!isOpen));
    mobileNavigation.inert = !isOpen;
  };

  hamburger.addEventListener('click', () => {
    setMenuOpen(hamburger.getAttribute('aria-expanded') !== 'true');
  });

  mobileNavigation.addEventListener('click', (event) => {
    const link = event.target.closest('a');
    if (!link) return;

    event.preventDefault();   // すぐ移動するのを止める
    setMenuOpen(false);       // メニューを閉じる
    setTimeout(() => {
      window.location.href = link.href;   // 閉じたあとに移動する
    }, 600);                  // 閉じる動きの長さ(ms)に合わせる
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && hamburger.getAttribute('aria-expanded') === 'true') {
      setMenuOpen(false);
      hamburger.focus();
    }
  });
}


// Swiper 1
document.querySelectorAll('.top__works .mySwiper .top__works__image').forEach((frame) => {
  const image = frame.querySelector('img');
  if (image) {
    frame.style.setProperty('--works-slide-image', `url("${image.src}")`);
  }
});

var swiper = new Swiper('.mySwiper', {
  effect: 'coverflow',
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: 1.5,
  loop: true,
  breakpoints: {
    768: {
      slidesPerView: 2.1,
      spaceBetween: 50,
      coverflowEffect: {
        rotate: 12,
        depth: 80,
      },
    },
    1024: {
      slidesPerView: 2.1,
      spaceBetween: 100,
      coverflowEffect: {
        rotate: 8,
        depth: 80,
      },
    },
  },
  coverflowEffect: {
    rotate: 50,
    stretch: 0,
    depth: 100,
    modifier: 1,
    slideShadows: true,
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
});


// 「動きを減らす」設定の人にはアニメーションを止める
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;


// Swiper 2
var swiper2 = new Swiper('.mySwiper2', {
  effect: 'cards',
  grabCursor: true,
  speed: prefersReducedMotion ? 0 : 700, // めくる速さ(ms)。初期値300より少しゆっくり
  cardsEffect: {
    rotate: true,
    perSlideOffset: 6, // 後ろのカードをずらす量(初期値8)
    perSlideRotate: window.innerWidth >= 1024 ? 1.5 : 3, // 後ろのカードを傾ける角度(初期値2)。PCは横長なので控えめに
    slideShadows: false, // 黒い影を消して、カードの縁取りで重なりを見せる
  },
  keyboard: { enabled: true }, // 矢印キーでもめくれる
  pagination: {
    el: '.swiper2-pagination',
    clickable: true,
  },
});


// // Exhibition(single-works.php の制作実績スライダー)
// // カードが少ないとSwiperのループが無効になって止まるため、カードを2セットに増やしておく
// const exhibitionTrack = document.querySelector('.mySwiper3 .swiper-wrapper');
// if (exhibitionTrack) {
//   exhibitionTrack.innerHTML += exhibitionTrack.innerHTML;
// }



// // Swiper 3
// var swiper3 = new Swiper('.mySwiper3', {
//   loop: true,
//   slidesPerView: 'auto',
//   spaceBetween: 20,
//   speed: window.innerWidth >= 1024 ? 3000 : 5000,
//   grabCursor: true,                                // ← 追加(マウスを乗せると「つかめる」手の形になる)
//   freeMode: { enabled: true, momentum: true, momentumRatio: 1, momentumBounce: false }, // ← 追加(好きな位置で止められる)
//   autoplay: { delay: 0, disableOnInteraction: false },
// });

// Exhibition(制作実績スライダー)
// 一定の速さで流れ続ける。ドラッグで動かせて、離すとなめらかに元の速さへ戻る
const exhibitionTrack = document.querySelector('.mySwiper3 .swiper-wrapper');
if (exhibitionTrack) {
  // カードを増やして、端でつなぎ目が見えないようにする(1セットが画面より広くなるように、3セット並べる)
  const cardCount = exhibitionTrack.children.length;
  const showcaseWidth = exhibitionTrack.parentElement.offsetWidth;
  const repeatInSet = Math.max(1, Math.ceil(showcaseWidth / (cardCount * 200))); // 200 = カード幅180 + 間隔20
  exhibitionTrack.innerHTML = exhibitionTrack.innerHTML.repeat(repeatInSet * 3);

  var swiper3 = new Swiper('.mySwiper3', {
    slidesPerView: 'auto', // カード幅はCSS(180px)のまま
    spaceBetween: 20,
    grabCursor: true,
    freeMode: { enabled: true, momentum: false },
  });

  const setWidth = (swiper3.slides[cardCount * repeatInSet].offsetLeft - swiper3.slides[0].offsetLeft);
  const FLOW_SPEED = window.innerWidth >= 1024 ? -0.067 : -0.04; // 流れる速さ(px/ms)。マイナスで左へ流れる
  const EASE_TIME = 700; // 元の速さに戻るまでの目安(ms)。大きいほどゆっくり戻る

  let velocity = FLOW_SPEED;
  let isDragging = false;
  let lastFrame = performance.now();
  let lastX = 0;
  let lastTime = 0;

  swiper3.setTransition(0);
  swiper3.setTranslate(-setWidth); // 真ん中のセットから始める

  // ドラッグ中の速さを測っておき、離した瞬間の勢いにする
  swiper3.on('touchStart', () => {
    isDragging = true;
    velocity = 0;
    lastX = swiper3.getTranslate();
    lastTime = performance.now();
  });
  swiper3.on('touchMove', () => {
    const now = performance.now();
    const x = swiper3.getTranslate();
    if (now > lastTime) velocity = velocity * 0.5 + ((x - lastX) / (now - lastTime)) * 0.5;
    lastX = x;
    lastTime = now;
  });
  swiper3.on('touchEnd', () => {
    isDragging = false;
    velocity = Math.max(-3, Math.min(3, velocity));
  });

  // 毎フレーム、勢いを少しずつ「流れる速さ」に近づけながら動かす
  const flow = (now) => {
    const dt = Math.min(now - lastFrame, 50);
    lastFrame = now;
    if (!isDragging) {
      velocity += (FLOW_SPEED - velocity) * (1 - Math.exp(-dt / EASE_TIME));
      let x = swiper3.getTranslate() + velocity * dt;
      // 1セットぶん進んだら元に戻す(同じ見た目なので、つなぎ目は見えない)
      if (x < -2 * setWidth) x += setWidth;
      else if (x > -setWidth) x -= setWidth;
      swiper3.setTransition(0);
      swiper3.setTranslate(x);
    }
    requestAnimationFrame(flow);
  };
  if (!prefersReducedMotion) requestAnimationFrame(flow);
}


// --- .fadein 設定 ---

// ロボットにやって欲しい事を設定
const animateFade = (entries, obs) => {
  // console.log('じゅわっ');

  entries.forEach((entry) => {
    if (entry.isIntersecting) {

      entry.target.animate(
        {
          opacity: [0, 1],
          filter: ['blur(1rem)', 'blur(0)'],
        },
        {
          duration: 1200,
          easing: 'ease',
          fill: 'forwards',
        }
      );

      // 一回ふわっとさせたら、監視の対象外にする。
      obs.unobserve(entry.target);
    }
  });

};

const options = {
  threshold: 0.9,
};

// 監視ロボット fadeObserber を用意
const fadeObserber = new IntersectionObserver(animateFade, options);

// 監視するものを設定
const fadeElements = document.querySelectorAll('.fadein');
fadeElements.forEach(element => {
  fadeObserber.observe(element);
});



// --- .fadein_2 設定 ---

// ロボットにやって欲しいことを書く
const animateFade2 = (entries2, obs2) => {
  // console.log('ふわっ');

  entries2.forEach((entry2) => {
    if (entry2.isIntersecting) {

      entry2.target.animate(
        {
          opacity: [0, 1],
          filter: ['blur(.5rem)', 'blur(0)'],
          translate: ['0 3rem', 0],

        },
        {
          duration: 2000,
          easing: 'ease',
          fill: 'forwards',
        }
      );

      // 一回ふわっとさせたら、監視の対象外にする。
      obs2.unobserve(entry2.target);
    };
  });
};

const options2 = {
  threshold: 0.3,
};

// 監視ロボットを用意
const fadeObserber2 = new IntersectionObserver(animateFade2, options2);

// 監視するものを設定
const fadeElements2 = document.querySelectorAll('.fadein_2');
fadeElements2.forEach(element2 => {
  fadeObserber2.observe(element2);
});




// --- .fadein_3 設定 ---

// ロボットにやって欲しいことを書く
const animateFade3 = (entries3, obs3) => {
  // console.log('はやふわっ');

  entries3.forEach((entry3) => {
    if (entry3.isIntersecting) {

      entry3.target.animate(
        {
          opacity: [0, 1],
          filter: ['blur(.5rem)', 'blur(0)'],
          translate: ['0 2rem', 0],

        },
        {
          duration: 800,
          easing: 'ease',
          fill: 'forwards',
        }
      );

      // 一回ふわっとさせたら、監視の対象外にする。
      obs3.unobserve(entry3.target);
    };
  });
};

const options3 = {
  threshold: 0.5,
};

// 監視ロボットを用意
const fadeObserber3 = new IntersectionObserver(animateFade3, options3);

// 監視するものを設定
const fadeElements3 = document.querySelectorAll('.fadein_3');
fadeElements3.forEach(element3 => {
  fadeObserber3.observe(element3);
});


// --- .fadein_4 設定 ---

// ロボットにやって欲しい事を設定
const animateFade4 = (entries4, obs4) => {
  console.log('はやじゅわっ(50%で実行)');

  entries4.forEach((entry4) => {
    if (entry4.isIntersecting) {

      entry4.target.animate(
        {
          opacity: [0, 1],
          filter: ['blur(1rem)', 'blur(0)'],
        },
        {
          duration: 800,
          easing: 'ease',
          fill: 'forwards',
        }
      );

      // 一回ふわっとさせたら、監視の対象外にする。
      obs4.unobserve(entry4.target);
    }
  });

};

const options4 = {
  threshold: 0.5,
};

// 監視ロボット fadeObserber を用意
const fadeObserber4 = new IntersectionObserver(animateFade4, options4);

// 監視するものを設定
const fadeElements4 = document.querySelectorAll('.fadein_4');
fadeElements4.forEach(element4 => {
  fadeObserber4.observe(element4);
});


// --- FVの吹き出し(煙)を順番に出す ---
// 煙突に近い順に、fog1 → fog2 → メッセージ(吹き出し+文章)
const fogSteps = [
  ['.fv__fog1'],
  ['.fv__fog2'],
  ['.fv__message_img', '.fv__message_text'],
];

const showFogSequence = () => {
  const STEP_DELAY = 700; // 次の吹き出しが出るまでの間隔(ms)
  const START_DELAY = 500; // 読み込み後、最初が出るまでの待ち(ms)

  fogSteps.forEach((selectors, index) => {
    selectors.forEach((selector) => {
      const el = document.querySelector(selector);
      if (!el) return; // 他のページにはないので、何もしない

      // 「動きを減らす」設定の人には、アニメーションなしで表示
      if (prefersReducedMotion) {
        el.style.opacity = 1;
        return;
      }

      el.animate(
        {
          opacity: [0, 1],
          filter: ['blur(.5rem)', 'blur(0)'],
          translate: ['0 2rem', 0], // 少し下から上がってくる
        },
        {
          duration: 1500,
          delay: START_DELAY + STEP_DELAY * index,
          easing: 'ease',
          fill: 'both', // 待ち時間のあいだも最初の状態(透明)を保つ
        }
      );
    });
  });
};

// --- ローディング画面 ---
// 読み込みが終わったら植物を少し見せて、消えたあとにFVの吹き出しを始める
const loader = document.getElementById('loader');

if (loader && !prefersReducedMotion) {
  const MIN_SHOW = 2600; // 最低でもこの時間(ms)は見せる
  const startedAt = performance.now();
  let closed = false;

  const closeLoader = () => {
    if (closed) return;
    closed = true;
    const wait = Math.max(0, MIN_SHOW - (performance.now() - startedAt));
    setTimeout(() => {
      loader.classList.add('is-hide');   // ふわっと消える
      try { sessionStorage.setItem('moeLoaded', '1'); } catch (e) { }
      showFogSequence();                 // 消え始めと一緒に、吹き出しを始める
      setTimeout(() => loader.remove(), 700);
    }, wait);
  };

  if (document.readyState === 'complete') closeLoader();
  else window.addEventListener('load', closeLoader);
  setTimeout(closeLoader, 6000); // 読み込みが遅くても、6秒で必ず消す
} else {
  // 2回目以降 / 「動きを減らす」設定のときは、ローディングなしで始める
  if (loader) loader.remove();
  if (document.readyState === 'complete') showFogSequence();
  else window.addEventListener('load', showFogSequence);
}


// FVの背景パララックス(背景がゆっくり動く)
const fvSection = document.querySelector('.fv');
if (fvSection && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
  let fvTicking = false;
  const updateFvShift = () => {
    const y = Math.min(window.scrollY, fvSection.offsetHeight);
    fvSection.style.setProperty('--fv-shift', (y * 0.3) + 'px');
    fvTicking = false;
  };
  window.addEventListener('scroll', () => {
    if (!fvTicking) {
      requestAnimationFrame(updateFvShift);
      fvTicking = true;
    }
  }, { passive: true });
  updateFvShift();
}