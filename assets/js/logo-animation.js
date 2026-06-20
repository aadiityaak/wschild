document.addEventListener("DOMContentLoaded", () => {
  const t = document.getElementById("wsLogo");
  if (!t) return;

  const e = document.getElementById("pW");
  const o = document.getElementById("pS");
  const a = document.getElementById("pDot");
  const c = document.getElementById("pDotBack");

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
  if (c) s(c, "2.5");

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
  const D = t.querySelector("#pDotFill");

  const v = (t) => {
    const e = gsap.utils.clamp(0, 1, t);
    return e * e * (3 - 2 * e);
  };

  const b = { v: 0 };
  const w = { a: 0 };
  let k = null;

  if (a) {
    const e = i && i.getBBox ? i.getBBox() : t.getBBox();
    const o = e.x + e.width / 2;
    const r = e.y + e.height / 2;
    const n = Math.max(e.width, e.height) * 0.62 + 22;
    const d = n * 0.48;
    const s = (-35 * Math.PI) / 180;
    const l = Math.cos(s);
    const m = Math.sin(s);
    const u = parseFloat(a.getAttribute("cx") || "0");
    const p = parseFloat(a.getAttribute("cy") || "0");
    const y = u - o;
    const f = p - r;
    const g = y * l + f * m;
    const h = -y * m + f * l;
    const z = Math.sqrt((g * g) / (n * n) + (h * h) / (d * d)) || 1;
    const A = n * z;
    const B = d * z;
    const v = Math.atan2(h / B, g / A);
    k = {
      cx: o,
      cy: r,
      a: A,
      b: B,
      c: l,
      s: m,
      phi0: v,
      sx: u,
      sy: p,
      turns: 1,
    };
  }

  const x = () => {
    if (!a || !k) return;
    const t = w.a;
    const e = Math.cos(t);
    const o = Math.sin(t);
    const r = k.a * e;
    const n = k.b * o;
    const d = r * k.c - n * k.s;
    const s = r * k.s + n * k.c;
    const i = k.cx + d;
    const l = k.cy + s;
    const m = b.v;
    const u = v((o + 1) / 2);
    const p =
      k.turns > 0
        ? gsap.utils.clamp(0, 1, (t - k.phi0) / (Math.PI * 2 * k.turns))
        : 0;

    gsap.set(a, {
      attr: { cx: p >= 0.999999 ? k.sx : i, cy: p >= 0.999999 ? k.sy : l },
      opacity: p >= 0.999999 ? 1 : m * (0.08 + 0.92 * u),
      scaleX: p >= 0.999999 ? 1 : gsap.utils.interpolate(0.78, 1.22, u),
      scaleY: p >= 0.999999 ? 1 : gsap.utils.interpolate(0.78, 1.22, u),
    });

    if (c) {
      gsap.set(c, {
        attr: { cx: p >= 0.999999 ? k.sx : i, cy: p >= 0.999999 ? k.sy : l },
        opacity: p >= 0.999999 ? 0 : m * (0.08 + 0.92 * (1 - u)),
        scaleX: p >= 0.999999 ? 1 : gsap.utils.interpolate(0.62, 0.96, 1 - u),
        scaleY: p >= 0.999999 ? 1 : gsap.utils.interpolate(0.62, 0.96, 1 - u),
      });
    }
  };

  const y = window.matchMedia("(hover: hover) and (pointer: fine)").matches;
  let f = false;

  const colors = ["#000000", "#76ABAE", "#BA5A5A", "#59B292", "#2C687B"];
  const pWFillEl = t.querySelector("#pWFill");
  const pSFillEl = t.querySelector("#pSFill");
  const pathFillClones = [pWFillEl, pSFillEl].filter(Boolean);
  const dotEls = [a, c].filter(Boolean);
  const allFillTargets = [...pathFillClones, ...dotEls];
  const origEls = [e, o, a, c].filter(Boolean);
  const fillReveal = m && m.fillReveal ? m.fillReveal : {};
  const orbitEnd = (k ? k.phi0 : 0) + Math.PI * 2 * (k ? k.turns : 3);

  const g = gsap
    .timeline({
      repeat: -1,
      paused: true,
      defaults: { ease: "power2.inOut" },
      onComplete: () => {
        f = true;
      },
    })
    .set(t, { opacity: 1 })
    .set([e, o], {
      strokeDashoffset: (t, e) => (e === 0 ? r : n),
      strokeOpacity: 1,
    })
    .set(dotEls, {
      scaleX: 1,
      scaleY: 1,
      opacity: 0,
      strokeDashoffset: d,
      strokeOpacity: 1,
    })
    .set(fillReveal, { attr: { r: 0 } })
    .set(b, { v: 0 })
    .set(w, { a: k ? k.phi0 : 0, onUpdate: x })
    .set(origEls, { strokeOpacity: 0, stroke: "none", strokeWidth: 0 })
    .set([e, o].filter(Boolean), { fill: "none" });

  colors.forEach((color, idx) => {
    if (idx > 0) {
      g.set(fillReveal, { attr: { r: 0 } }).set(allFillTargets, {
        fill: color,
      });
    } else {
      g.set(allFillTargets, { fill: color });
    }

    g.set(w, { a: k ? k.phi0 : 0, onUpdate: x })
      .set(dotEls, {
        attr: k ? { cx: k.sx, cy: k.sy } : {},
      })
      .set(b, { v: 1 })
      .to(
        fillReveal,
        {
          attr: { r: m ? m.fillRadius : 0 },
          duration: 0.6,
          ease: "power2.out",
        },
        idx === 0 ? ">-0.1" : undefined,
      )
      .set(dotEls, {
        opacity: 1,
        stroke: "none",
        strokeWidth: 0,
        strokeDasharray: "none",
        strokeDashoffset: 0,
      })
      .add(() => {
        if (D) D.style.opacity = "0";
      })
      .to(w, {
        a: orbitEnd,
        duration: 3.6,
        ease: "power2.inOut",
        onUpdate: x,
        onComplete: () => {
          if (!k) return;
          if (a) {
            a.setAttribute("cx", `${k.sx}`);
            a.setAttribute("cy", `${k.sy}`);
          }
          if (c) {
            c.setAttribute("cx", `${k.sx}`);
            c.setAttribute("cy", `${k.sy}`);
          }
        },
      })
      .set(dotEls, { fill: color });
  });

  g.play(0);

  if (y) {
    const h = t.closest("a") || t;
    h.addEventListener("pointerenter", () => {
      if (!f || g.isActive()) return;
      f = false;
      g.restart(true, false);
    });
  }

  gsap.to(t, {
    y: -8,
    rotation: 1,
    duration: 2.6,
    yoyo: true,
    repeat: -1,
    ease: "sine.inOut",
  });
});
