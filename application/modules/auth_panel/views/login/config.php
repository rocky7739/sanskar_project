<?php
if(!function_exists(base_url)){
    function base_url($url){
        if($url!=''){
            $url='http://drishtiias.co/'.$url.'.php';
        }else{
            $url='http://drishtiias.co/'.$url;
        }
        return $url;
    }
}