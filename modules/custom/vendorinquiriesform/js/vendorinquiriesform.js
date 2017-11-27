/**
 * @file
 * Defines Javascript behaviors for the module.
 */

(function ($) {
  $(document).ready(function () {
    window.setInterval(recaptchaCheck, 500);
    $('#edit-country').select2({
      minimumResultsForSearch: Infinity,
      placeholder: 'Select an option',
      dropdownParent: $('.form-item-country'),
    });
    $('#edit-state').select2({
      minimumResultsForSearch: Infinity,
      placeholder: 'Select an option',
      dropdownParent: $('.form-item-state'),
    });
    $('#edit-industry').select2({
      minimumResultsForSearch: Infinity,
      placeholder: 'Select an option',
      dropdownParent: $('.form-item-industry'),
    });
  });
  requiredValidation();
  SubmitValidation();

  /*
   * Captures the keyup and select event on a form if it has a error.
   */
  function requiredValidation() {
    if ($('form#webform-submission-vendor-form-node-48-form').hasClass('error'))
    {
      $('#edit-first-name').on('keyup', function (e) {
        fieldRequiredValidation('#edit-first-name', '.form-item-first-name', 'Please enter your First Name');
      });
      $('#edit-last-name').on('keyup', function (e) {
        fieldRequiredValidation('#edit-last-name', '.form-item-last-name', 'Please enter your Last Name');
      });
      $('#edit-title').on('keyup', function (e) {
        fieldRequiredValidation('#edit-title', '.form-item-title', 'Please enter your Title');
      });
      $('#edit-company').on('keyup', function (e) {
        fieldRequiredValidation('#edit-company', '.form-item-company', 'Please enter your Company');
      });
      $('#edit-phone').on('keyup', function (e) {
        phoneValidation('#edit-phone', '.form-item-phone', 'Phone Number');
      });

      $('#edit-email-address').on('keyup', function (e) {
        emailValidation('#edit-email-address', '.form-item-email-address');
      });

    }
  }

  /*
   * Required validation for individual fields.
   */
  function fieldRequiredValidation(inputIdSelector, formItemClass, errorMessage) {

    if ($(inputIdSelector).val() == '')
    {
      if ($(formItemClass + ' label.error').length < 1)
      {
        $(inputIdSelector).before('<label class="error">' + errorMessage + '</label>');
      } else {
        //console.log($(formItemClass+' label.error'));
        $(formItemClass + ' label.error').text(errorMessage);
      }
      $(formItemClass + ' label.error').css('display', 'inline-block');
      $(formItemClass).addClass('error has-error');
    } else
    {
      $(formItemClass + ' label.error').css('display', 'none');
      $(formItemClass).removeClass('error has-error');
    }
  }


  /*
   * Validation function for zipcode.
   */
  function zipcodeValidation(inputIdSelector, formItemClass) {
    var isnum = /^\d+$/.test($(inputIdSelector).val());
    if ($(inputIdSelector).val().length > 0) {
      if (($(inputIdSelector).val().length != 5 || (!isnum))) {
        if ($(formItemClass + ' label.error').length < 1)
        {
          $(inputIdSelector).before('<label class="error">Please enter valid Zipcode</label>');
        } else {
          $(formItemClass + ' label.error').text('Please enter valid Zipcode');
        }
        $(formItemClass + ' label.error').css('display', 'inline-block');
        $(formItemClass).addClass('error has-error');
      } else
      {
        $(formItemClass + ' label.error').css('display', 'none');
        $(formItemClass).removeClass('error has-error');
      }
    } else {
      if ($(formItemClass + ' label.error').length < 1)
      {
        $(inputIdSelector).before('<label class="error">Please enter your Zipcode</label>');
      } else {
        //console.log($(formItemClass+' label.error'));
        $(formItemClass + ' label.error').text('Please enter your Zipcode');
      }
      $(formItemClass + ' label.error').css('display', 'inline-block');
      $(formItemClass).addClass('error has-error');
    }
  }

  /*
   * Validation function for phone number field
   */
  function phoneValidation(inputIdSelector, formItemClass, fieldLabel) {
    var isnum = /^\d+$/.test($(inputIdSelector).val());
    if ($(inputIdSelector).val().length > 0) {
      if (($(inputIdSelector).val().length < 10 || $(inputIdSelector).val().length > 15 || (!isnum))) {
        if ($(formItemClass + ' label.error').length < 1)
        {
          $(inputIdSelector).before('<label class="error">Please enter valid ' + fieldLabel + '</label>');
        } else {
          $(formItemClass + ' label.error').text('Please enter valid ' + fieldLabel);
        }
        $(formItemClass + ' label.error').css('display', 'inline-block');
        $(formItemClass).addClass('error has-error');
      } else
      {
        $(formItemClass + ' label.error').css('display', 'none');
        $(formItemClass).removeClass('error has-error');
      }
    } else if ($(inputIdSelector).val().length == 0) {
      if ($(formItemClass + ' label.error').length < 1)
      {
        $(inputIdSelector).before('<label class="error">Please enter your ' + fieldLabel + '</label>');
      } else {
        //console.log($(formItemClass+' label.error'));
        $(formItemClass + ' label.error').text('Please enter your ' + fieldLabel);
      }
      $(formItemClass + ' label.error').css('display', 'inline-block');
      $(formItemClass).addClass('error has-error');
    }

  }

  /*
   * Email field Validtion.
   */
  function emailValidation(inputIdSelector, formItemClass)
  {
    var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{1,10}$/;
    var emailCheck = filter.test($(inputIdSelector).val());

    if ($(inputIdSelector).val().length > 0)
    {
      if (!emailCheck)
      {
        if ($(formItemClass + ' label.error').length < 1)
        {
          $(inputIdSelector).before('<label class="error">Please enter valid Email Address</label>');
        } else {
          $(formItemClass + ' label.error').text('Please enter valid Email Address');
        }
        $(formItemClass + ' label.error').css('display', 'inline-block');
        $(formItemClass).addClass('error has-error');
      } else {
        $(formItemClass + ' label.error').css('display', 'none');
        $(formItemClass).removeClass('error has-error');
      }

    } else
    {
      if ($(formItemClass + ' label.error').length < 1)
      {
        $(inputIdSelector).before('<label class="error">Please enter your Email Address</label>');
      } else {
        //console.log($(formItemClass+' label.error'));
        $(formItemClass + ' label.error').text('Please enter your Email Address');
      }
      $(formItemClass + ' label.error').css('display', 'inline-block');
      $(formItemClass).addClass('error has-error');
    }

  }

  /*
   *called when you click on submit form
   */
  function SubmitValidation() {
    $('button.webform-button--submit').on('click', function (e) {
      fieldRequiredValidation('#edit-first-name', '.form-item-first-name', 'Please enter your First Name');
      fieldRequiredValidation('#edit-last-name', '.form-item-last-name', 'Please enter your Last Name');
      fieldRequiredValidation('#edit-title', '.form-item-title', 'Please enter your Title');
      fieldRequiredValidation('#edit-company', '.form-item-company', 'Please enter your Company');
      phoneValidation('#edit-phone', '.form-item-phone', 'Phone Number');
      emailValidation('#edit-email-address', '.form-item-email-address');

// recpatcha code 
      var response = grecaptcha.getResponse();
      if (response) {
        //captcha validated and got response code
        $('.captcha label.error').css('display', 'none');
        $('.g-recaptcha').removeClass('error has-error');
      } else {
        //not validated or not clicked
        if ($('.captcha label.error').length < 1)
        {
          $('.g-recaptcha').after('<label class="error">Please Fill Captcha</label>');
        } else
        {
          $('.captcha label.error').text('Please Fill Captcha');
        }
        $('.captcha label.error').css('display', 'inline-block');
        $('.g-recaptcha').addClass('error has-error');
        e.preventDefault();
      }
      $('form#webform-submission-vendor-form-node-48-form').each(function () {
        if ($('.form-item.error').length >= 1) {
          $('form#webform-submission-vendor-form-node-48-form').addClass('error');
          $('html, body').animate({
            scrollTop: $(".form-item +.error").offset().top - 250
          }, 1000);
          e.preventDefault();
          requiredValidation();
        } else {
          $('form#webform-submission-vendor-form-node-48-form').removeClass('error');
        }
      });
    });
  }


  /*
   * Check captcha after 500 milli seconds
   */
  function recaptchaCheck() {

    if ($('form#webform-submission-vendor-form-node-48-form').hasClass('error'))
    {
      var response = grecaptcha.getResponse();
      if (response) {
        //captcha validated and got response code
        $('.captcha label.error').css('display', 'none');
        $('.g-recaptcha').removeClass('error has-error');
      } else {
        //not validated or not clicked
        if ($('.captcha label.error').length < 1)
        {
          $('.g-recaptcha').after('<label class="error">Please Fill Captcha</label>');
        } else
        {
          $('.captcha label.error').text('Please Fill Captcha');
        }
        $('.captcha label.error').css('display', 'inline-block');
        $('.g-recaptcha').addClass('error has-error');
      }
    }
  }

})(jQuery);
