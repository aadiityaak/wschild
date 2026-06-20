document.addEventListener("DOMContentLoaded", () => {
  if (typeof gsap === "undefined") return;

  // Why Us cards - soft pastel for light background
  const whyUsCards = document.querySelectorAll(".home-why-us__card");
  const whyUsColors = [
    "rgba(255, 182, 193, 0.45)", // soft pink
    "rgba(186, 225, 255, 0.45)", // soft blue
    "rgba(200, 230, 201, 0.45)", // soft green
    "rgba(255, 224, 178, 0.45)", // soft amber
    "rgba(225, 190, 231, 0.45)", // soft purple
    "rgba(255, 204, 188, 0.45)", // soft peach
  ];

  // Q&A accordion trigger - soft pastel for dark background
  const qnaItems = document.querySelectorAll(".home-qna__trigger");
  const qnaColors = [
    "rgba(255, 182, 193, 0.2)", // soft pink
    "rgba(186, 225, 255, 0.2)", // soft blue
    "rgba(200, 230, 201, 0.2)", // soft green
    "rgba(255, 224, 178, 0.2)", // soft amber
    "rgba(225, 190, 231, 0.2)", // soft purple
    "rgba(255, 204, 188, 0.2)", // soft peach
  ];

  // Q&A accordion answer content - soft pastel for light background
  const qnaAnswers = document.querySelectorAll(".home-qna__answer");
  const qnaAnswerColors = [
    "rgba(255, 182, 193, 0.3)", // soft pink
    "rgba(186, 225, 255, 0.3)", // soft blue
    "rgba(200, 230, 201, 0.3)", // soft green
    "rgba(255, 224, 178, 0.3)", // soft amber
    "rgba(225, 190, 231, 0.3)", // soft purple
    "rgba(255, 204, 188, 0.3)", // soft peach
  ];

  // Apply to Why Us cards
  applyRippleEffect(whyUsCards, whyUsColors, "home-why-us__ripple");

  // Apply to Q&A accordion trigger
  applyRippleEffect(qnaItems, qnaColors, "home-qna__ripple");

  // Apply to Q&A accordion answer content
  applyRippleEffect(qnaAnswers, qnaAnswerColors, "home-qna__ripple");

  function applyRippleEffect(elements, colors, rippleClass) {
    if (!elements.length) return;

    elements.forEach((el, index) => {
      // Ensure element has position relative for absolute positioning
      const computedStyle = window.getComputedStyle(el);
      if (computedStyle.position === "static") {
        el.style.position = "relative";
      }
      el.style.overflow = "hidden";

      const ripple = document.createElement("span");
      ripple.classList.add(rippleClass);
      el.appendChild(ripple);

      const color = colors[index % colors.length];
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
          background: color,
          scale: 0,
          opacity: 1,
        });

        tween = gsap.to(ripple, {
          scale: 1,
          duration: 0.6,
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
        const size = currentSize;
        const halfSize = size / 2;

        // Start from current position
        gsap.set(ripple, {
          x: exitX - halfSize,
          y: exitY - halfSize,
        });

        // Shrink toward the mouseout point using onUpdate
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
    });
  }
});
