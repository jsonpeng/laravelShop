<?php

namespace App\Repositories;

use App\Models\Setting;
use InfyOm\Generator\Common\BaseRepository;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class SettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'logo',
        'freight',
        'mianyou',
        'mianyou_list',
        'agreen',
        'qq',
        'weixin',
        'intro',
        'contact'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Setting::class;
    }

    public function valueOfKey($key){
        $setting = Setting::where('name', $key)->first();
        if (empty($setting)) {
            $setting = Setting::create(['name' => $key, 'value' => '', 'group' => '', 'des' => '']);
        }
        return $setting->value;
    }

    public function valueOfKeyCached($key){
        return Cache::remember('setting_value_of_key'.$key, Config::get('web.cachetime'), function() use($key){
            return $this->valueOfKey($key);
        });
    }

    public function settingByKey($key){
        $setting = Setting::where('name', $key)->first();
        if (empty($setting)) {
            $setting = Setting::create(['name' => $key, 'value' => '', 'group' => '', 'des' => '']);
        }
        return $setting;
    }

    public function settingByKeyCached($key){
        return Cache::remember('setting_value_of_key'.$key, Config::get('web.cachetime'), function() use($key){
            return $this->valueOfKey($key);
        });
    }

    /**
     * 获取功能开关列表
     */
     public function getFuncList($num=null){
           return Cache::remember('setting_function_switch', Config::get('web.cachetime'), function() use($num){

                return Setting::where('name','like','%FUNC_%')->get();

           });
     }

     /**
      *系统固定的配置数据 
      */
     public function getSystemSettingFunc(){
       return Cache::remember('setting_function_system_switch', Config::get('web.cachetime'), function(){
                        $data=[];
                        $func=Config::get('web');

                        foreach ($func as $key => $value) {

                            if(strpos($key,'FUNC_')!==false){
                                $data[$key]=funcOpen($key);
                            }
                            
                        }

                       return ['status_code'=>0,'data'=> $data];
            });
       }

     /**
      * 一次获取所有配置
      */
    public function getAllFunc(){
           return Cache::remember('setting_function_all_func_set', Config::get('web.cachetime'), function(){

                return Setting::all();

           });
     }
}
