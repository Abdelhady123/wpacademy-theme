jQuery(document).ready(function($) {

    // Toggle menu on click 
   $('#navicon').click(function(e) {
        e.preventDefault();
        var menuBar = $("#menu-bar")
        var isOpen = menuBar.hasClass('active');
        menuBar.toggleClass('active')
        $('.menu-bar').toggle();
        menuBar.attr('aria-expanded', !isOpen)
        $('#navicon').toggleClass('fa-bars fa-close')
        $("body").css("overflow", isOpen ? "auto" : "hidden");
   })

   // Hide menu on click outside
   $('document').click(function(e) {
    var target = $(e.target)
    if (!target.is("#navicon") && 
    !target.parents("#primary-menu").length > 0 && 
    $("#navicon").hasClass("fa-close")) {
        $('#menu-bar').removeClass('active');
        $('.menu-bar').hide();
        $('#menu-bar').attr('aria-expanded', 'false');
        $('#navicon').toggleClass('fa-bars fa-close')
        $("body").css("overflow", "auto");
    }
   })

   // Toggle child menu on click
   $(".menu-item-has-children > a").click(function(e) {
    if ($("#menu-bar").hasClass("active")) {
        e.preventDefault()
        var childMenu = $(this).siblings("ul")
        childMenu.toggleClass("childopen")
    }
   })

   // Close child menu when clicking outside
   $(document).on('click', function(e) {
    if (!$(e.target).closest('.menu-item-has-children').length) {
        $('.menu-item-has-children > ul').removeClass('childopen');
    }
   })

   function toggleNavigation() {
    $("#site-navigation").toggleClass("main-navigation", $(window).width() > 950);
   }

   toggleNavigation();
   $(window).resize(toggleNavigation);

})