var myOptions = {
//    // you can declare a default color here,
//    // or in the data-default-color attribute on the input
    defaultColor: '#effeff',
//    // a callback to fire whenever the color changes to a valid color
//    change: function(event, ui){},
//    // a callback to fire when the input is emptied or an invalid color
//    clear: function() {},
//    // hide the color picker controls on load

//    // show a group of common colors beneath the square
//    // or, supply an array of colors to customize further
hide: false, // hide/show the color picker by default
palettes: ['#125', '#459', '#78b', '#ab0', '#de3', '#f0f'] // custom palette

};
 
$('.my-color-field').wpColorPicker(myOptions);


jQuery(document).ready(function($){

    $('.my-color-field').wpColorPicker();
    
});