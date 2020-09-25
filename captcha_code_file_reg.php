<?php 
/*
*
* this code is based on captcha code by Anil Dubey 

*/


?>

<span class="hidemobile1"><?php echo "&nbsp"; ?></span>
<script>

var CVS = document.createElement('canvas'),
	ctx = CVS.getContext('2d');

//CVS.width  = 500;
//CVS.height = 500;
 // Add canvas to DOM

// GRAPHICS TO CANVAS /////
function sendToCanvas( ob ){
  var img = new Image();
  img.onload = function(){
    ctx.drawImage(img, 0, 0);
    ctx.font = ob.fontWeight+' '+ob.fontSize+' '+ob.fontFamily;
    ctx.textAlign = 'center';
    ctx.fillStyle = ob.color;
    ctx.fillText(ob.text, 30, 30);
  };
  img.src = ob.image;
  document.body.appendChild(CVS);
}
///////////////////////////

// DO IT! ////////////////
var cvsObj = {
    image      : "https://i.ytimg.com/vi/eq7Adzo4QAE/maxresdefault.jpg",
    text       : "<?php echo '  '.$_GET['rand']; ?>",
    fontFamily : "Arial",
    fontWeight : "bold",
    fontSize   : "20px",
    color      : "rgba(0, 0, 0, 0.7)"
};
sendToCanvas( cvsObj );   

</script>

<style>
  .hidemobile1{height:17px; display: inline-block !important; }
</style>