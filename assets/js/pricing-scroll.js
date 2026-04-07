document.addEventListener("DOMContentLoaded", () => {
  if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
    return;
  }
  gsap.registerPlugin(ScrollTrigger);
  const grids = document.querySelectorAll(".wschild-grid.wschild-pricing");
  if (!grids.length) return;
  grids.forEach((grid) => {
    const cards = grid.querySelectorAll(".wschild-pricing-card");
    if (!cards.length) return;
    const step = 45;
    cards.forEach((card) => {
      gsap.set(card, { willChange: "transform" });
    });
    ScrollTrigger.create({
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
});
