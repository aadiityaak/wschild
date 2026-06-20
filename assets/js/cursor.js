const wschildInitCursor = () => {
  if (window.__wschildCursorInitialized) return;
  window.__wschildCursorInitialized = true;

  // Check if gsap is available
  if (typeof gsap === "undefined") {
    console.warn("GSAP is not loaded. Circle cursor will not work.");
    return;
  }

  const canHover = window.matchMedia(
    "(hover: hover) and (pointer: fine)",
  ).matches;
  if (canHover) document.body.classList.add("wschild-cursor-enabled");
  let mouseX = window.innerWidth / 2;
  let mouseY = window.innerHeight / 2;

  let cursor = document.querySelector(".cursor-circle");
  let createdCursor = false;
  if (!cursor) {
    cursor = document.createElement("div");
    cursor.className = "cursor-circle";
    document.body.appendChild(cursor);
    createdCursor = true;
  }

  let dot = document.querySelector(".cursor-dot");
  let createdDot = false;
  if (!dot) {
    dot = document.createElement("div");
    dot.className = "cursor-dot";
    document.body.appendChild(dot);
    createdDot = true;
  }

  if (createdCursor) {
    cursor.style.width = "34px";
    cursor.style.height = "34px";
    cursor.style.background = "rgba(0, 0, 0, 0)";
    cursor.style.border = "2px solid #000000";
    cursor.style.borderRadius = "99px";
    cursor.style.position = "fixed";
    cursor.style.top = "0";
    cursor.style.left = "0";
    cursor.style.pointerEvents = "none";
    cursor.style.zIndex = "2147483646";
  }

  if (createdDot) {
    dot.style.width = "6px";
    dot.style.height = "6px";
    dot.style.background = "#000000";
    dot.style.borderRadius = "99px";
    dot.style.position = "fixed";
    dot.style.top = "0";
    dot.style.left = "0";
    dot.style.pointerEvents = "none";
    dot.style.zIndex = "2147483647";
  }

  gsap.set([cursor, dot], {
    xPercent: -50,
    yPercent: -50,
    scale: 1,
    opacity: 1,
  });

  const jelly = (scale = 1.25) => {
    gsap.fromTo(
      cursor,
      { scaleX: scale * 0.88, scaleY: scale * 1.12 },
      {
        scaleX: scale,
        scaleY: scale,
        duration: 0.55,
        ease: "elastic.out(1, 0.45)",
        overwrite: "auto",
      },
    );
    gsap.fromTo(
      dot,
      { scaleX: 1.08, scaleY: 0.92 },
      {
        scaleX: Math.max(0.55, 1.1 - scale * 0.25),
        scaleY: Math.max(0.55, 1.1 - scale * 0.25),
        duration: 0.45,
        ease: "elastic.out(1, 0.55)",
        overwrite: "auto",
      },
    );
  };

  const setRingX = gsap.quickSetter(cursor, "x", "px");
  const setRingY = gsap.quickSetter(cursor, "y", "px");
  const setDotX = gsap.quickSetter(dot, "x", "px");
  const setDotY = gsap.quickSetter(dot, "y", "px");

  let targetX = mouseX;
  let targetY = mouseY;
  let ringX = mouseX;
  let ringY = mouseY;
  let dotX = mouseX;
  let dotY = mouseY;

  setRingX(ringX);
  setRingY(ringY);
  setDotX(dotX);
  setDotY(dotY);

  const onMove = (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
    targetX = mouseX;
    targetY = mouseY;
  };

  window.addEventListener("pointermove", (e) => {
    if (e.pointerType && e.pointerType !== "mouse") return;
    onMove(e);
  });

  window.addEventListener("mousemove", onMove);

  gsap.ticker.add(() => {
    const ringLerp = 0.14;
    const dotLerp = 0.28;
    ringX += (targetX - ringX) * ringLerp;
    ringY += (targetY - ringY) * ringLerp;
    dotX += (targetX - dotX) * dotLerp;
    dotY += (targetY - dotY) * dotLerp;

    setRingX(ringX);
    setRingY(ringY);
    setDotX(dotX);
    setDotY(dotY);
  });

  // Hover effects on interactive elements
  const interactives = document.querySelectorAll(
    'a, button, .cursor-pointer, input[type="submit"], input[type="button"]',
  );

  // Initialize buttons for color spread effect
  interactives.forEach((el) => {
    const isExcluded =
      el.classList.contains("home-tech__nav-btn") ||
      el.closest(".home-tech__nav-btn") ||
      el.classList.contains("home-qna__trigger") ||
      el.closest(".home-qna__trigger");
    const isLogo =
      el.classList.contains("wschild-header__logo") ||
      el.closest(".wschild-header__logo");
    const isButton = el.classList.contains("wschild-button");

    if (!isExcluded && !isLogo && isButton) {
      // Create ripple element for color spread
      const ripple = document.createElement("span");
      ripple.classList.add("wschild-button__ripple");
      el.appendChild(ripple);

      let tween = null;
      let currentSize = 0;
      let enterX = 0;
      let enterY = 0;

      el.addEventListener("mouseenter", (e) => {
        const rect = el.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        enterX = x;
        enterY = y;

        const maxDist = Math.max(
          Math.hypot(x, y),
          Math.hypot(rect.width - x, y),
          Math.hypot(x, rect.height - y),
          Math.hypot(rect.width - x, rect.height - y),
        );

        currentSize = maxDist * 2;

        if (tween) tween.kill();

        gsap.set(ripple, {
          width: currentSize,
          height: currentSize,
          x: x - currentSize / 2,
          y: y - currentSize / 2,
          scale: 0,
          opacity: 1,
        });

        tween = gsap.to(ripple, {
          scale: 1,
          duration: 0.5,
          ease: "power2.out",
        });
      });

      el.addEventListener("mousemove", (e) => {
        const rect = el.getBoundingClientRect();
        enterX = e.clientX - rect.left;
        enterY = e.clientY - rect.top;
      });

      el.addEventListener("mouseleave", () => {
        if (tween) tween.kill();

        const exitX = enterX;
        const exitY = enterY;
        const halfSize = currentSize / 2;

        gsap.set(ripple, {
          x: exitX - halfSize,
          y: exitY - halfSize,
        });

        tween = gsap.to(ripple, {
          scale: 0,
          opacity: 0,
          duration: 0.4,
          ease: "power2.in",
          onUpdate: function () {
            const s = gsap.getProperty(ripple, "scale");
            gsap.set(ripple, {
              x: exitX - halfSize * s,
              y: exitY - halfSize * s,
            });
          },
        });
      });
    }

    el.addEventListener("mouseenter", () => {
      // Change cursor color to orange on interactive elements
      gsap.to(cursor, { borderColor: "#F8843F", duration: 0.2 });
      gsap.to(dot, { background: "#F8843F", duration: 0.2 });

      if (isExcluded) {
        jelly(1.18);
        return;
      }

      jelly(1.35);
    });

    el.addEventListener("mouseleave", () => {
      // Reset cursor color
      gsap.to(cursor, { borderColor: "#000000", duration: 0.2 });
      gsap.to(dot, { background: "#000000", duration: 0.2 });

      if (isExcluded) {
        gsap.to([cursor, dot], {
          scaleX: 1,
          scaleY: 1,
          duration: 0.22,
          ease: "power2.out",
          overwrite: true,
        });
        return;
      }

      gsap.to([cursor, dot], {
        scaleX: 1,
        scaleY: 1,
        duration: 0.22,
        ease: "power2.out",
        overwrite: true,
      });
    });
  });

  // Hide cursor when leaving window
  document.addEventListener("mouseleave", () => {
    gsap.killTweensOf([cursor, dot]);
    gsap.fromTo(
      [cursor, dot],
      { scaleX: 1.05, scaleY: 0.95 },
      {
        scaleX: 0,
        scaleY: 0,
        duration: 0.42,
        ease: "elastic.in(1, 0.6)",
        overwrite: true,
      },
    );
  });

  document.addEventListener("mouseenter", () => {
    gsap.killTweensOf([cursor, dot]);
    gsap.fromTo(
      [cursor, dot],
      { scaleX: 0, scaleY: 0 },
      {
        scaleX: 1,
        scaleY: 1,
        duration: 0.55,
        ease: "elastic.out(1, 0.55)",
        overwrite: true,
      },
    );
  });
};

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", wschildInitCursor);
} else {
  wschildInitCursor();
}
