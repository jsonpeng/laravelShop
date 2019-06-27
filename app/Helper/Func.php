<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;


/**
 *11选5算法
 */
function ees5($allNum = 11,$selectNum = 5)
{
    $arr = [];
    while (count($arr) < $selectNum) 
    {
        $arr[]= rand(1,$allNum);
        $arr = array_unique($arr);
    }
    sort($arr);
    dd($arr);
}


/**
 * 获取设置信息
 * @param  [type] $key [description]
 * @return [type]      [description]
 */
function getSettingValueByKey($key){
    return app('setting')->valueOfKey($key);
}

function getSettingValueByKeyCache($key){
    return Cache::remember('getSettingValueByKey'.$key, Config::get('web.cachetime'), function() use ($key){
        return getSettingValueByKey($key);
    });
}

function objtoarr($obj){
    $ret = array();
    foreach($obj as $key =>$value){
        if(gettype($value) == 'array' || gettype($value) == 'object'){
            $ret[$key] = objtoarr($value);
        }else{
            $ret[$key] = $value;
        }
    }
    return $ret;
}

/**
 * [接口请求回转数据格式]
 * @param  type    $data     [成功/失败提示]
 * @param  integer $code     [0成功 1失败]
 * @param  string  $api      [默认不传是api格式 传web是web格式]
 * @return [type]            [description]
 */
function zcjy_callback_data($data=null,$code=0,$api='api'){
    return $api === 'api'
        ? api_result_data_tem($data,$code)
        : web_result_data_tem($data,$code);
}


/**
 * [api接口请求回转数据]
 * @param  [type]  $message  [成功/失败提示]
 * @param  integer $code     [0成功 1失败]
 * @return [type]            [description]
 */
function api_result_data_tem($data=null,$status_code=0){
     return response()->json(['status_code'=>$status_code,'data'=>$data]);
}

/**
 * [web程序请求回转数据]
 * @param  [type]  $message  [成功/失败提示]
 * @param  integer $code     [0成功 1失败]
 * @return [type]            [description]
 */
function web_result_data_tem($message=null,$code=0){
    return response()->json(['code'=>$code,'message'=>$message]);
}



/**
 * 获取主题设置
 * @return [array] [theme setting]
 */
function theme()
{
    $themes = Config::get('zcjytheme.theme');
    $themeName = app('setting')->valueOfKey('theme');
    if (empty($themeName)) {
        $themeName = 'default';
    }
    foreach ($themes as $theme) {
        if ($theme['name'] == $themeName) {
            return $theme;
        }
    }
    return [
        'name' => 'default',
        'parent' => 'default',
        'display_name' => '默认主题',
        'image' => 'themes/default/cover.png',
        'des' => '默认主题',
        'maincolor' => '#ff4e44',
        'secondcolor' => '#84d4da'
    ];
}

/**
 * 主色调
 * @return [type] [description]
 */
function themeMainColor()
{
    $theme_maincolor = app('setting')->valueOfKey('theme_main_color');
    if (empty($theme_maincolor)) {
        return theme()['maincolor'];
    }
    return $theme_maincolor;
}

/**
 * 次色调
 * @return [type] [description]
 */
function themeSecondColor()
{
    $theme_secondcolor = app('setting')->valueOfKey('theme_second_color');
    if (empty($theme_secondcolor)) {
        return theme()['secondcolor'];
    }
    return $theme_secondcolor;
}

/**
 * 前端页面路径
 * @param  [type] $name [description]
 * @return [type]       [description]
 */
function frontView($name)
{
    $themeSetting = theme();
    if (view()->exists('front.'.theme()['name'].'.'.$name)) {
        return 'front.'.theme()['name'].'.'.$name;
    }else{
        if (view()->exists('front.'.theme()['parent'].'.'.$name)) {
            return 'front.'.theme()['parent'].'.'.$name;
        }else{
            
            return 'front.default.'.$name;
        }
    }
}


/**
 * 功能是否被打开 （需要系统 和商家同时开启该功能）
 * @param  [type] $func_name [description]
 * @return [type]            [description]
 */
function funcOpen($func_name)
{
    $config  = Config::get('web.'.$func_name);
    if ($config && sysOpen($func_name)) {
        return true;
    }else{
        return false;
    }
    //return empty($config) ? false : $config;
}

function funcOpenCache($func_name)
{
    return Cache::remember('funcOpen'.$func_name, Config::get('web.cachetime'), function() use ($func_name){
        return funcOpen($func_name);
    });
}

/**
 * 商家自己控制功能是否打开
 * @param  [type] $func_name [description]
 * @return [type]            [description]
 */
function sysOpen($func_name)
{
    $config  = intval( getSettingValueByKey($func_name) );
    return empty($config) ? false : true;
}

function sysOpenCache($func_name)
{
    return Cache::remember('sysOpen'.$func_name, Config::get('web.cachetime'), function() use ($func_name){
        return sysOpen($func_name);
    });
}


