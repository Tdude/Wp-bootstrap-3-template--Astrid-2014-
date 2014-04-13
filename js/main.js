!function ($) {


    // Force textfill to resize line-height
    $(window).on("load resize", function(){
        var $h2 = $(".face .textfill");
        
        $h2.each(function(i,e){
            var $current = $(e),
            parentHeight = $current.parent().height(),
            fontSize     = ((parentHeight * 14) / 100);
            
            // KEEP FONTSIZE WITHIN THESE SIZES
            if (fontSize < 24) {
               fontSize = 24;
            } else if (fontSize > 30) {
               fontSize = 30;
            }

            $current.css({
                height: parentHeight,
                "line-height": parentHeight +'px',
                "font-size": fontSize + 'px'

            });
        });
        
    });





  // CAROUSEL SLIDER ANIMATION INIT
  $(function(){
    $('#header').carousel()
  })

  // FLIPIMG CLICK
  $('.img-container-grid-3').click(function() {
    //$(this).toggleClass('active');
    $( this ).toggleClass( 'active', 1000, 'fade' );
  });

  $('.img-container-grid-4').click(function() {
    $( this ).toggleClass( 'active', 1000, 'fade' );
  });

  $('.img-container-grid-6').click(function() {
    $( this ).toggleClass( 'active', 1000, 'fade' );
  });

  // FLIPIMG/FADE HOVER
  $('.img-container-hover').hover(function() {
    $( this ).toggleClass( 'active', 1000, 'fade' );
  });





  $(document).ready(function(){




      // INFOBOX SLIDE OUT ON TYGER AND NEWS
      $('#sliding-content').hide();
      $(document).on('click','.infobox', function(event) {
          $('#sliding-content').slideToggle('fast', function(){
              if ($('#sliding-content').is(':visible')) {
                  $('#sliding-footer-left').html('<a href="#" onclick="return false;" id="sliding-trigger">Stäng infoboxen &#9650;</a>');
              } else {
                  $('#sliding-footer-left').html('<a href="#" onclick="return false;" id="sliding-trigger">Mer information &#9660;</a>');
              }
          });
      });




 
  });  // END DOC READY




}(window.jQuery)
