(function ($) {
  $.fn.menumaker = function (options) {
    var wpdevartmobilemenu = $(this), settings = $.extend({
      format: "dropdown",
      sticky: false
    }, options);
    return this.each(function () {
      /* Main-menu open buttons */
      $(this).find(".wpdevartmobilemenubutton").on('click', function () {
        $(this).toggleClass('menu-opened');
        var mainmenu = $(this).next('ul');
        if (mainmenu.hasClass('open')) {
          mainmenu.slideToggle().removeClass('open');
        }
        else {
          mainmenu.slideToggle().addClass('open');
          if (settings.format === "dropdown") {
            mainmenu.find('ul').show();
          }
        }
      });

      /* Sub-menu open buttons */
      wpdevartmobilemenu.find('li ul').parent().addClass('has-sub');
      multiTg = function () {
        wpdevartmobilemenu.find(".has-sub").prepend('<button class="wpdevart-submenu-button wpdevart-mobile-icon-button"></button>');
        wpdevartmobilemenu.find('.wpdevart-submenu-button').on('click', function () {
          $(this).toggleClass('submenu-opened');
          if ($(this).siblings('ul').hasClass('open')) {
            $(this).siblings('ul').removeClass('open').slideToggle();
          }
          else {
            $(this).siblings('ul').addClass('open').slideToggle();
          }
        });
      };
      if (settings.format === 'multitoggle') multiTg();
      else wpdevartmobilemenu.addClass('dropdown');
      if (settings.sticky === true) wpdevartmobilemenu.css('position', 'fixed');
    });
  };
})(jQuery);
/* Menu main and sub open buttons function */
(function ($) {
  $(document).ready(function () {
    $("#wpdevartmobilemenu").menumaker({
      format: "multitoggle"
    });
  });
})(jQuery);

const wpdevartMenuTrapFocus = (e) => {
  const wpdevartMenuFocusableElements = Array.from(
    e.querySelectorAll(
      'a[href]:not([disabled]), button.wpdevart-submenu-button:not([disabled]), button.wpdevartmobilemenubutton:not([disabled])'
    )
  );
  const wpdevartMenuFirstFocusableElement = wpdevartMenuFocusableElements[0];
  const wpdevartMenuLastFocusableElement = wpdevartMenuFocusableElements[wpdevartMenuFocusableElements.length - 1];

  const wpdevartMobileMenuLastA = Array.from(
    e.querySelectorAll(
      'a.wpdevart-menu-items-color:not([disabled])'
    )
  );
  const wpdevartMenuLastParentA = wpdevartMobileMenuLastA[wpdevartMobileMenuLastA.length - 1];

  const wpdevartMenuLastSubA = Array.from(
    e.querySelectorAll(
      'a.wpdevart-sub-menu-link-color:not([disabled])'
    )
  );
  const wpdevartMobileMenuLastSubA = wpdevartMenuLastSubA[wpdevartMenuLastSubA.length - 1];

  const wpdevartMenuLastFocusableElements = Array.from(
    e.querySelectorAll(
      'li.dropdown.has-sub:not(.dropdown-submenu):not([disabled])'
    )
  );
  if (wpdevartMenuLastFocusableElements.length != 0) {
  const wpdevartMenuLastSamurai = wpdevartMenuLastFocusableElements[wpdevartMenuLastFocusableElements.length - 1];
  var wpdevartLastFocusEl = wpdevartMenuLastSamurai.querySelector('button.wpdevart-submenu-button:not([disabled])');
  }

  const wpdevartHandleMenuFocus = e => {
    e.preventDefault();
    if (wpdevartMenuFocusableElements.includes(e.target)) {
      wpdevartMenuCurrentFocusElement = e.target;
    } else {
      if ((wpdevartMenuCurrentFocusElement === wpdevartMenuFirstFocusableElement) && (JSON.stringify(wpdevartMenuLastParentA['attributes'].length) > 2)) {

        if (JSON.stringify(wpdevartLastFocusEl['classList'].length) > 2) {
          wpdevartMobileMenuLastSubA.focus();
        }
        else {
          wpdevartMenuLastParentA.focus();
        }
      }
      else if ((wpdevartMenuCurrentFocusElement === wpdevartMenuFirstFocusableElement) && (JSON.stringify(wpdevartMenuLastParentA['attributes'].length) <= 2)) {
        wpdevartMenuLastFocusableElement.focus();
      }
      else {
        wpdevartMenuFirstFocusableElement.focus();
      }
    }
  };
  document.addEventListener("focus", wpdevartHandleMenuFocus, true);
};
const wpdevartMenuToggleModal = ((e) => {
  const wpdevartmenumodal = document.getElementById("wpdevartmobilemenu");
  trapped = wpdevartMenuTrapFocus(wpdevartmenumodal);
})

/* Sliding text */
if (document.querySelector(".sliding-text ul") != null ) {
  
  const {children: subTitles} = document.querySelector(".sliding-text ul");
  const txtsLen = subTitles.length;
  let index = 0;
  const textInTimer = 3200;
  const textOutTimer = 3000;

  function animateText() {
    for (let i = 0; i < txtsLen; i++) {
      subTitles[i].classList.remove("text-in", "text-out");
    }
    subTitles[index].classList.add("text-in");

    setTimeout(function () {
      subTitles[index].classList.add("text-out");
    }, textOutTimer);

    setTimeout(function () {
      if (index == txtsLen - 1) {
        index = 0;
      } else {
        index++;
      }
      animateText();
    }, textInTimer);
  }

  window.onload = animateText;

}
/* Back to top button */
jQuery(function ($) {
  var wpdevartbtntop = $('#wpdevart-back-to-top-button');
  $(window).scroll(function () {
    if ($(window).scrollTop() > 200) {
      wpdevartbtntop.addClass('show');
    } else {
      wpdevartbtntop.removeClass('show');
    }
  });
  wpdevartbtntop.on('click', function (e) {
    e.preventDefault();
    $('html, body').animate({ scrollTop: 0 }, '200');
  });
})