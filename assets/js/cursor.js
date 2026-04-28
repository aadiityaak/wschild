document.addEventListener("DOMContentLoaded", () => {
  // Check if gsap is available
  if (typeof gsap === "undefined") {
    console.warn("GSAP is not loaded. Circle cursor will not work.");
    return;
  }

  const cursor = document.querySelector(".cursor-circle");

  if (!cursor) return;

  const canHover = window.matchMedia(
    "(hover: hover) and (pointer: fine)",
  ).matches;
  let mouseX = window.innerWidth / 2;
  let mouseY = window.innerHeight / 2;

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
      mouseX = e.clientX;
      mouseY = e.clientY;
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
    mouseX = e.clientX;
    mouseY = e.clientY;
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

  const gooeyMap = new WeakMap();
  const gooeyTargets = [];

  const registerGooeyTarget = (el) => {
    const gooey = el.querySelector(".wschild-button__gooey");
    if (!gooey) return;
    const bg = gooey.querySelector(".wschild-button__bg");
    const whiteBlob =
      gooey.querySelector(".wschild-button__blob--white") ||
      gooey.querySelector(".wschild-button__blob");
    if (!bg || !whiteBlob) return;

    const target = {
      el,
      gooey,
      bg,
      whiteBlob,
      isHovering: false,
      setGx: gsap.quickTo(gooey, "x", { duration: 0.35, ease: "power3.out" }),
      setGy: gsap.quickTo(gooey, "y", { duration: 0.35, ease: "power3.out" }),
      setBx: gsap.quickTo(bg, "x", { duration: 0.35, ease: "power3.out" }),
      setBy: gsap.quickTo(bg, "y", { duration: 0.35, ease: "power3.out" }),
      setWx: gsap.quickTo(whiteBlob, "x", {
        duration: 0.25,
        ease: "power3.out",
      }),
      setWy: gsap.quickTo(whiteBlob, "y", {
        duration: 0.25,
        ease: "power3.out",
      }),
      setWs: gsap.quickTo(whiteBlob, "scale", {
        duration: 0.25,
        ease: "power3.out",
      }),
      setWo: gsap.quickTo(whiteBlob, "opacity", {
        duration: 0.25,
        ease: "power3.out",
      }),
    };

    gsap.set([gooey, bg, whiteBlob], { x: 0, y: 0 });
    target.setWs(0);
    target.setWo(0);

    gooeyMap.set(el, target);
    gooeyTargets.push(target);
  };

  // Initialize buttons for gooey effect
  interactives.forEach((el) => {
    // Check if the button should NOT have the gooey effect (e.g., nav buttons)
    const isExcluded =
      el.classList.contains("home-tech__nav-btn") ||
      el.closest(".home-tech__nav-btn") ||
      el.classList.contains("home-qna__trigger") ||
      el.closest(".home-qna__trigger");
    const isLogo =
      el.classList.contains("wschild-header__logo") ||
      el.closest(".wschild-header__logo");

    if (
      !isExcluded &&
      !isLogo &&
      (el.classList.contains("wschild-button") || el.tagName === "BUTTON")
    ) {
      // Create gooey container
      if (!el.querySelector(".wschild-button__gooey")) {
        const gooey = document.createElement("div");
        gooey.className = "wschild-button__gooey";

        const bg = document.createElement("div");
        bg.className = "wschild-button__bg";
        gooey.appendChild(bg);

        for (let i = 0; i < 4; i++) {
          const blob = document.createElement("div");
          blob.className = "wschild-button__blob";
          if (i === 0) blob.classList.add("wschild-button__blob--white");
          gooey.appendChild(blob);
        }
        el.appendChild(gooey);
      }

      if (canHover) registerGooeyTarget(el);
    }

    el.addEventListener("mouseenter", () => {
      // Don't hide cursor or play blobs for excluded buttons
      if (isExcluded) {
        gsap.to(cursor, {
          scale: 1.5,
          duration: 0.3,
          backgroundColor: "rgba(254, 240, 138, 0.4)",
          ease: "power2.out",
        });
        return;
      }

      gsap.to(cursor, {
        scale: 0, // Hide cursor when inside gooey button area
        duration: 0.2,
      });

      if (el.classList.contains("wschild-button") || el.tagName === "BUTTON") {
        const target = gooeyMap.get(el);
        if (target) target.isHovering = true;

        // Gooey blobs animation - scale up blobs
        const blobs = el.querySelectorAll(".wschild-button__blob");
        blobs.forEach((blob, i) => {
          gsap.set(blob, {
            x: 0,
            y: 0,
            scale: 0,
            opacity: 1,
          });
          gsap.to(blob, {
            scale: i === 0 ? 1 : 1.5,
            duration: 0.5,
            delay: i * 0.05,
            ease: "back.out(1.7)",
          });
        });
      }
    });

    el.addEventListener("mousemove", (e) => {
      // Don't play slime/magnetic for excluded buttons
      if (isExcluded) return;

      // Gooey Blobs Interaction for buttons
      if (el.classList.contains("wschild-button") || el.tagName === "BUTTON") {
        const rect = el.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;
        const x = e.clientX - centerX;
        const y = e.clientY - centerY;

        // Move blobs towards cursor with liquid feel (Button itself stays static)
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
      // Don't reset blobs for excluded buttons
      if (isExcluded) {
        gsap.to(cursor, {
          scale: 1,
          duration: 0.3,
          backgroundColor: "#fef08a",
          ease: "power2.out",
        });
        return;
      }

      gsap.to(cursor, {
        scale: 1,
        duration: 0.3,
        backgroundColor: "#fef08a", // Original yellow
        ease: "power2.out",
      });

      // Reset gooey blobs only - sucking back in
      if (el.classList.contains("wschild-button") || el.tagName === "BUTTON") {
        const target = gooeyMap.get(el);
        if (target) {
          target.isHovering = false;
          gsap.killTweensOf(target.whiteBlob);
        }

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

  if (canHover) {
    gsap.ticker.add(() => {
      if (!gooeyTargets.length) return;

      for (const target of gooeyTargets) {
        const rect = target.el.getBoundingClientRect();
        const cx = rect.left + rect.width / 2;
        const cy = rect.top + rect.height / 2;
        const dx = mouseX - cx;
        const dy = mouseY - cy;
        const dist = Math.hypot(dx, dy);
        const radius = Math.max(rect.width, rect.height) * 0.9 + 90;
        const t = dist < radius ? 1 - dist / radius : 0;

        const k = target.isHovering ? 1.15 : 1;
        const max = 22 * k;
        const nx = radius ? dx / radius : 0;
        const ny = radius ? dy / radius : 0;
        const pull = max * t;

        const gx = nx * pull;
        const gy = ny * pull;
        target.setGx(gx);
        target.setGy(gy);
        target.setBx(gx * 0.65);
        target.setBy(gy * 0.65);

        if (!target.isHovering) {
          target.setWx(gx * 1.1);
          target.setWy(gy * 1.1);
          target.setWs(t * 0.55);
          target.setWo(t * 0.8);
        }
      }
    });
  }

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
