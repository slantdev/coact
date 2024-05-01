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
    $(window).scroll(function() {
      $(".toAnim").each(function() {
        var _win = $(window), _ths = $(this), _pos = _ths.offset().top, _scroll = _win.scrollTop(), _height = _win.height();
        _scroll > _pos - _height * 0.7 ? _ths.addClass("anim") : _ths.removeClass("anim");
      });
    });
    let observerOptions = {
      rootMargin: "0px",
      threshold: 0.2
    };
    var observer = new IntersectionObserver(observerCallback, observerOptions);
    function observerCallback(entries, observer2) {
      entries.forEach((entry) => {
        const node = entry.target;
        if (entry.isIntersecting) {
          node.classList.add("animated");
          return;
        }
      });
    }
    let target = ".animation-item";
    document.querySelectorAll(target).forEach((i) => {
      if (i) {
        observer.observe(i);
      }
    });
    $(".menu-open-btn").click(function(e) {
      e.preventDefault();
      $(".main-nav--div").addClass("open");
      $("body").addClass("overflow-hidden");
    });
    $(".menu-close-btn").click(function(e) {
      e.preventDefault();
      $(".main-nav--div").removeClass("open");
      $("body").removeClass("overflow-hidden");
    });
    $(".menu-right-btn").click(function(e) {
      e.preventDefault();
      $(this).siblings(".mega-menu").addClass("active");
      $(this).siblings(".dropdown-menu").addClass("active");
    });
    $(".menu-back-btn").click(function(e) {
      e.preventDefault();
      $(this).parents(".mega-menu").removeClass("active");
      $(this).parents(".dropdown-menu").removeClass("active");
    });
    $(".col-header--btn").click(function(e) {
      e.preventDefault();
      $(".main-nav--div").removeClass("open");
      $("body").removeClass("overflow-hidden");
    });
    $(".menu-search-btn").click(function(e) {
      e.preventDefault();
      $("#mobile-search").show();
      $("#searchform-mobile-input").focus();
    });
    $("#close-mobile-searchform").click(function(e) {
      e.preventDefault();
      $("#mobile-search").hide();
    });
  });
})();
