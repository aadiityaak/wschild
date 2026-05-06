(function () {
  window.wschildInitScrambleScroll = function (root) {
    if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
      return;
    }

    gsap.registerPlugin(ScrollTrigger);

    const scope = root && root.querySelectorAll ? root : document;
    const scrambleElements = scope.querySelectorAll(".scramble-scroll");

    scrambleElements.forEach((el) => {
      if (el.dataset && el.dataset.scrambleInitialized === "1") return;
      if (el.dataset) el.dataset.scrambleInitialized = "1";

      const originalText = el.innerText;
      el.innerHTML = originalText
        .split("")
        .map((char) => {
          if (char === " ") return " ";
          return `<span class="scramble-char">${char}</span>`;
        })
        .join("");

      const chars = el.querySelectorAll(".scramble-char");
      let isAnimating = false;

      ScrollTrigger.create({
        id: "wschild-scramble",
        trigger: el,
        start: "top bottom",
        end: "bottom top",
        onUpdate: (self) => {
          const velocity = self.getVelocity();
          const absVelocity = Math.abs(velocity);

          if (absVelocity > 50 && !isAnimating) {
            isAnimating = true;

            const direction = velocity > 0 ? 1 : -1;
            const rotationOut = direction === 1 ? 90 : -90;
            const rotationIn = direction === 1 ? -90 : 90;

            const animatedChars = gsap.utils
              .shuffle(Array.from(chars))
              .slice(0, Math.ceil(chars.length * 0.3));

            const tl = gsap.timeline({
              onComplete: () => {
                isAnimating = false;
              },
            });

            tl.to(animatedChars, {
              rotationX: rotationOut,
              opacity: 0,
              duration: 0.25,
              stagger: {
                each: 0.04,
                from: "random",
              },
              ease: "power1.in",
            })
              .set(animatedChars, {
                rotationX: rotationIn,
                onComplete: () => {
                  animatedChars.forEach((charEl) => {
                    const index = Array.from(chars).indexOf(charEl);
                    if (index !== -1) {
                      charEl.innerText = originalText[index];
                    }
                  });
                },
              })
              .to(animatedChars, {
                rotationX: 0,
                opacity: 1,
                duration: 0.25,
                stagger: {
                  each: 0.04,
                  from: "random",
                },
                ease: "power1.out",
              });
          }
        },
      });
    });
  };

  document.addEventListener("DOMContentLoaded", () => {
    if (window.wschildBarbaEnabled) return;
    window.wschildInitScrambleScroll(document);
  });
})();
