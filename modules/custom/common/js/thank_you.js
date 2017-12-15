/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * @file
 * Defines Javascript behaviors for the module.
 */

(function ($) {
  $(document).ready(function () {
    if ($('body  #partnership-thanks').length >= 1) {
      history.pushState({page: 1}, 'Title 1', '#thank-you');
      window.onhashchange = function (event) {
        window.location.hash = 'thank-you';
      };
      if (localStorage.getItem('partnerRedirect') != 'partner-form' && window.location.pathname == '/partnership-form-thanks') {

        window.location.href = '/partnership-oppportunities';
      }
      localStorage.clear();
      localStorage.setItem('pageName', 'thankYou');
    } else if ($('body  #vendor-thanks').length >= 1) {
      history.pushState({page: 1}, 'Title 1', '#thank-you');
      window.onhashchange = function (event) {
        window.location.hash = 'thank-you';
      };
      if (localStorage.getItem('vendorRedirect') != 'vendor-form' && window.location.pathname == '/vendor-form-thanks') {

        window.location.href = '/vendor-inquiries';
      }
      localStorage.clear();
      localStorage.setItem('pageName', 'thankYou');
    }

  });
})(jQuery);