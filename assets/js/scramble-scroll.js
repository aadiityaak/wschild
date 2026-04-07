document.addEventListener("DOMContentLoaded", () => {
  if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
    return;
  }

  gsap.registerPlugin(ScrollTrigger);

  const scrambleElements = document.querySelectorAll(".scramble-scroll");
  const characters =
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()";

  scrambleElements.forEach((el) => {
    const originalText = el.innerText;
    let isAnimating = false;

    const scramble = (progress) => {
      el.innerText = originalText
        .split("")
        .map((char, index) => {
          if (char === " ") return " ";
          if (Math.random() > progress) {
            return characters[Math.floor(Math.random() * characters.length)];
          }
          return originalText[index];
        })
        .join("");
    };

    ScrollTrigger.create({
      trigger: el,
      start: "top 95%",
      onUpdate: (self) => {
        const velocity = Math.abs(self.getVelocity());
        if (velocity > 50 && !isAnimating) {
          isAnimating = true;
          const proxy = { p: 0 };
          gsap.to(proxy, {
            p: 1,
            duration: 0.6,
            ease: "power1.inOut",
            onUpdate: () => {
              scramble(proxy.p);
            },
            onComplete: () => {
              el.innerText = originalText;
              isAnimating = false;
            },
          });
        }
      },
    });
  });
});
