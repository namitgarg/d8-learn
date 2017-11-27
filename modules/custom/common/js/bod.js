/*
 * @fileOverview Js file for Board of director block under the About Us Menu
 */
(function ($) {
  $(document).ready(function () {
    $('.view-board-of-directors.view-display-id-block_1 .views-field-nothing .accord-row-wrapper .accord-row-content').hide();
    $('.view-board-of-directors.view-display-id-block_1 .views-field-nothing .accord-row-wrapper .accord-row-header').on("click", function () {
      $(this).closest('.accord-row-wrapper').toggleClass('plus minus');
      $(this).nextAll('.accord-row-content').slideToggle();
      $(this).find('.intro-body').toggle();
      $('.view-board-of-directors.view-display-id-block_1 .views-field-nothing .accord-row-wrapper .accord-row-header').not(this).nextAll('.accord-row-content').hide();
      $('.view-board-of-directors.view-display-id-block_1 .views-field-nothing .accord-row-wrapper .accord-row-header').not(this).parent('.accord-row-wrapper').removeClass('minus').addClass('plus');
      $('.view-board-of-directors.view-display-id-block_1 .views-field-nothing .accord-row-wrapper .accord-row-header').not(this).find('.intro-body').show();

    });
    
    $('.view-board-of-directors.view-display-id-block_1 .views-field-nothing .accord-row-wrapper .accord-row-content').on("click", function () { 
      $(this).slideUp();
      $(this).closest('.accord-row-wrapper').toggleClass('plus minus');
      $(this).prevAll('.accord-row-header').find('.intro-body').show();
    });
    
    // toggle sign js
     $('.view-board-of-directors.view-display-id-block_1 .views-field-nothing .accord-row-wrapper .plus-toggle').on("click", function () {
      $(this).closest('.accord-row-wrapper').toggleClass('plus minus');
      $(this).prevAll('.accord-row-content').slideToggle();
      $(this).prevAll().find('.intro-body').toggle();
      $(this).closest('.views-row').siblings().find('.accord-row-wrapper .accord-row-content').hide();
      $(this).closest('.views-row').siblings().find('.accord-row-wrapper .accord-row-header .intro-body').show();
      $(this).closest('.views-row').siblings().find('.accord-row-wrapper').removeClass('minus').addClass('plus');
      
    });
  });
})(jQuery);