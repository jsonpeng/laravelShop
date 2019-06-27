<?php

namespace App\Repositories;

use App\Models\OrderAction;
use Illuminate\Support\Facades\Log;
use InfyOm\Generator\Common\BaseRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class OrderActionRepository
 * @package App\Repositories
 * @version January 16, 2018, 5:36 am UTC
 *
 * @method OrderAction findWithoutFail($id, $columns = ['*'])
 * @method OrderAction find($id, $columns = ['*'])
 * @method OrderAction first($columns = ['*'])
*/
class OrderActionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'user_id',
        'order_status',
        'shipping_status',
        'pay_status',
        'action',
        'status_desc'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderAction::class;
    }

    //存储操作记录
    public function saveAction($data){
        $user=empty(auth('admin')->user())? "用户:".auth('web')->name : "管理员:".auth('admin')->user()->name;
        $data['user']=$user;
        OrderAction::create($data);

    }

}
