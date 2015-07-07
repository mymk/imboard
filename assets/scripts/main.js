/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
        var body = document.querySelector('body');
        var bodyClass = body.className;
        var header = document.querySelector('header');
        var headerClass = header.className;
        var bodyState = 'close';
        var options = {
          preventDefault: true,
          dragLockToAxis: true,
          dragBlockHorizontal: true
        };
        var nextPost = $('#nextPost');
        var bodyEvent = new Hammer(body, options );

        $('img').on('dragstart', function(event) { event.preventDefault(); });

        bodyEvent.on('panright swiperight', function(ev) {
          openMenu();
        });
        bodyEvent.on('panleft swipeleft', function(ev) {
          if(isOpen()){
             closeMenu();
           } 
          //else if(nextPost.length > 0){
          //   goToNextLink();
          // }
        });
        function goToNextLink(){
          window.location.href = nextPost.attr("href");
        }

        function openMenu(){
          body.className = bodyClass + ' menu--mobile--open';
          bodyState = 'open';
        }

        function isOpen(){
          if(bodyState === 'open'){
            return true;
          }
        }

        function setState(){

        }

        function closeMenu(){
          if(isOpen()){
              body.className = bodyClass;
              bodyState = 'close';
          }
        }


        if(is.not.mobile()){

          console.log('pas mobil');
            // grab an element
          
            // construct an instance of Headroom, passing the element
            var headroom  = new Headroom(header);
            // initialise
            headroom.init(); 
        }



      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS




      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
