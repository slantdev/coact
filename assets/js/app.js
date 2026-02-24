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
      $(this).attr("aria-expanded", "true");
      $(".menu-close-btn").focus();
      trapFocus($(".main-nav--div"));
    });
    $(".menu-close-btn").click(function(e) {
      e.preventDefault();
      closeMobileMenu();
    });
    function closeMobileMenu() {
      $(".main-nav--div").removeClass("open");
      $("body").removeClass("overflow-hidden");
      $(".menu-open-btn").attr("aria-expanded", "false").focus();
      untrapFocus();
    }
    $(".menu-right-btn").click(function(e) {
      e.preventDefault();
      $(this).attr("aria-expanded", "true");
      $(this).siblings(".mega-menu").addClass("active");
      $(this).siblings(".dropdown-menu").addClass("active");
      $(this).siblings(".mega-menu, .dropdown-menu").find(".menu-back-btn").focus();
    });
    $(".menu-back-btn").click(function(e) {
      e.preventDefault();
      var $parentMenu = $(this).parents(".mega-menu, .dropdown-menu");
      $parentMenu.removeClass("active");
      $parentMenu.siblings(".menu-right-btn").attr("aria-expanded", "false").focus();
    });
    $(".menu-search-btn").click(function(e) {
      e.preventDefault();
      $("#mobile-search").show();
      $(this).attr("aria-expanded", "true");
      $("#searchform-mobile-input").focus();
    });
    $("#close-mobile-searchform").click(function(e) {
      e.preventDefault();
      closeMobileSearch();
    });
    function closeMobileSearch() {
      $("#mobile-search").hide();
      $(".menu-search-btn").attr("aria-expanded", "false").focus();
    }
    $(document).on("click", ".faq-toggle-btn", function(e) {
      e.preventDefault();
      const $btn = $(this);
      const $content = $("#" + $btn.attr("aria-controls"));
      const isExpanded = $btn.attr("aria-expanded") === "true";
      $btn.attr("aria-expanded", !isExpanded);
      $content.toggleClass("hidden");
      if (!isExpanded) {
        setTimeout(() => {
          $("html, body").animate({
            scrollTop: $btn.offset().top - 100
          }, 200);
        }, 100);
      }
    });
    $(document).keydown(function(e) {
      if (e.key === "Escape") {
        if ($(".main-nav--div").hasClass("open")) {
          closeMobileMenu();
        }
        if ($("#mobile-search").is(":visible")) {
          closeMobileSearch();
        }
      }
    });
    let tabHandler;
    function trapFocus($element) {
      const focusableElements = $element.find('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
      const firstFocusableElement = focusableElements[0];
      const lastFocusableElement = focusableElements[focusableElements.length - 1];
      tabHandler = function(e) {
        if (e.key === "Tab") {
          if (e.shiftKey) {
            if (document.activeElement === firstFocusableElement) {
              lastFocusableElement.focus();
              e.preventDefault();
            }
          } else {
            if (document.activeElement === lastFocusableElement) {
              firstFocusableElement.focus();
              e.preventDefault();
            }
          }
        }
      };
      $(document).on("keydown", tabHandler);
    }
    function untrapFocus() {
      $(document).off("keydown", tabHandler);
    }
  });
})();
