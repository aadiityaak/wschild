(function () {
  window.wschildInitPricingScroll = function (root) {
    if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
      return;
    }
    gsap.registerPlugin(ScrollTrigger);

    const scope = root && root.querySelectorAll ? root : document;
    const grids = scope.querySelectorAll(".wschild-grid.wschild-pricing");
    if (!grids.length) return;

    grids.forEach((grid) => {
      if (grid.dataset && grid.dataset.pricingScrollInitialized === "1") return;
      if (grid.dataset) grid.dataset.pricingScrollInitialized = "1";

      const cards = grid.querySelectorAll(".wschild-pricing-card");
      if (!cards.length) return;

      const step = 45;
      cards.forEach((card) => {
        gsap.set(card, { willChange: "transform" });
      });

      ScrollTrigger.create({
        id: "wschild-pricing-scroll",
        trigger: grid,
        start: "top bottom",
        end: "bottom top",
        scrub: true,
        onUpdate: (self) => {
          const p = self.progress;
          cards.forEach((card, i) => {
            gsap.set(card, { y: i * step * p });
          });
        },
      });
    });
  };

  document.addEventListener("DOMContentLoaded", () => {
    if (window.wschildBarbaEnabled) return;
    window.wschildInitPricingScroll(document);
  });
})();
