/**
 * Hero Component — Typing & GSAP Mouse Effects
 */
document.addEventListener("DOMContentLoaded", function () {
  const typingEl = document.querySelector("[data-wschild-typing]");
  if (typingEl) {
    const prefersReducedMotion =
      window.matchMedia &&
      window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    const rawWords = typingEl.getAttribute("data-words") || "";
    const words = rawWords
      .split("|")
      .map(function (w) {
        return w.trim();
      })
      .filter(Boolean);

    if (words.length) {
      var wordIndex = 0;
      var charIndex = 0;
      var deleting = false;

      var typeSpeed = 65;
      var deleteSpeed = 35;
      var holdAfterType = 1100;
      var holdAfterDelete = 200;

      var render = function () {
        typingEl.textContent = words[wordIndex].slice(0, charIndex);
      };

      var tick = function () {
        if (prefersReducedMotion) {
          typingEl.textContent = words[0];
          return;
        }

        var current = words[wordIndex];
        if (!deleting) {
          charIndex = Math.min(current.length, charIndex + 1);
          render();
          if (charIndex === current.length) {
            deleting = true;
            window.setTimeout(tick, holdAfterType);
            return;
          }
          window.setTimeout(tick, typeSpeed);
          return;
        }

        charIndex = Math.max(0, charIndex - 1);
        render();
        if (charIndex === 0) {
          deleting = false;
          wordIndex = (wordIndex + 1) % words.length;
          window.setTimeout(tick, holdAfterDelete);
          return;
        }
        window.setTimeout(tick, deleteSpeed);
      };

      typingEl.textContent = words[0];
      charIndex = words[0].length;
      window.setTimeout(function () {
        deleting = true;
        tick();
      }, holdAfterType);
    }
  }

  var container = document.getElementById("hero-image-container");
  var image = document.getElementById("hero-main-image");
  var floatingItems = document.querySelectorAll(".floating-item");

  if (typeof gsap !== "undefined") {
    // Initial floating animation
    floatingItems.forEach(function (item, index) {
      gsap.to(item, {
        y: "+=20",
        x: "+=10",
        rotation: "+=15",
        duration: 2 + index,
        repeat: -1,
        yoyo: true,
        ease: "sine.inOut",
      });
    });

    window.addEventListener("mousemove", function (e) {
      var clientX = e.clientX;
      var clientY = e.clientY;
      var innerWidth = window.innerWidth;
      var innerHeight = window.innerHeight;

      // Hero Image Tilt
      if (container && image) {
        var moveX = ((clientX - innerWidth / 2) / (innerWidth / 2)) * -15;
        var moveY = ((clientY - innerHeight / 2) / (innerHeight / 2)) * -15;
        var rotateX = ((clientY - innerHeight / 2) / (innerHeight / 2)) * 10;
        var rotateY = ((clientX - innerWidth / 2) / (innerWidth / 2)) * -10;

        gsap.to(image, {
          x: moveX,
          y: moveY,
          rotateX: rotateX,
          rotateY: rotateY,
          duration: 1.2,
          ease: "power2.out",
          transformPerspective: 1200,
          transformOrigin: "center center",
        });
      }

      // Floating Elements Mouse Follow (Parallax)
      floatingItems.forEach(function (item) {
        var speed = item.getAttribute("data-speed") || 20;
        var x = (innerWidth - clientX * speed) / 100;
        var y = (innerHeight - clientY * speed) / 100;

        gsap.to(item, {
          x: x,
          y: y,
          duration: 1,
          ease: "power1.out",
        });
      });
    });

    // Reset on mouseleave
    window.addEventListener("mouseleave", function () {
      if (image) {
        gsap.to(image, {
          x: 0,
          y: 0,
          rotateX: 0,
          rotateY: 0,
          duration: 1.5,
          ease: "elastic.out(1, 0.5)",
        });
      }

      floatingItems.forEach(function (item) {
        gsap.to(item, {
          x: 0,
          y: 0,
          duration: 1.5,
          ease: "elastic.out(1, 0.5)",
        });
      });
    });

    // Reset on resize — fully clear all GSAP transforms so layout recalc is clean
    window.addEventListener("resize", function () {
      if (image) {
        gsap.killTweensOf(image);
        gsap.set(image, { clearProps: "transform" });
      }
      floatingItems.forEach(function (item) {
        gsap.killTweensOf(item);
        gsap.set(item, { clearProps: "transform" });
      });
    });
  }
});
