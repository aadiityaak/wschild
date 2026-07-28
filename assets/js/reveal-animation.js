document.addEventListener("DOMContentLoaded", function () {
  if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined")
    return;
  gsap.registerPlugin(ScrollTrigger);

  // Helper function for standard reveal
  const reveal = (elements, options = {}) => {
    const els =
      typeof elements === "string"
        ? document.querySelectorAll(elements)
        : elements;
    if (!els || els.length === 0) return;

    els.forEach((el, i) => {
      const delay = options.stagger
        ? i * (options.staggerAmount || 0.1)
        : options.delay || 0;
      const startPct = options.randomStart
        ? Math.floor(75 + Math.random() * 15)
        : options.start || 85;

      gsap.from(el, {
        scrollTrigger: {
          trigger: el,
          start: `top ${startPct}%`,
          toggleActions: "play none none reverse",
          ...options.scrollTrigger,
        },
        y: options.y !== undefined ? options.y : 30,
        x: options.x || 0,
        scale: options.scale || 1,
        opacity: 0,
        duration: options.duration || 0.8,
        ease: options.ease || "power3.out",
        delay: delay,
        ...options.gsap,
      });
    });
  };

  // Hero — above the fold, no reveal needed

  // Home Components
  reveal(".home-why-us__card", { y: 40, duration: 0.9, randomStart: true });
  reveal(".home-qna__header > *", {
    stagger: true,
    staggerAmount: 0.2,
    scrollTrigger: { toggleActions: "play none play none" },
  });
  reveal(".home-qna__item", { randomStart: true });
  const homeTechContainer = document.querySelector(".home-tech__container");
  if (homeTechContainer) {
    gsap.from(homeTechContainer, {
      y: 40,
      opacity: 0,
      duration: 1,
      ease: "power3.out",
      delay: 0.1,
    });
  }

  const homeTechSlides = document.querySelectorAll(".home-tech__slide-alpine");
  if (homeTechSlides.length) {
    gsap.from(homeTechSlides, {
      x: 30,
      opacity: 0,
      duration: 0.8,
      ease: "power3.out",
      stagger: 0.08,
      delay: 0.2,
    });
  }

  // About Components
  reveal(".about-why-us__header > *", { stagger: true, staggerAmount: 0.2 });
  reveal(".about-why-us__feature", { x: 30, randomStart: true, stagger: true });
  reveal(".about-why-us__image", { y: 60, duration: 1.2, start: 80 });

  // Pricing Components
  reveal(".wschild-pricing-header > *", { stagger: true, staggerAmount: 0.2 });
  reveal(".wschild-pricing-card", { y: 40, duration: 0.9, randomStart: true });

  // Contact Components
  reveal(".contact-info__header > *", { stagger: true, staggerAmount: 0.2 });
  reveal(".contact-card", { randomStart: true, stagger: true });
  reveal(".contact-map__wrapper", { scale: 0.98, duration: 1.2 });

  // Services Components
  reveal(".services-card", {
    y: 40,
    duration: 0.9,
    randomStart: true,
    stagger: true,
  });

  // Blog & Archive
  reveal(".wschild-archive-header > *", { stagger: true, staggerAmount: 0.2 });
  reveal(".wschild-blog-header > *", { stagger: true, staggerAmount: 0.2 });
  reveal(".wschild-blog-card", {
    y: 40,
    duration: 0.9,
    randomStart: true,
    stagger: true,
  });

  // Single Post
  reveal(".wschild-article__header > *", { stagger: true, staggerAmount: 0.2 });
  reveal(".wschild-article__image-wrapper", {
    scale: 0.98,
    duration: 1,
    delay: 0.4,
  });
  reveal(
    ".wschild-article__content > p, .wschild-article__content > h2, .wschild-article__content > h3, .wschild-article__content > img, .wschild-article__content > figure",
    {
      y: 20,
      duration: 0.6,
      start: 90,
    },
  );

  // Landing Page Specifics (Jasa Website Umroh)
  reveal(".wschild-hero > .wschild-container > *", {
    stagger: true,
    staggerAmount: 0.15,
  });
  reveal(".wschild-highlights > *", {
    stagger: true,
    staggerAmount: 0.1,
    delay: 0.3,
  });
  reveal(".wschild-section__title, .wschild-section__subtitle", {
    stagger: true,
    staggerAmount: 0.2,
  });
  reveal(".wschild-card", { y: 30, stagger: true, randomStart: true });
  reveal(".wschild-list__item", { x: -20, stagger: true, staggerAmount: 0.1 });
  reveal(".wschild-proof__box", {
    scale: 0.9,
    stagger: true,
    staggerAmount: 0.1,
  });
  reveal(".wschild-faq__item", { y: 20, stagger: true, staggerAmount: 0.1 });
  reveal(".wschild-final", { scale: 0.95, duration: 1 });

  const refresh = () => ScrollTrigger.refresh();
  refresh();
  ScrollTrigger.update();
  window.addEventListener("load", refresh, { once: true });
  setTimeout(refresh, 200);
});
