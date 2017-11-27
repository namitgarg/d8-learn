/**
 * @file
 * Defines Javascript behaviors for the module.
 */

(function ($) {
  $(document).ready(function () {
    bannersSize();

  });
  $(window).resize(function () {
    bannersSize();
  });


  function  bannersSize() {
    if (drupalSettings.custom_banners) {
      var desktopBanner = drupalSettings.custom_banners.desktopPath;
      var mobileBanner = drupalSettings.custom_banners.mobilePath;
      var ipadBanner = drupalSettings.custom_banners.ipadPath;
      if ($(window).width() > 1199)
      {
        $('.block-views-blockbanners-block-1 .view-content .views-row .views-field-field-banner-image img').attr("src", desktopBanner);
      } else if($(window).width() < 768) {
        $('.block-views-blockbanners-block-1 .view-content .views-row .views-field-field-banner-image img').attr("src", mobileBanner);
      }
      else{
        $('.block-views-blockbanners-block-1 .view-content .views-row .views-field-field-banner-image img').attr("src", ipadBanner);
      }
    }
  }
})(jQuery)