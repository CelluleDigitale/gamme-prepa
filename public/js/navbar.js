document.addEventListener("DOMContentLoaded", function () {
  $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 50) {
      $('.navbar').addClass('fixed-top');
    } else {
      $('.navbar').removeClass('fixed-top');
    }
  });
});