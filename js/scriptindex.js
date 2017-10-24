/*$(document).ready(function() {
	carousel = $(".carousel"),
		items = $(".item"),
		currdeg  = 0; // Angle courant en degré
	setInterval(function(){rotate()}, '5000');
	function rotate(e){  //e est event.
		if (currdeg  == '-360'){
			 currdeg = currdeg + 360;
              console.log(currdeg);
              carousel.css({ // on modifie le css du carousel, on effectue une rotation sur l'axe y
                "-webkit-transform": "rotateY("+currdeg+"deg)",
                //"-moz-transform": "rotateY("+currdeg+"deg)",
                "-o-transform": "rotateY("+currdeg+"deg)",
                "transform": "rotateY("+currdeg+"deg)",
                "transition": "transform 0s"
              });
                items.css({ // on modifie le css de la classe item, on effectue une rotation sur l'axe y
                "-webkit-transform": "rotateY("+(-currdeg)+"deg)",
                //"-moz-transform": "rotateY("+(-currdeg)+"deg)",
                "-o-transform": "rotateY("+(-currdeg)+"deg)",
                "transform": "rotateY("+(-currdeg)+"deg)",
                "transition": "transform 0s"
              });
		}
		else 
		{
	      currdeg = currdeg - 120;
	      console.log(currdeg);
		  carousel.css({ // on modifie le css du carousel, on effectue une rotation sur l'axe y
			"-webkit-transform": "rotateY("+currdeg+"deg)",
			//"-moz-transform": "rotateY("+currdeg+"deg)",
			"-o-transform": "rotateY("+currdeg+"deg)",
			"transform": "rotateY("+currdeg+"deg)",
			"transition": "transform 1s"
		  });
			items.css({ // on modifie le css de la classe item, on effectue une rotation sur l'axe y
			"-webkit-transform": "rotateY("+(-currdeg)+"deg)",
			//"-moz-transform": "rotateY("+(-currdeg)+"deg)",
			"-o-transform": "rotateY("+(-currdeg)+"deg)",
			"transform": "rotateY("+(-currdeg)+"deg)",
			"transition": "transform 1s"
		  });
		}
	}
});*/

/*$(document).ready(function(){
  var docWidth = $('.carousel').width(),
      imgNb = 5,
      $images = $('#imgs');
  
  
  $(window).on('resize', function(){
    docWidth = $('.carousel').width();
    slidesWidth = $('#imgs').width();
  });
  
  $(document).mousemove(function(e) {
    var mouseX = -(e.pageX),        
        rotate = mouseX*360/docWidth;
			
    
    $images.css({
      '-webkit-transform': 'rotate3d(0,1,0,' + -rotate + 'deg)',
              'transform': 'rotate3d(0,1,0,' + -rotate + 'deg)',
    });
  });
});*/


var rotate = 0;
$(document).ready(function(){
  var docWidth = $('.carousel').width(),
      imgNb = 5,
      $images = $('#imgs');
  
		
  function salut() {
    
    $images.css({
      '-webkit-transform': 'rotate3d(0,1,0,' + -rotate + 'deg)',
              'transform': 'rotate3d(0,1,0,' + -rotate + 'deg)',
    });
  };
  temps = null;
  temps = setInterval(function(){rotate = rotate + 5; salut()},50);
  $('.container2').mouseout(function() {
  	temps = setInterval(function(){rotate = rotate + 5; salut()},50);
  });

  $(window).on('resize', function(){
    docWidth = $('.carousel').width();
    slidesWidth = $('#imgs').width();
  });

   $('.container2').mouseover(function() {
   		clearInterval(temps);
      temps = null;
      console.log(temps);

   });
  

});



