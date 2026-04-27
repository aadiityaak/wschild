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

  const i = e && e.parentNode ? e.parentNode : t;
  const l = () => {
    if (!e || !o || !a) return null;
    const t = e.ownerSVGElement || document.getElementById("wsLogo");
    if (!t) return null;
    let s = t.querySelector("#wsLogoFillMask");
    let r = t.querySelector("#wsLogoFillReveal");
    if (!s || !r) {
      const e =
        t.querySelector("defs") ||
        document.createElementNS("http://www.w3.org/2000/svg", "defs");
      if (!e.parentNode) t.insertBefore(e, t.firstChild);
      const o = i.getBBox ? i.getBBox() : t.getBBox();
      const a = document.createElementNS("http://www.w3.org/2000/svg", "mask");
      a.setAttribute("id", "wsLogoFillMask");
      a.setAttribute("maskUnits", "userSpaceOnUse");
      a.setAttribute("x", `${o.x}`);
      a.setAttribute("y", `${o.y}`);
      a.setAttribute("width", `${o.width}`);
      a.setAttribute("height", `${o.height}`);
      const n = document.createElementNS("http://www.w3.org/2000/svg", "rect");
      n.setAttribute("x", `${o.x}`);
      n.setAttribute("y", `${o.y}`);
      n.setAttribute("width", `${o.width}`);
      n.setAttribute("height", `${o.height}`);
      n.setAttribute("fill", "#000000");
      const d = document.createElementNS(
        "http://www.w3.org/2000/svg",
        "circle",
      );
      d.setAttribute("id", "wsLogoFillReveal");
      d.setAttribute("cx", `${o.x + o.width / 2}`);
      d.setAttribute("cy", `${o.y + o.height / 2}`);
      d.setAttribute("r", "0");
      d.setAttribute("fill", "#ffffff");
      a.appendChild(n);
      a.appendChild(d);
      e.appendChild(a);
      s = a;
      r = d;
    }
    const n = t.querySelector("#pWFill") || e.cloneNode(true);
    const d = t.querySelector("#pSFill") || o.cloneNode(true);
    const c = t.querySelector("#pDotFill") || a.cloneNode(true);
    n.setAttribute("id", "pWFill");
    d.setAttribute("id", "pSFill");
    c.setAttribute("id", "pDotFill");
    [n, d, c].forEach((t) => {
      t.style.stroke = "none";
      t.style.strokeWidth = "";
      t.style.strokeDasharray = "";
      t.style.strokeDashoffset = "";
      t.style.fill = "#000000";
      t.setAttribute("mask", "url(#wsLogoFillMask)");
    });
    if (!n.parentNode) i.insertBefore(n, e);
    if (!d.parentNode) i.insertBefore(d, e);
    if (!c.parentNode) i.insertBefore(c, e);
    e.style.fill = "none";
    o.style.fill = "none";
    a.style.fill = "none";
    const u = i.getBBox ? i.getBBox() : t.getBBox();
    const p = u.x + u.width / 2;
    const y = u.y + u.height / 2;
    const f = Math.max(p - u.x, u.x + u.width - p);
    const g = Math.max(y - u.y, u.y + u.height - y);
    const h = Math.hypot(f, g);
    return { fillReveal: r, fillRadius: h };
  };

  const m = l();

  gsap
    .timeline({
      repeat: 0,
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
    .to([e, o, a], { strokeOpacity: 0, duration: 0.18, ease: "power2.out" })
    .set(m && m.fillReveal ? m.fillReveal : {}, { attr: { r: 0 } })
    .to(
      m && m.fillReveal ? m.fillReveal : {},
      { attr: { r: m ? m.fillRadius : 0 }, duration: 0.6, ease: "power2.out" },
      ">-0.1",
    );

  gsap.to(t, {
    y: -8,
    rotation: 1,
    duration: 2.6,
    yoyo: true,
    repeat: -1,
    ease: "sine.inOut",
  });
});
