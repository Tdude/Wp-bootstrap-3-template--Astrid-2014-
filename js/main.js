// TEXTFILLSIZER
//  (function($) {
//      $.fn.textfill = function(maxFontSize, maxWords) {
//          maxFontSize = parseInt(maxFontSize, 10);
//          maxWords = parseInt(maxWords, 10) || 3;
//          return this.each(function(){
//              var self = $(this),
//                  orgText = self.text(),
//                  fontSize = parseInt(self.css("fontSize"), 10),
//                  //lineHeight = parseInt(self.css("lineHeight"), 10),
//                  maxHeight = self.height(),
//                  maxWidth = self.width(),
//                  words = self.text().split(" ");
//              
//              function calcSize(text) {
//                  var ourText = $("<span>"+text+"</span>").appendTo(self),
//                      multiplier = maxWidth/ourText.width(),
//                      newSize = fontSize*(multiplier-0.1);
//                  ourText.css(
//                      "fontSize", 
//                      (maxFontSize > 0 && newSize > maxFontSize) ? 
//                          maxFontSize : 
//                          newSize
//                  );
//                  var scrollHeight = self[0].scrollHeight;
//                  if (scrollHeight  > maxHeight) {
//                      multiplier = maxHeight/scrollHeight;
//                      newSize = (newSize*multiplier);
//                      ourText.css(
//                          "fontSize", 
//                          (maxFontSize > 0 && newSize > maxFontSize) ? 
//                              maxFontSize : 
//                              newSize
//                      );
//                  }
//              }
//              self.empty();
//              if (words.length > maxWords) {
//                  while (words.length > 0) {
//                      var newText = words.splice(0, maxWords).join(" ");
//                      console.log
//                      calcSize(newText);
//                      self.append("<br>");
//                  }
//              } else {
//                  calcSize(orgText);
//              }
//          });
//      };
//  })(jQuery);
//  
//  // Just a little text or much text w linebrakes?
//  $(function(){
//      $(".textfill.little").textfill();
//      $(".textfill.much").textfill(0, 25);
//  });






//Scroll Animation for About
$(function() {
    //caches a jQuery object containing the header element
    var animate = $("#progress");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 825) {
            animate.removeClass('display-none').addClass("display");
        } 
    });
});


!function ($) {
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

// FIPIMG/FADE HOVER
$('.img-container-hover').hover(function() {
  $( this ).toggleClass( 'active', 1000, 'fade' );
});



////////////////// TEST FOR MENU /////////////////////////////////////

$('ul.dropdown-menu [data-toggle=dropdown]').on('hover', function(event) {
    // Avoid following the href location when clicking
    event.preventDefault(); 
    // Avoid having the menu to close when clicking
    event.stopPropagation(); 
    // If a menu is already open we close it
    //$('ul.dropdown-menu [data-toggle=dropdown]').parent().removeClass('open');
    // opening the one you clicked on
    $(this).parent().addClass('open');

    var menu = $(this).parent().find('ul');
    var menupos = menu.offset();
  
    if ((menupos.left + menu.width()) + 30 > $(window).width()) {
        var newpos = - menu.width();      
    } else {
        var newpos = $(this).parent().width();
    }
    menu.css({ left:newpos });

});



}(window.jQuery)




// ANALYTICS
// (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
// (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
// m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
// })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
// ga('create', 'UA-46805298-2', 'astrid.se');
// ga('send', 'pageview');
