document.addEventListener("DOMContentLoaded", () => {
  // Check if gsap is available
  if (typeof gsap === "undefined") {
    console.warn("GSAP is not loaded. Circle cursor will not work.");
    return;
  }

  const cursor = document.querySelector(".cursor-circle");

  if (!cursor) return;

  // Set initial position
  gsap.set(cursor, {
    xPercent: -50,
    yPercent: -50,
    scale: 1,
    opacity: 0,
  });

  // Show cursor on first mouse move
  window.addEventListener(
    "mousemove",
    (e) => {
      gsap.to(cursor, {
        duration: 0.1,
        opacity: 1,
      });

      gsap.to(cursor, {
        duration: 0.4,
        x: e.clientX,
        y: e.clientY,
        ease: "power2.out",
      });
    },
    { once: true },
  );

  // Continuous mouse move update
  window.addEventListener("mousemove", (e) => {
    gsap.to(cursor, {
      duration: 0.4,
      x: e.clientX,
      y: e.clientY,
      ease: "power2.out",
    });
  });

  // Hover effects on interactive elements
  const interactives = document.querySelectorAll(
    'a, button, .cursor-pointer, input[type="submit"], input[type="button"]',
  );

  interactives.forEach((el) => {
    el.addEventListener("mouseenter", () => {
      gsap.to(cursor, {
        scale: 4,
        duration: 0.3,
        backgroundColor: "rgba(254, 240, 138, 0.2)", // Subtle yellow on hover
        ease: "power2.out",
      });
    });

    el.addEventListener("mouseleave", () => {
      gsap.to(cursor, {
        scale: 1,
        duration: 0.3,
        backgroundColor: "#fef08a", // Original yellow
        ease: "power2.out",
      });
    });
  });

  // Hide cursor when leaving window
  document.addEventListener("mouseleave", () => {
    gsap.to(cursor, {
      duration: 0.3,
      opacity: 0,
    });
  });

  document.addEventListener("mouseenter", () => {
    gsap.to(cursor, {
      duration: 0.3,
      opacity: 1,
    });
  });
});
