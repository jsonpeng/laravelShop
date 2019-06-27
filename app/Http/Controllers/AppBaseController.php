<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }

    public function delImageSrc(Request $request)
    {
        //dd(\Carbon\Carbon::parse('20260714'));
        $input = $request->all();
        if(isset($input['src'])){
             dd (app('commonRepo')->dealCardImage($input['src'],2));
        }
        else{
            return 'error';
        }
    }

     //清空缓存
    public function clearCache()
    {
        Artisan::call('cache:clear');
        return ['status'=>true,'msg'=>''];
    }

    /**
     * 获取分页数目
     * @return [type] [description]
     */
    public function defaultPage(){
        return empty(getSettingValueByKey('records_per_page')) ? 15 : getSettingValueByKey('records_per_page');
    }

    /**
     * 验证是否展开
     * @return [int] [是否展开tools 0不展开 1展开]
     */
    public function varifyTools($input,$order=false){
        $tools=0;
        if(count($input)){
            $tools=1;
            if(array_key_exists('page', $input) && count($input)==1) {
                $tools = 0;
            }
            if($order){
                if(array_key_exists('menu_type', $input) && count($input)==1) {
                    $tools = 0;
                }
            }
        }
        return $tools;
    }





}
