<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Entities\StatRepository;
use App\Validators\StatRepositoryValidator;

use App\Models\Item;
use App\Models\Order;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * Class StatRepositoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class StatRepositoryRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StatRepository::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 销量统计
     * @return [type] [description]
     */
    
    public function rangeItemStats($time_begin=null, $time_end=null)
    {
        return Item::whereBetween('created_at', array($time_begin, $time_end))->select('name', 'unit', DB::raw('SUM(count) as total_sales'), DB::raw('SUM(price) as total_prices'))->groupBy('name', 'unit')->get();
        //return Item::select('name', 'num', DB::raw('name as name'), DB::raw('SUM(num) as num'))->groupBy('name', 'num')->toSql();
    }

    // public function todayItemStats()
    // {
    //     return Item::whereBetween('created_at', array(Carbon::today(), Carbon::tomorrow()))->select('name', 'unit', DB::raw('SUM(count) as total_sales'))->groupBy('name', 'unit')->get();
    // }

    // public function thisWeekItemStats()
    // {
    //     return Item::where('created_at', '>', Carbon::today()->startOfWeek())->select('name', 'unit', DB::raw('SUM(count) as total_sales'))->groupBy('name', 'unit')->get();
    // } 

    // public function thisMonthItemStats()
    // {
    //     return Item::where('created_at', '>', Carbon::today()->startOfMonth())->select('name', 'unit', DB::raw('SUM(count) as total_sales'))->groupBy('name', 'unit')->get();
    // }

    //自定义时间点item
    // public function customStatsByStart($type,$start_time){
    //     if($type=='item') {
    //         return Item::where('created_at', '>=', $start_time)->select('name', 'unit', DB::raw('SUM(count) as total_sales'))->groupBy('name', 'unit');
    //     }elseif($type=='sale'){
    //         return Order::where('created_at','>=' ,$start_time)->select(DB::raw('SUM(price) as total_sales'), DB::raw('SUM(cost) as total_costs'), DB::raw('COUNT(id) as total_orders'));
    //     }elseif ($type=='user'){
    //         return User::where('created_at', '>=', $start_time)->select(DB::raw('Count(id) as total'));
    //     }else{
    //         return null;
    //     }
    // }

    // public function customStatsByEnd($type,$end_time){
    //     if($type=='item') {
    //         return Item::where('created_at','<' ,$end_time)->select('name', 'unit', DB::raw('SUM(count) as total_sales'))->groupBy('name', 'unit');
    //     }elseif($type=='sale'){
    //         return Order::where('created_at','<' ,$end_time)->select(DB::raw('SUM(price) as total_sales'), DB::raw('SUM(cost) as total_costs'), DB::raw('COUNT(id) as total_orders'));
    //     }elseif ($type=='user'){
    //         return User::where('created_at', '<', $end_time)->select(DB::raw('Count(id) as total'));
    //     }else{
    //         return null;
    //     }

    // }

    /**
     * 营业额成本统计
     */
    
    public function rangeSaleStats($time_begin, $time_end)
    {
        return Order::whereBetween('created_at', array($time_begin, $time_end))
            ->select(DB::raw('SUM(price) as total_sales'), DB::raw('SUM(cost) as total_costs'), DB::raw('COUNT(id) as total_orders'))
            ->first();
    }
    // public function todaySaleStats()
    // {
    //     return Order::whereBetween('created_at', array(Carbon::today(), Carbon::tomorrow()))
    //         ->select(DB::raw('SUM(price) as total_sales'), DB::raw('SUM(cost) as total_costs'), DB::raw('COUNT(id) as total_orders'))
    //         ->first();
    // }

    // public function thisWeekSaleStats()
    // {
    //     return Order::where('created_at', '>', Carbon::today()->startOfWeek())->select(DB::raw('SUM(price) as total_sales'), DB::raw('SUM(cost) as total_costs'), DB::raw('COUNT(id) as total_orders'))->first();
    // }

    // public function thisMonthSaleStats()
    // {
    //     return Order::where('created_at', '>', Carbon::today()->startOfMonth())->select(DB::raw('SUM(price) as total_sales'), DB::raw('SUM(cost) as total_costs'), DB::raw('COUNT(id) as total_orders'))->first();
    // }


    /**
     * 新增用户数
     */
    
    public function rangeUserStats($time_begin, $time_end)
    {
        return User::whereBetween('created_at', array($time_begin, $time_end))->select(DB::raw('Count(id) as total'))->first();
    }
    // public function todayUserStats()
    // {
    //     return User::whereBetween('created_at', array(Carbon::today(), Carbon::tomorrow()))->select(DB::raw('Count(id) as total'))->first();
    // }

    // public function thisWeekUserStats()
    // {
    //     return User::where('created_at', '>', Carbon::today()->startOfWeek())->select(DB::raw('Count(id) as total'))->first();
    // } 

    // public function thisMonthUserStats()
    // {
    //     return User::where('created_at', '>', Carbon::today()->startOfMonth())->select(DB::raw('Count(id) as total'))->first();
    // }

    /**
     * 时间段统计
     */
    public function ItemStats($timerange)
    {
        $dateArr = explode(" - ", $timerange);
        $startDate = Carbon::createFromFormat('Y-m-d', $dateArr[0])->setTime(0, 0, 0);
        $endDate = Carbon::createFromFormat('Y-m-d', $dateArr[1])->addDay()->setTime(0, 0, 0);
        return Item::whereBetween('created_at', array( $startDate, $endDate))->select('name', 'unit', DB::raw('SUM(count) as total_sales'), DB::raw('Date(created_at)'))->groupBy('name', 'unit', DB::raw('Date(created_at)'))->orderBy('created_at')->get();

    }
    public function OrderStats($timerange)
    {
        $dateArr = explode(" - ", $timerange);
        $startDate = Carbon::createFromFormat('Y-m-d', $dateArr[0])->setTime(0, 0, 0);
        $endDate = Carbon::createFromFormat('Y-m-d', $dateArr[1])->addDay()->setTime(0, 0, 0);
        return Order::with('canteen')
                    ->whereBetween('created_at', array( $startDate, $endDate))
                    ->get();
    }
    public function UserStats($timerange)
    {
        $dateArr = explode(" - ", $timerange);
        $startDate = Carbon::createFromFormat('Y-m-d', $dateArr[0])->setTime(0, 0, 0);
        $endDate = Carbon::createFromFormat('Y-m-d', $dateArr[1])->addDay()->setTime(0, 0, 0);
        return User::whereBetween('created_at', array( $startDate, $endDate))->groupBy(DB::raw('Date(created_at)'))->select(DB::raw('COUNT(ID) as total_users'), DB::raw('Date(created_at)'))->get();
    }
}
