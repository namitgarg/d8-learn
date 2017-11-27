(function ($) {
  $(document).ready(function () {
    menuChildren();
  
  });




function menuChildren(){
  if ($(window).width() >= 1200) {
    $('.subMenu').hide();
   $('#block-pacira-main-menu-menu .navbar-nav li.expanded.dropdown>a').css("pointer-events", "none");

    $('.navbar-nav li.expanded.dropdown').on('click', function (e) {
//      $(this).addClass('open');
      $('.subMenu').show();
      $(this).children('.dropdown-menu').css('display', 'block');
      $('.navbar-nav li.expanded.dropdown').not(this).children('ul.dropdown-menu').css("display", "none");
      $('.navbar-nav li.expanded.dropdown').not(this).removeClass('open');
    });
    $('.navbar-nav li.expanded.dropdown').on('mouseenter', function (e) {
      $('.subMenu').show();
      $(this).children('.dropdown-menu').css('display', 'block');
      $('.navbar-nav li.expanded.dropdown').not(this).children('ul.dropdown-menu').css("display", "none");
      $('.navbar-nav li.expanded.dropdown').not(this).removeClass('open');
    });
    $('.navbar-nav li.expanded.dropdown').on('mouseleave', function (e) {
      if ($('.navbar-nav li.expanded.dropdown.open').length == 0)
      {
        $('.subMenu').hide();
        $('.navbar-nav li.expanded.dropdown ul.dropdown-menu').css('display', 'none');
      }
    });
    $('body').on('click', function (e) {
      if ($('.navbar-nav').has(e.target).length > 0) { //
      } else {
        $('.navbar-nav li.expanded.dropdown ul.dropdown-menu').css('display', 'none');
        $('.subMenu').hide();
      }
    });
}
}
})(jQuery);