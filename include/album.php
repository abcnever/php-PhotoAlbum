<?php

 class PhotoAlbum
{
    static $files;
    
    static function init($orientation)
    {
        PhotoAlbum::$files = scandir('img/');
        $initlist = PhotoAlbum::generateList($orientation);
         echo <<<BASE

<script type="text/javascript">
var current = 0;


    var navReq;
    var filters = new Array();
    
    //initializes required xmlhttprequest objects
    try
    {
	// Opera 8.0+, Firefox, Safari
	navReq = new XMLHttpRequest();
	
    }
    catch (e)
    {
	// Internet Explorer Browsers
	try
	{
	    navReq = new ActiveXObject("Msxml2.XMLHTTP");
	    
	}
	catch (e)
	{
	    try{
		navReq = new ActiveXObject("Microsoft.XMLHTTP");
		  
	    } catch (e){
		// Something went wrong
		alert("Your browser broke!");
	    }
	}
    }
    navReq.onreadystatechange =
	function(){
	    if(navReq.readyState == 4)
	    {
		    document.getElementById('navbox').innerHTML = navReq.responseText;		
	    }
	}
function changeFocus(arg1)
{
document.getElementById("photo").setAttribute("src", "img/"+arg1);
}

function updateNav(arg1)
{
if(arg1 = "left")
{
    current -= 3;
    if(current < 0)
        current = 9 + current;
}
else
{
current += 3;
}
current = current%9;
var base = "include/functions.php?getnav=1&count=" + current ;
	
	navReq.open("GET", base, true);
	navReq.send();
}
</script>
<body>
<div id="container" style="width:1000px;margin:auto;height:100%">
<div id="photobox" style="height:300px;margin:auto;">
<img id="photo" src="" style="margin:auto;display:block;height:300px"/>
</div>
<div id="navbox" style="display:block;margin:auto;width:800px">
$initlist
</div>
</div>

BASE;
    }
    
    //display images in list
    //Generates a list of images from the folder in the orientation specified
    // $orientaion: "vertical" or "horizontal"
    static function generateList($orientation, $path = "./img", $start =0 , $end = 3)
    {
        $files = scandir($path);
        
        if($orientation === "horizontal")
        {
            $orientation = "inline-block";
            $output ="<div id=\"list\" style=\"display:block;margin:auto;width:600px\">";
        }
        else
        {
            $output ="<div id=\"list\" style=\"display:block;margin:auto;height:400px;width:200px\">";
             $orientation = "block";
           
        }
        
        $output .= "<a onclick='updateNav(\"left\")' ><img src='assets/left.png' style='display:inline-block;height:100px;margin:auto'/> </a>" ;
        if ($start < 3);
        for($i = $start; $i < $end; $i++) {
            if(strlen($files[$i]) >= 3)
            {
                $output .= "<a onclick='changeFocus(\"$files[$i]\")' ><img src='img/$files[$i]' style='display:$orientation;height:100px;margin:auto'/> </a>";
            }else
            {
                $end++;
            }
        }
         $output .= "<a onclick='updateNav(\"right\")' ><img src='assets/right.gif' style='display:inline-block;height:100px;margin:auto'/> </a>" ;
        
        return $output."</div>";
    }
}
?>