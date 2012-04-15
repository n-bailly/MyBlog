<?php
if (!function_exists('asset_url'))
{   
    function asset_url($filename)
    {
        return base_url() . "assets/". $filename;
    }
	
	function asset_css($filename)
    {
		if (substr($filename, -4) == ".css")
		{
			$filename = substr(0,strpos($filename,".css"));
		}
        return base_url() . "assets/css/". $filename .".css";
    }
}
