(function($) {
  "use strict"; // Start of use strict

  var popup_choice = 0;

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    // if ($(window).width() < 1024) {
    //   $('.sidebar .collapse').collapse('hide');
    // };
    
    // Toggle the side navigation when window is resized below 480px
    if ($(window).width() < 1024 && ! $(".sidebar").hasClass("toggled")) {
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
      if ($(".sidebar").hasClass("toggled")) {
        $('.sidebar .collapse').collapse('hide');
      };
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 1024) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', (e) => {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

  $(document).ready(() => {
    $('#popup').modal({backdrop: 'static', keyboard: false});
    // console.log("Document is ready!");
  });

  $('#popup').on('hidden.bs.modal', () => {
    console.log("Popup is closing now!");
    if (popup_choice === 0) {
      $('#popup').modal({backdrop: 'static', keyboard: false});
    }

    $.ajax({
      url: "/views/Home/popup.php",
      method: 'POST',
      success: data => {
        console.log("popup submition succeeded!");
      },
      statusCode: {
        404: () => { console.log( "popup failed to submit: 404! page not found." ); }
      }
    }).done(function() {
      $( this ).addClass( "done" );
    });
    popup_choice = 0;
  });

  $(document).on('click', '#popup .btn-accept', e => {
    popup_choice = 1;
    $('#popup').modal('hide');
  });

  $(document).on('click', '#popup .btn-decline', e => {
    popup_choice = 2;
    $('#popup').modal('hide');
  });

 })(jQuery); // End of use strict
