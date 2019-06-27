<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

use Illuminate\Support\Facades\Input;
use Redirect,Response;
use Image;
use Log;
use Config;
use App\User;

class AjaxController extends AppBaseController
{

    public function __construct(
      
    )
    {
       
    }

   /**
    * 图片文件上传
    */
    public function uploadImage(){
        $file =  Input::file('file');
        return app('commonRepo')->uploadFiles($file);
    }


     //给指定用户发消息
    public function sendNotices(Request $request){
        $content = $request->input('content');
        $type = $request->input('type');
        if($type == 'group'){
               $user_group = User::all();
               app('notice')->sendGroupNotice($content,$user_group,'商户消息');
        }
        else{
                $user_id = $request->input('user_id');
                app('notice')->sendNotice($user_id,$content,false,'商户消息');
        }
        return zcjy_callback_data('发送成功',0,'web');
    }   

}