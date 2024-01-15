(() => {
  // resources/js/app.js
  jQuery(function($) {
    if ($(".counterNumber").length) {
      counterNumber();
    }
    function counterNumber() {
      const counterUp = window.counterUp.default;
      const callback = (entries) => {
        entries.forEach((entry) => {
          const el2 = entry.target;
          if (entry.isIntersecting && !el2.classList.contains("is-visible")) {
            for (const counter of counters) {
              counterUp(counter, {
                duration: 3e3,
                delay: 16
              });
              el2.classList.add("is-visible");
            }
          }
        });
      };
      const IO = new IntersectionObserver(callback, { threshold: 1 });
      const el = document.querySelector(".counterNumber");
      const counters = document.querySelectorAll(".counterNumber");
      IO.observe(el);
    }
  });
})();
