document.addEventListener("DOMContentLoaded", () => {
  if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
    return;
  }

  gsap.registerPlugin(ScrollTrigger);

  const scrambleElements = document.querySelectorAll(".scramble-scroll");

  scrambleElements.forEach((el) => {
    const originalText = el.innerText;
    // Wrap each character in a span
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
      trigger: el,
      start: "top bottom", // Start when top of element hits bottom of viewport
      end: "bottom top", // End when bottom of element hits top of viewport
      onUpdate: (self) => {
        const velocity = self.getVelocity();
        const absVelocity = Math.abs(velocity);

        if (absVelocity > 50 && !isAnimating) {
          isAnimating = true;

          const direction = velocity > 0 ? 1 : -1; // 1 for scroll down, -1 for scroll up
          const rotationOut = direction === 1 ? 90 : -90; // Flip out direction
          const rotationIn = direction === 1 ? -90 : 90; // Flip in direction

          // Select a subset of characters to animate (e.g., 30%)
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
            duration: 0.25, // Slightly longer duration
            stagger: {
              each: 0.04, // Slightly longer stagger
              from: "random",
            },
            ease: "power1.in",
          })
            .set(animatedChars, {
              rotationX: rotationIn, // Set for flip in
              onComplete: () => {
                // Reset text content for only animated characters
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
              duration: 0.25, // Slightly longer duration
              stagger: {
                each: 0.04, // Slightly longer stagger
                from: "random",
              },
              ease: "power1.out",
            });
        }
      },
    });
  });
});
