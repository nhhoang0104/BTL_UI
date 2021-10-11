/**
 * onscroll -> change animation, style navbar(boxShadow, transition)
 */

window.onscroll = function () {
  var doc = document.documentElement;
  var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);

  if (top !== 0) {
    $("#navbar").addClass("scroll");
  } else {
    $("#navbar").removeClass("scroll");
  }
};
