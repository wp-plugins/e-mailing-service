<?php

$closing_tags=0; //Specifies whether to use closing tags (<img></img>) or short tags (XML <img />) on image elements.  Dependant upon your DOCTYPE.
$image_dirs=array('images'); //An array of image directories with relative paths from the file that include()'s this one.
$image_types=array(".png",".jpg",".gif"); //An array of image extensions to look for.  These three extensions should suffice for most.
                            
//***********************************
//* ALTER NOTHING BELOW THIS POINT! *
//***********************************

$x=0;
$i=0;

while($x<count($image_dirs))
{
  $handle=opendir($image_dirs[$x]);

  while(false!==($file=readdir($handle)))
  {
    $image_ext=substr($file,-4);
    
    if(in_array($image_ext,$image_types)) 
    { 
      $i++; ?>
      
      <img class="preload_image" src="<?php echo $image_dirs[$x].'/'.$file; ?>" style="display:none;" <?php echo ($closing_tags==1 ? "></img>":" />");
    }
  }

  $x++;
} ?>

    <script>
      $(document).ready(function()
      {
        $('.preload_image').imagemonitor(
    	{
    	  'onLoad':function(loadedImage,totalImage)
    	  {
    	    $('#loading_percentage').text(Math.floor((loadedImage/totalImage)*100));
    	    $('#loading_bar').css('width',Math.floor((loadedImage/totalImage)*100)+'%');
    	  },
    	  'onComplete':function(loadedImage)
    	  {
    	    $('#load_display').fadeOut(500).queue(function()
    	    {
    	      $('#app_display').fadeIn(500);
    	      $(this).dequeue();
        	});
    	  }
    	});
      });
    </script>