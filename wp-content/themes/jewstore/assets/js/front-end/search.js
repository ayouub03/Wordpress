document.getElementById("wpdevartwidesearchbutton").addEventListener("click", function(){
    setTimeout(function() { jQuery('#wpdevartfocusonoverlayinputwide').focus() }, 50);
});
const wpdevartTrapFocus = (element, prevFocusableElement = document.activeElement) => {
    const wpdevartFocusableElements = Array.from(
    element.querySelectorAll(
    'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="search"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])'
    )
    );
    const wpdevartFirstFocusableElement = wpdevartFocusableElements[0];
    const wpdevartLastFocusableElement = wpdevartFocusableElements[wpdevartFocusableElements.length - 1];
    let wpdevartCurrentFocusElement = null;

    wpdevartFirstFocusableElement.focus();
    wpdevartCurrentFocusElement = wpdevartFirstFocusableElement;

    const wpdevartHandleFocus = e => {
    e.preventDefault();
    if (wpdevartFocusableElements.includes(e.target)) {
        wpdevartCurrentFocusElement = e.target;
    } else {
    if (wpdevartCurrentFocusElement === wpdevartFirstFocusableElement) {
        wpdevartLastFocusableElement.focus();
    } else {
        wpdevartFirstFocusableElement.focus();
    }
    wpdevartCurrentFocusElement = document.activeElement;
    }
    };
    document.addEventListener("focus", wpdevartHandleFocus, true);
    return {
    onClose: () => {
    document.removeEventListener("focus", wpdevartHandleFocus, true);
    prevFocusableElement.focus();
    }
    };
    };
    const wpdevartToggleModal = ((e) => {
    const wpdevartmodal = document.getElementById("wpdevartModalContainer");
    if (wpdevartmodal.classList != ('wpdevart-search-overlay-show-on-click')) {
    wpdevartmodal.classList.toggle("wpdevart-search-overlay-show-on-click");
    trapped = wpdevartTrapFocus(wpdevartmodal);
    } else {
    trapped.onClose();
    } 
})
document.getElementById("restoresearchbuttonfocus").addEventListener("click", function(){
  setTimeout(function() { document.getElementById("wpdevartwidesearchbutton").focus() }, 300);
});
/* Search Overlay for mobile devices */
document.getElementById("wpdevartsmallsearchbutton").addEventListener("click", function(){
    setTimeout(function() { jQuery('#wpdevartfocusonoverlayinputsmall').focus() }, 50);
});

const wpdevartTrapFocusSmall = (element, prevFocusableElement = document.activeElement) => {
    const wpdevartFocusableElements = Array.from(
    element.querySelectorAll(
      'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="search"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])'
    )
    );
    const wpdevartFirstFocusableElement = wpdevartFocusableElements[0];
    const wpdevartLastFocusableElement = wpdevartFocusableElements[wpdevartFocusableElements.length - 1];
    let wpdevartCurrentFocusElement = null;
    
    wpdevartFirstFocusableElement.focus();
    wpdevartCurrentFocusElement = wpdevartFirstFocusableElement;
    
    const wpdevartHandleFocus = e => {
    e.preventDefault();
    if (wpdevartFocusableElements.includes(e.target)) {
        wpdevartCurrentFocusElement = e.target;
    } else {
      if (wpdevartCurrentFocusElement === wpdevartFirstFocusableElement) {
        wpdevartLastFocusableElement.focus();
      } else {
        wpdevartFirstFocusableElement.focus();
      }
      wpdevartCurrentFocusElement = document.activeElement;
    }
    };
    document.addEventListener("focus", wpdevartHandleFocus, true);
    return {
    onClose: () => {
      document.removeEventListener("focus", wpdevartHandleFocus, true);
      prevFocusableElement.focus();
    }
    };
    };
    
    const wpdevartToggleModalSmall = ((e) => {
    const wpdevartmodalsmall = document.getElementById("wpdevartModalContainerSmall");
    if (wpdevartmodalsmall.classList != ('wpdevart-search-overlay-show-on-click')) {
    wpdevartmodalsmall.classList.toggle("wpdevart-search-overlay-show-on-click");
    trapped = wpdevartTrapFocusSmall(wpdevartmodalsmall);
    } else {
    trapped.onClose();
    } 
})
document.getElementById("restoresmallsearchbuttonfocus").addEventListener("click", function(){
  setTimeout(function() { document.getElementById("wpdevartsmallsearchbutton").focus() }, 300);
});