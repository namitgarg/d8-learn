/* 
 * @fileOverview Js file for Leadership view under about us Menu
 */
(function ($) {
  $(document).ready(function () {
     $(document).bind('cbox_open', function() {
       $('body').addClass('cboxOpen');
    });
    $(document).bind('cbox_closed', function() {
      $('body').removeClass('cboxOpen');

    });
   // $('.view-leadership.view-display-id-block_1 .views-row .views-field-nothing-1').hide();
  });
})(jQuery);