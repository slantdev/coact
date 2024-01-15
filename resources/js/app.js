jQuery(function ($) {
  if ($(".counterNumber").length) {
    counterNumber();
  }

  function counterNumber() {
    const counterUp = window.counterUp.default;

    const callback = (entries) => {
      entries.forEach((entry) => {
        const el = entry.target;
        if (entry.isIntersecting && !el.classList.contains("is-visible")) {
          for (const counter of counters) {
            counterUp(counter, {
              duration: 3000,
              delay: 16,
            });
            el.classList.add("is-visible");
          }
        }
      });
    };

    // observer
    const IO = new IntersectionObserver(callback, { threshold: 1 });

    // First element to target
    const el = document.querySelector(".counterNumber");

    // all numbers
    const counters = document.querySelectorAll(".counterNumber");
    IO.observe(el);
  }
});
