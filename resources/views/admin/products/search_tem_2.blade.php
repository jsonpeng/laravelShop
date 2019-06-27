@extends('admin.layouts.app_tem')

@section('content')
<section class="content-header">
    <h1 class="pull-left">产品列表</h1>
    <div>(共{!! $product_num !!}条记录)</div>
</section>

<div class="content pdall0-xs">
    <div class="clearfix"></div>

    <div class="clearfix"></div>
    <div class="box box-primary mb10-xs">
        <div class="box-body">
            <table class="table table-responsive" id="products-table">
                <thead>
                    <th>
                        <div></div>
                    </th>
                    <th>产品名称</th>
                    <th>规格</th>
                    <th class="hidden-xs">价格</th>
                    <th>库存</th>
                </thead>
                <tbody id="products-tbody">
                    @foreach($product as $item)
                    <?php $items=$item->
                    specs;?>
                @if(count($items)>0)
                    <!--有商品规格的商品-->
                    @foreach($items as $item)
                    <tr data-productid="{!! $item->
                        product()->first()->id !!}" data-productimg="{!! $item->image !!}"  data-inventory="{!! $item->inventory !!}" data-specid="{!! $item->id !!}" data-productname="{!! $item->product()->first()->name !!}" data-price="{!! $item->price !!}" data-keyname="{!! $item->key_name !!}" data-prom="{!! $item->prom_type==0?'false':'true' !!}">
                        <td></td>
                        <td>
                            @if(!empty($item->prom_type)) <strong style="color: red">[ @if($item->prom_type=='1')秒杀抢购中@endif @if($item->prom_type==2)团购中@endif @if($item->prom_type==3)促销中@endif @if($item->prom_type==4)订单促销中@endif @if($item->prom_type==5)拼团中@endif ]</strong> 
                            @endif {!! $item->product()->first()->name !!}
                        </td>
                        <td>{!! $item->key_name !!}</td>
                        <td class="hidden-xs">{!! $item->price !!}</td>
                        <td>{!! $item->inventory !!}</td>
                    </tr>
                    @endforeach
                @else
                    <tr data-productid="{!! $item->
                        id !!}" data-specid="0" data-productname="{!! $item->name !!}" data-price="{!! $item->price !!}" data-keyname="--" data-productimg="{!! $item->image !!}"  data-inventory="{!! $item->inventory !!}" data-prom="{!! empty($item->prom_type)?'false':'true' !!}">
                        <td></td>
                        <td>
                            @if(!empty($item->prom_type)) <strong style="color: red">[ @if($item->prom_type=='1')秒杀抢购中@endif @if($item->prom_type==2)团购中@endif @if($item->prom_type==3)促销中@endif @if($item->prom_type==4)订单促销中@endif @if($item->prom_type==5)拼团中@endif ]</strong> 
                            @endif {!! $item->name !!}
                        </td>
                        <td>--</td>
                        <td class="hidden-xs">{!! $item->price !!}</td>
                        <td>{!! $item->inventory !!}</td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>

        </div>

    </div>
    <div class="tc">
        <?php echo $products->appends($input)->render(); ?></div>
</div>
@endsection


@section('scripts')


@endsection