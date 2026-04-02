document.addEventListener("DOMContentLoaded", () => {
  // Check if gsap is available
  if (typeof gsap === "undefined") {
    console.warn(
      "GSAP is not loaded. Pricing card hover animation will not work.",
    );
    return;
  }

  const pricingCards = document.querySelectorAll(".umroh-pricing-card");

  if (!pricingCards.length) return;

  pricingCards.forEach((card) => {
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
});
