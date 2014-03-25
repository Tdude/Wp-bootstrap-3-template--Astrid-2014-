!function ($) {

/*

/////////// TEST AV ISOTOPE
$('.container').isotope({
  // options
  itemSelector : '.col-md-3',
  layoutMode : 'fitRows'
});


*/



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


//
 //     // MASONRY
 //     var container = document.querySelector('#container-masonry');
 //     var msnry = new Masonry( container, {
 //       // options
 //       columnWidth: 200,
 //       itemSelector: '.div-masonry'
 //     });

var $container = $('#container-masonry');
// initialize
$container.masonry({
  columnWidth: 200,
  itemSelector: '.div-masonry'
});


var msnry = $container.data('masonry');




  // END DOC READY
  });






getImageSizes();
$(window).resize(function() { //Fires when window is resized
    getImageSizes();
});

function getImageSizes() {
    $(".img-responsive").each(function() {
        var height = $(this).height() ;
         $('.flipimg-hover').css('height', height);
         console.log (height);
    });
}




}(window.jQuery)
