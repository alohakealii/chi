$(document).ready( function() {
  // init Masonry
  retrieveLocationImages();

  var $grid = $('.grid').masonry({
    itemSelector: '.grid-item',
    percentPosition: true,
    columnWidth: '.grid-sizer'
  });
  // layout Isotope after each image loads
  $grid.imagesLoaded().progress( function() {
    $grid.masonry();
  });  

  
});

function retrieveLocationImages() {
  var response = $.ajax({
    type: "POST",
    url: "php/retrieveLocationImages.php",
    async: false
    }).responseText;

  var outputArr = [];
  var images = JSON.parse(response);
  for (i = 0; i < images.length; i++) {
    var html = '<div class="grid-item"><img src="' + images[i]["imgPath"] + '"/></div>';
    outputArr [i] = html;
  }
  shuffle(outputArr);
  for (i = 0; i < outputArr.length; i++) {
    $('#grid').append(outputArr[i]);
  }
  
}