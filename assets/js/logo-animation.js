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
    t.style.stroke = "rgba(0,0,0,0.8)";
    t.style.strokeWidth = e;
    t.style.strokeLinecap = "round";
    t.style.strokeLinejoin = "round";
    t.style.strokeDasharray = o;
    t.style.strokeDashoffset = o;
    return o;
  };

  const r = s(e);
  const n = s(o);
  s(a, "2.5");

  gsap
    .timeline({
      repeat: -1,
      repeatDelay: 0.5,
      defaults: { ease: "power2.inOut" },
    })
    .set(a, { scale: 1, opacity: 0 })
    .fromTo(
      t,
      { scale: 0.92, opacity: 0 },
      { scale: 1, opacity: 1, duration: 0.8 },
    )
    .to(e, { strokeDashoffset: 0, duration: 1.4 }, ">-0.2")
    .to(o, { strokeDashoffset: 0, duration: 1.2 }, ">-0.4")
    .to([e, o], { duration: 0.4 })
    .to(a, { opacity: 1, duration: 0.4 }, ">-0.3")
    .to(a, { strokeDashoffset: 0, duration: 0.8 }, "<")
    .to(a, { transformOrigin: "50% 50%", scale: 1.15, duration: 0.5 }, ">-0.05")
    .to(a, { scale: 1, duration: 0.5 })
    .to(a, { scale: 0, duration: 0.4 }, "+=2")
    .to(a, { opacity: 0, duration: 0.2 }, "<0.2")
    .to(o, { strokeDashoffset: n, duration: 1 }, ">")
    .to(e, { strokeDashoffset: r, duration: 1.2 }, "<")
    .to(t, { opacity: 0, scale: 0.92, duration: 0.6 }, "-=0.5");

  gsap.to(t, {
    y: -8,
    rotation: 1,
    duration: 2.6,
    yoyo: true,
    repeat: -1,
    ease: "sine.inOut",
  });
});
