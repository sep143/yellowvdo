<?php 
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');

	/**
	 * 
	 */
	class youtubeapi
	{
		var $IC;
		function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
        $this->CI->load->library('pagination');
        $this->CI->load->library('email');
    }
    
    function youtube_link($url){
        
        /*
Made by [egy.js](https://www.instagram.com/egy.js/);
*/
header('Access-Control-Allow-Origin: *');  
header('Content-Type: application/json');
if($url && $url != ""){
    parse_str( parse_url( $url, PHP_URL_QUERY ), $vars );
//    try{
//        $id=$vars['v'];
//    } catch (Exception $ex){
//        $id='';
//    }
    if(!empty($vars['v'])){
        $id=$vars['v'];
    }else{
        $id = '';
    }
        
//    $id=$vars['v'];
    
    if($id == "" && strpos($url, 'youtu.be') !== false) {
        $id = substr($url,strripos($url, "/")+1,strlen($url)-1);
    }
    
    $dt=file_get_contents("http://www.youtube.com/get_video_info?video_id=$id&el=embedded&ps=default&eurl=&gl=US&hl=en");
    //var_dump(explode("&",$dt));
    if (strpos($dt, 'status=fail') !== false) {
        
        $x=explode("&",$dt);
        $t=array(); $g=array(); $h=array();
        foreach($x as $r){
            $c=explode("=",$r);
            $n=$c[0]; $v=$c[1];
            $y=urldecode($v);
            $t[$n]=$v;
        }
            $x=explode("&",$dt);
            foreach($x as $r){
                $c=explode("=",$r);
                $n=$c[0]; $v=$c[1];
                $h[$n]=urldecode($v);
            }
            $g[]=$h;
            $g[0]['error'] = true;
            $g[0]['instagram'] = "egy.js";
            $g[0]['apiMadeBy'] = 'El-zahaby';
        return json_encode($g,JSON_PRETTY_PRINT);
        
    }else{
        
        $x=explode("&",$dt);
        $t=array(); $g=array(); $h=array();
        foreach($x as $r){
            $c=explode("=",$r);
            $n=$c[0]; $v=$c[1];
            $y=urldecode($v);
            $t[$n]=$v;
        }
        $streams = explode(',',urldecode($t['url_encoded_fmt_stream_map']));
        foreach($streams as $dt){ 
            $x=explode("&",$dt);
            foreach($x as $r){
                $c=explode("=",$r);
                $n=$c[0]; $v=$c[1];
                $h[$n]=urldecode($v);
            }
            $g[]=$h;
        }
        return json_encode($g,JSON_PRETTY_PRINT);
       // var_dump( $g[1]["quality"],true);
    }
}else{
    @$myObj->error = true;
    $myObj->msg = "there is no youtube link";
    
    $myObj->madeBy = "El-zahaby";
    $myObj->instagram = "egy.js";
    $myJSON = json_encode($myObj,JSON_PRETTY_PRINT);
    return $myJSON;
}
    }
    
}   