//将时间处理成以偶数小时开头，分跟秒为0的时间
function processTime($cur_time)
{
    // if ($cur_time->hour%2) {
    //     $cur_time->subHour();
    // }
    $cur_time->hour = 0;
    $cur_time->minute = 0;
    $cur_time->second = 0;
    return $cur_time;
}


/**
 * 笛卡尔积
 * @return [type] [description]
 */
function combineDika() {
    $data = func_get_args();
    $data = current($data);
    $cnt = count($data);
    $result = array();
    $arr1 = array_shift($data);
    foreach($arr1 as $key=>$item) 
    {
        $result[] = array($item);
    }       

    foreach($data as $key=>$item) 
    {                                
        $result = combineArray($result,$item);
    }
    return $result;
}

/**
 * 数组转对象
 * @param  [type] $d [description]
 * @return [type]    [description]
 */
function arrayToObject($d) {
    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return (object) array_map(__FUNCTION__, $d);
    }
    else {
        // Return object
        return $d;
    }
}

/**
 * 数组转字符串
 * @param  [type] $re1 [description]
 * @return [type]      [description]
 */
function arrayToString($re1){
    $str = "";
    $cnt = 0;
    foreach ($re1 as $value)
    {
        if($cnt == 0) {
            $str = $value;
        }
        else{
            $str = $str.','.$value;
        }
        $cnt++;
    }
}

/**
 * 两个数组的笛卡尔积
 * @param unknown_type $arr1
 * @param unknown_type $arr2
*/

function combineArray($arr1,$arr2) {         
    $result = array();
    foreach ($arr1 as $item1) 
    {
        foreach ($arr2 as $item2) 
        {
            $temp = $item1;
            $temp[] = $item2;
            $result[] = $temp;
        }
    }
    return $result;
}

/**
 * 删除数字元素
 * @param  [type] $arr [description]
 * @param  [type] $key [description]
 * @return [type]      [description]
 */
function array_remove($arr, $key){
    if(!array_key_exists($key, $arr)){
        return $arr;
    }
    $keys = array_keys($arr);
    $index = array_search($key, $keys);
    if($index !== FALSE){
        array_splice($arr, $index, 1);
    }
    return $arr;

}


/**
 * [冒泡排序]
 * @param  [type] $arr [description]
 * @return [type]      [description]
 */
function bubbleSort($arr){
    $arrLen = count($arr);
    if($arrLen){
        #step1
        // for ($i=1; $i < $arrLen; $i++) { 
        //     for ($k=0; $k <$arrLen - $i ; $k++) { 
        //        if($arr[$k] > $arr[$k+1]){
        //              $temp = $arr[$k+1];
        //              $arr[$k+1] = $arr[$k];
        //              $arr[$k] = $temp;
        //        }
        //     }
        // }
        #step2
        for ($i=$arrLen;$i>0;$i--) { 
            for ($k=$arrLen-$i-1;$k>=0;$k--) { 
                 if($arr[$k] > $arr[$k+1]){
                    $temp = $arr[$k+1];
                    $arr[$k+1] = $arr[$k];
                    $arr[$k] = $temp;
                 }
            }
        }
        #step3
        // $arr_arr = []; 
        // foreach ($arr as $key1 => $val1) {
        //    if($key1>0){
        //     //dd($key1);
        //     foreach ($arr as $key2 => $val2) {
        //         if($key2 < $arrLen-$key1){
        //             if($arr[$key2] > $arr[$key2+1]){
        //                 $temp = $arr[$key2+1];
        //                 $arr[$key2+1] = $arr[$key2];
        //                 $arr[$key2] = $arr[$key2+1];
        //             }
        //         }

        //     }
        //    }
        // }
    }
    return $arr;
}


//修改env
function modifyEnv(array $data)
{
    $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';

    $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));

    $contentArray->transform(function ($item) use ($data){
        foreach ($data as $key => $value){
            if(str_contains($item, $key)){
                return $key . '=' . $value;
            }
        }
        return $item;
    });

    $content = implode($contentArray->toArray(), "\n");

    \File::put($envPath, $content);
}

/**
 * 指定位置插入字符串
 * @param $str  原字符串
 * @param $i    插入位置
 * @param $substr 插入字符串
 * @return string 处理后的字符串
 */
function insertToStr($str, $i, $substr){
    //指定插入位置前的字符串
    $startstr="";
    for($j=0; $j<$i; $j++){
        $startstr .= $str[$j];
    }

    //指定插入位置后的字符串
    $laststr="";
    for ($j=$i; $j<strlen($str); $j++){
        $laststr .= $str[$j];
    }

    //将插入位置前，要插入的，插入位置后三个字符串拼接起来
    $str = $startstr . $substr . $laststr;

    //返回结果
    return $str;
}


$key = 'wefwefewfewfw321651)(*&(&';
/**
 * 加密
 * @param  [type] $data [description]
 * @param  [type] $key  [description]
 * @return [type]       [description]
 */
