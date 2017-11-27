/**
 * @file
 * Defines Javascript behaviors for the module.
 */

(function ($) {
  $(document).ready(function () {
    initIsiTray();
    isiSeeMore();
  });
  $(window).on("resize", function (e) {
    initIsiTray();
    isiSeeMore();
  });
  function initIsiTray() {

    var t = $("#isi-tray").height();
    if ($(".isi-tray-content").length) {
      var e = $(".isi-fix-teaser").html();
      $(".isi-tray-content").html(e)
    }
    if ($(".isi-fix-content").offset() != undefined) {
      scrollBottom() >= jQuery(".isi-fix-content").offset().top + t ? jQuery("#isi-tray").hide() : jQuery("#isi-tray").show(), jQuery(window).scroll(function () {
        scrollBottom() >= jQuery(".isi-fix-content").offset().top + t ? jQuery("#isi-tray").hide() : jQuery("#isi-tray").show()
      })
    }
  }

  function isiSeeMore() {
    var page = $("html, body");
    $(".seeMore").click(function (e) {
      var scrollheight = $(".isi-fix-content").offset().top;
      page.animate({
        scrollTop: scrollheight,
      }, 800, function () {
        page.off("scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove");
      });
    })
  }
  function scrollBottom() {
    return $(window).scrollTop() + $(window).height();
  }

})(jQuery);