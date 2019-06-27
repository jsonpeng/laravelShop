<?php

namespace App\Repositories;

use App\Models\Card;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CardRepository
 * @package App\Repositories
 * @version August 15, 2018, 3:43 pm CST
 *
 * @method Card findWithoutFail($id, $columns = ['*'])
 * @method Card find($id, $columns = ['*'])
 * @method Card first($columns = ['*'])
*/
class CardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'number',
        'password',
        'price',
        'num',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Card::class;
    }

    // public function newCode(){
    //     $card =  Card::orderBy('id','desc')->first();
    //     if(empty($card)){
    //         return 100000000001;
    //     }
    //     else{
    //         return $card->number+1;
    //     }
    // }

    public function newCode(){
        $length = empty(getSettingValueByKey('CARD_NUM')) ? 8 : getSettingValueByKey('CARD_NUM');

        if($length <= 4){
            $length = 4;
        }

        $code = mt_rand(1000,9999);

        if($length > 4){
            for ($i=0; $i < $length - 4 ; $i++){ 
                $code .= mt_rand(0,9);
            }
        }
        elseif($length == 4){
            $code = mt_rand(1000,9999);
        }

        if($this->varifyCode($code)){
            $code = $this->newCode();
        }
        return $code;
    }

    public function varifyCode($code){
        return Card::where('number',$code)->count() ? true : false; 
    }

    public function getCardByNumber($number){
        return Card::where('number',$number)->first();
    }


    public function randomString()
    { 
        // 密码字符集，可任意添加你需要的字符 
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $password = ''; 
        for ( $i = 0; $i < 2; $i++ ) 
        { 
            $password .= $chars[mt_rand(0, strlen($chars) - 1)]; 
        }
        $code = '0123456789';
        for ( $i = 0; $i < 6; $i++ ) 
        { 
            $password .= $code[mt_rand(0, strlen($code) - 1)]; 
        }
        //判断是否重复
        return $password; 
    }

}
