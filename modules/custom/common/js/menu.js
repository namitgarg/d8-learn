(function ($) {
  $(document).ready(function () {
    menuChildren();
    
    menuMobile();
  
  });

function menuMobile() {
  // open active page on accordion menu
    if ($(window).width() < 1200) {
      $('.navbar-toggle').on('click', function (e) {
        setTimeout(function () {
          var url = window.location.href;
          $('.navbar a').each(function () {
            if (this.href == url)
            {
              $(this).closest('ul.dropdown-menu').parent('li.dropdown').addClass('open')

            }
          })
        }, "50");
      });
      
      //change dropdown for parent menu so that toggle instead of naviagting
      $('.navbar li.expanded').children('a').each(function () {
        $(this).attr('data-toggle','dropdown');
        
      });
      
    }
}


function menuChildren(){
  if ($(window).width() >= 1200) {
    $('.subMenu').hide();
   $('#block-pacira-main-menu-menu .navbar-nav li.expanded.dropdown>a').css("pointer-events", "none");
// shows sub menu when you click on a parent item
    $('.navbar-nav li.expanded.dropdown').on('click', function (e) {
//      $(this).addClass('open');
      $('.subMenu').show();
      $(this).children('.dropdown-menu').css('display', 'block');
      $('.navbar-nav li.expanded.dropdown').not(this).children('ul.dropdown-menu').css("display", "none");
      $('.navbar-nav li.expanded.dropdown').not(this).removeClass('open');
    });
    // when you hover on a parent menu item hide submmenu for other
    $('.navbar-nav li.expanded.dropdown').on('mouseenter', function (e) {
      $('.subMenu').show();
      $(this).children('.dropdown-menu').css('display', 'block');
      $('.navbar-nav li.expanded.dropdown').not(this).children('ul.dropdown-menu').css("display", "none");
      $('.navbar-nav li.expanded.dropdown').not(this).removeClass('open');
    });
    // hide sub menu when you leave the navigation section
    $('.navbar-nav li.expanded.dropdown').on('mouseleave', function (e) {
      if ($('.navbar-nav li.expanded.dropdown.open').length == 0)
      {
        $('.subMenu').hide();
        $('.navbar-nav li.expanded.dropdown ul.dropdown-menu').css('display', 'none');
      }
    });
    //  hide submenu when click outside of the navigation
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