function zcjy_encrypt($data, $key)  
{  
    $key    =   md5($key);  
    $x      =   0;  
    $len    =   strlen($data);  
    $l      =   strlen($key);  
    $char = '';
    $str = '';
    for ($i = 0; $i < $len; $i++)  
    {  
        if ($x == $l)   
        {  
            $x = 0;  
        }  
        $char .= $key{$x};  
        $x++;  
    }  
    for ($i = 0; $i < $len; $i++)  
    {  
        $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);  
    }  
    return base64_encode($str);  
}

/**
 * 解密
 * @param  [type] $data [description]
 * @param  [type] $key  [description]
 * @return [type]       [description]
 */
function zcjy_decrypt($data, $key)  
{  
    $key = md5($key);  
    $x = 0;  
    $data = base64_decode($data);  
    $len = strlen($data);  
    $l = strlen($key);  
    $char = '';
    $str = '';
    for ($i = 0; $i < $len; $i++)  
    {  
        if ($x == $l)   
        {  
            $x = 0;  
        }  
        $char .= substr($key, $x, 1);  
        $x++;  
    }  
    for ($i = 0; $i < $len; $i++)  
    {  
        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))  
        {  
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));  
        }  
        else  
        {  
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));  
        }  
    }  
    return $str;  
}  



function des($str, $num){
        global $Briefing_Length; 
        mb_regex_encoding("UTF-8");     
        $Foremost = mb_substr($str, 0, $num); 
        $re = "<(\/?) 
    (P|DIV|H1|H2|H3|H4|H5|H6|ADDRESS|PRE|TABLE|TR|TD|TH|INPUT|SELECT|TEXTAREA|OBJECT|A|UL|OL|LI| 
    BASE|META|LINK|HR|BR|PARAM|IMG|AREA|INPUT|SPAN)[^>]*(>?)"; 
        $Single = "/BASE|META|LINK|HR|BR|PARAM|IMG|AREA|INPUT|BR/i";     

        $Stack = array(); $posStack = array(); 

        mb_ereg_search_init($Foremost, $re, 'i'); 

        while($pos = mb_ereg_search_pos()){ 
            $match = mb_ereg_search_getregs(); 

            if($match[1]==""){ 
                $Elem = $match[2]; 
                if(mb_eregi($Single, $Elem) && $match[3] !=""){ 
                    continue; 
                } 
                array_push($Stack, mb_strtoupper($Elem)); 
                array_push($posStack, $pos[0]);             
            }else{ 
                $StackTop = $Stack[count($Stack)-1]; 
                $End = mb_strtoupper($match[2]); 
                if(strcasecmp($StackTop,$End)==0){ 
                    array_pop($Stack); 
                    array_pop($posStack); 
                    if($match[3] ==""){ 
                        $Foremost = $Foremost.">"; 
                    } 
                } 
            } 
        } 

        $cutpos = array_shift($posStack) - 1;     
        $Foremost =  mb_substr($Foremost,0,$cutpos,"UTF-8"); 
        return strip_tags($Foremost); 
}

//截取内容中的图片
function get_content_img($text){   
    //取得所有img标签，并储存至二维数组 $match 中   
    //preg_match_all('/<img[^>]*>/i', $text, $match);  
    //preg_match_all('/<img((?!src).)*src[\s]*=[\s]*[\'"](?<src>[^\'"]*)[\'"]/i',$text,$match);
     preg_match_all('/(src)=("[^"]*")/i', $text, $matches);
    // $ret = array();
    // foreach($matches[1] as $i => $v) {
    //     $ret[$v] = $matches[2][$i];
    // } 
    $images_arr = $matches[0];
    $match_arr = [];
    if(count($images_arr)){
        foreach ($images_arr as $key => $value) {
            array_push($match_arr,substr($value,5));
        }   
    }
    return $match_arr;
    
}

/**
 * 计算两点地理坐标之间的距离
 * @param  Decimal $longitude1 起点经度
 * @param  Decimal $latitude1  起点纬度
 * @param  Decimal $longitude2 终点经度 
 * @param  Decimal $latitude2  终点纬度
 * @param  Int     $unit       单位 1:米 2:公里
 * @param  Int     $decimal    精度 保留小数位数
 * @return Decimal
 */
function getDistance($longitude1, $latitude1, $longitude2, $latitude2, $unit=2, $decimal=2){

    if(empty($longitude1) || empty($latitude1) || empty($longitude2) || empty($latitude2)){
        return '???';
    }

    $EARTH_RADIUS = 6370.996; // 地球半径系数
    $PI = 3.1415926;

    $radLat1 = $latitude1 * $PI / 180.0;
    $radLat2 = $latitude2 * $PI / 180.0;

    $radLng1 = $longitude1 * $PI / 180.0;
    $radLng2 = $longitude2 * $PI /180.0;

    $a = $radLat1 - $radLat2;
    $b = $radLng1 - $radLng2;

    $distance = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2)));
    $distance = $distance * $EARTH_RADIUS * 1000;

    if($unit==2){
        $distance = $distance / 1000;
    }

    return round($distance, $decimal);

}