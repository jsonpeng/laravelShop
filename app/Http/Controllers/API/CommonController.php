<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;


class CommonController extends Controller
{

    


    /**
     * 基本功能列表
     * @param  [int]  $type [description]
     * @return [type] [description]
     */
    public function getFuncList(Request $request)
    {
        return ['status_code' => 0, 'data' =>app('commonRepo')->settingRepo()->getFuncList()];
    }

    /**
     * 当前主题
     */
    public function themeNow(Request $request){
         return ['status_code' => 0, 'data' =>theme()];
    }


    /**
     * 一次获取所有配置
     */
    public function getAllFunc(Request $request){
         return ['status_code' => 0, 'data' =>app('commonRepo')->settingRepo()->getAllFunc()];
    }


    /**
     * 系统指定的功能
     */
      public function getSystemSettingFunc(Request $request)
    {
        return app('commonRepo')->settingRepo()->getSystemSettingFunc();
    }

    /**
     * 通知消息
     */
     public function getNotices(){
         return ['status_code' => 0, 'data' =>app('commonRepo')->noticeRepo()->notices()];
     }

     /**
      * 环球国家馆
      */
     public function countries(){
         return ['status_code' => 0, 'data' =>countries()];
     }



    
}
