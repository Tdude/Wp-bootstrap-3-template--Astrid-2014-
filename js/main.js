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
   $(".carousel").carousel({
          interval: 10000,
          pause: "hover"
      });


    // CAROUSEL THUMBNAILS
  $('[id^=carousel-selector-]').click( function(){
    var id_selector = $(this).attr("id");
    var id = id_selector.substr(id_selector.length -1);
    id = parseInt(id);
    $('#header').carousel(id);
    $('[id^=carousel-selector-]').removeClass('selected');
    $(this).addClass('selected');
  });

  // when the carousel slides, auto update
  $('#header').on('slid', function (e) {
    var id = $('.item.active').data('slide-number');
    id = parseInt(id);
    $('[id^=carousel-selector-]').removeClass('selected');
    $('[id^=carousel-selector-'+id+']').addClass('selected');
  });





    // CAROUSEL NEWSPAGE ONHOVER SHOW TEXT

  $('.carousel-onhover').hover( 
    function() {
      $('.item-active').addClass( 'col-md-4' );
      $('.animated').addClass( 'col-md-6' );
    }, 
    function() {
      $('.animated').removeClass( 'col-md-6' );
      $('.item-active').removeClass( 'col-md-4' );

    }
  );




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
