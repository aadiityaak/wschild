document.addEventListener("DOMContentLoaded", () => {
  const t = document.getElementById("wsLogo");
  if (!t) return;

  const e = document.getElementById("pW");
  const o = document.getElementById("pS");
  const a = document.getElementById("pDot");

  const s = (t, e = "2.5") => {
    const o = t.getTotalLength
      ? t.getTotalLength()
      : 2 * Math.PI * t.r.baseVal.value;
    t.style.stroke = "#000000";
    t.style.strokeWidth = e;
    t.style.strokeLinecap = "round";
    t.style.strokeLinejoin = "round";
    t.style.strokeDasharray = o;
    t.style.strokeDashoffset = o;
    return o;
  };

  const r = s(e);
  const n = s(o);
  const d = s(a, "2.5");

  gsap
    .timeline({
      repeat: -1,
      repeatDelay: 1,
      defaults: { ease: "power2.inOut" },
    })
    .set(a, { scale: 1, opacity: 0 })
    .set(t, { opacity: 1 })
    .to(e, { strokeDashoffset: 0, duration: 1.4 })
    .to(o, { strokeDashoffset: 0, duration: 1.2 }, ">-0.4")
    .to(a, { opacity: 1, duration: 0.4 }, ">-0.3")
    .to(a, { strokeDashoffset: 0, duration: 0.8 }, "<")
    .to(a, { transformOrigin: "50% 50%", scale: 1.2, duration: 0.4 }, ">-0.05")
    .to(a, { scale: 1, duration: 0.4 })
    // Gathering into the ball (pDot)
    .to(
      [e, o],
      {
        scale: 0,
        opacity: 0,
        x: (i) => (i === 0 ? 30 : 15),
        y: (i) => (i === 0 ? 110 : 10),
        duration: 0.8,
        ease: "back.in(1.7)",
      },
      "+=2",
    )
    // Bouncing ball (pDot)
    .to(a, {
      y: -30,
      duration: 0.4,
      repeat: 3,
      yoyo: true,
      ease: "power1.inOut",
    })
    .to(a, {
      y: 0,
      duration: 0.3,
      ease: "bounce.out",
    })
    // Reset for next loop
    .to([e, o, a], { opacity: 0, duration: 0.5 }, "+=0.5")
    .set([e, o], {
      x: 0,
      y: 0,
      scale: 1,
      opacity: 1,
      strokeDashoffset: (i) => (i === 0 ? r : n),
    })
    .set(a, { opacity: 0, scale: 1, strokeDashoffset: d, y: 0 });

  gsap.to(t, {
    y: -8,
    rotation: 1,
    duration: 2.6,
    yoyo: true,
    repeat: -1,
    ease: "sine.inOut",
  });
});
