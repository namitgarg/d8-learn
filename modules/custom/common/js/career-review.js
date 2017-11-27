/**
 * @file
 * Defines Javascript behaviors for the module.
 */

(function ($) {
  $(document).ready(function () {
    reviewImageSize();

  });
  $(window).resize(function () {
    reviewImageSize();
  });


  function  reviewImageSize() {
      var desktopBanner = $('.block-views-blockcareer-page-reviews-block-1 .view-content .views-row .views-field-field-reviewer-desktop-image').text();
      var mobileBanner = $('.block-views-blockcareer-page-reviews-block-1 .view-content .views-row .views-field-field-reviewer-mobile-image').text();
      var ipadBanner = $('.block-views-blockcareer-page-reviews-block-1 .view-content .views-row .views-field-field-reviewer-ipad-image').text();
      if ($(window).width() > 1439)
      {
       $('.block-views-blockcareer-page-reviews-block-1 .view-content .views-row .views-field-nothing .review-image img').attr("src", desktopBanner);
      } else if($(window).width() < 1199) {
        $('.block-views-blockcareer-page-reviews-block-1 .view-content .views-row .views-field-nothing .review-image img').attr("src", mobileBanner);
      }
      else{
        $('.block-views-blockcareer-page-reviews-block-1 .view-content .views-row .views-field-nothing .review-image img').attr("src", ipadBanner);
      }
  }
})(jQuery)