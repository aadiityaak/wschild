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

  // Initialize buttons for gooey effect
  interactives.forEach((el) => {
    if (el.classList.contains("wschild-button") || el.tagName === "BUTTON") {
      // Create gooey container
      const gooey = document.createElement("div");
      gooey.className = "wschild-button__gooey";

      // Create background
      const bg = document.createElement("div");
      bg.className = "wschild-button__bg";
      gooey.appendChild(bg);

      // Create blobs
      for (let i = 0; i < 4; i++) {
        const blob = document.createElement("div");
        blob.className = "wschild-button__blob";
        if (i === 0) blob.classList.add("wschild-button__blob--white"); // Make one white blob like screenshot
        gooey.appendChild(blob);
      }
      el.appendChild(gooey);
    }

    el.addEventListener("mouseenter", () => {
      gsap.to(cursor, {
        scale: 0, // Hide cursor when inside gooey button area
        duration: 0.2,
      });

      // Set initial perspective for 3D effect
      if (el.classList.contains("wschild-button") || el.tagName === "BUTTON") {
        gsap.set(el, { transformPerspective: 1000 });

        // Gooey blobs animation
        const blobs = el.querySelectorAll(".wschild-button__blob");
        blobs.forEach((blob, i) => {
          gsap.set(blob, {
            x: 0,
            y: 0,
            scale: 0,
            opacity: 1,
          });
          gsap.to(blob, {
            scale: i === 0 ? 1 : 1.8,
            duration: 0.5,
            delay: i * 0.05,
            ease: "back.out(1.7)",
          });
        });
      }
    });

    el.addEventListener("mousemove", (e) => {
      // Slime Magnetic Interaction with 3D Effect for buttons
      if (el.classList.contains("wschild-button") || el.tagName === "BUTTON") {
        const rect = el.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;
        const x = e.clientX - centerX;
        const y = e.clientY - centerY;

        // Calculate distance and normalized direction
        const dist = Math.sqrt(x * x + y * y);
        const maxDist = rect.width / 2;
        const strength = Math.min(dist / maxDist, 1);

        gsap.to(el, {
          x: x * 0.35,
          y: y * 0.35,
          rotateX: -y * 0.1,
          rotateY: x * 0.1,
          duration: 0.4,
          ease: "power3.out",
        });

        // Move blobs towards cursor with liquid feel
        const blobs = el.querySelectorAll(".wschild-button__blob");
        blobs.forEach((blob, i) => {
          // The first blob (white) follows the mouse more accurately (1:1)
          const followX = i === 0 ? x : x * (0.6 + i * 0.1);
          const followY = i === 0 ? y : y * (0.6 + i * 0.1);

          gsap.to(blob, {
            x: followX,
            y: followY,
            duration: i === 0 ? 0.2 : 0.6 + i * 0.1,
            ease: i === 0 ? "none" : "power2.out",
          });
        });
      }
    });

    el.addEventListener("mouseleave", () => {
      gsap.to(cursor, {
        scale: 1,
        duration: 0.3,
        backgroundColor: "#fef08a", // Original yellow
        ease: "power2.out",
      });

      // Reset magnetic slime effect with 3D reset
      if (el.classList.contains("wschild-button") || el.tagName === "BUTTON") {
        gsap.to(el, {
          x: 0,
          y: 0,
          rotateX: 0,
          rotateY: 0,
          rotateZ: 0,
          skewX: 0,
          scaleX: 1,
          scaleY: 1,
          duration: 1,
          ease: "elastic.out(1.2, 0.4)",
        });

        // Reset gooey blobs - sucking back in
        const blobs = el.querySelectorAll(".wschild-button__blob");
        gsap.to(blobs, {
          x: 0,
          y: 0,
          scale: 0,
          opacity: 0,
          duration: 0.5,
          ease: "power3.in",
        });
      }
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
