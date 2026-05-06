(function () {
  window.wschildInitPricingHover = function (root) {
    if (typeof gsap === "undefined") {
      return;
    }

    const scope = root && root.querySelectorAll ? root : document;
    const pricingCards = scope.querySelectorAll(".wschild-pricing-card");
    if (!pricingCards.length) return;

    pricingCards.forEach((card) => {
      if (card.dataset && card.dataset.hoverInitialized === "1") return;
      if (card.dataset) card.dataset.hoverInitialized = "1";

      const tl = gsap.timeline({ paused: true });

      tl.to(card, {
        scale: 1.02,
        boxShadow: "0 25px 50px -12px rgba(0, 0, 0, 0.1)",
        duration: 0.3,
        ease: "power2.out",
        zIndex: 1000,
      });

      card.addEventListener("mouseenter", () => {
        tl.play();
      });

      card.addEventListener("mouseleave", () => {
        tl.reverse();
      });
    });
  };

  document.addEventListener("DOMContentLoaded", () => {
    if (window.wschildBarbaEnabled) return;
    window.wschildInitPricingHover(document);
  });
})();
