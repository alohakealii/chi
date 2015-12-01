$(document).ready(function() {
  $('#index-title').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
      $("#index-start").addClass("animated wobble").delay(1000).queue(function(next){
        $('#index-start').removeClass("animated wobble");
        next();
      });

      window.setInterval(function() {
        $("#index-start").addClass("animated wobble").delay(1000).queue(function(next){
        $('#index-start').removeClass("animated wobble");
        next();
        });
    }, 10000);

  });
  
});

