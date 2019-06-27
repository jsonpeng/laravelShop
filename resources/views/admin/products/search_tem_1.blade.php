@extends('admin.layouts.app_tem')

@section('content')
<section class="content-header mb10-xs">
    <h1 class="pull-left">产品列表</h1>
    <div>(共{!! $product_num !!}条记录)</div>
</section>

<div class="content pdall0-xs">
    <div class="clearfix"></div>
    <div class="box box-default box-solid mb10-xs">
        <div class="box-header with-border">
            <h3 class="box-title">查询</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"> <i class="fa fa-minus"></i>
                </button>
            </div>
            <!-- /.box-tools --> </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form id="order_search">

                <div class="form-group col-md-4">
                    <label for="order_pay">所有产品分类</label>
                    <div class="row">
                        <div class="col-md-4 col-xs-4 pr0-xs">
                            {!! Form::select('cat_level01',$cats, $level01 , ['class' => 'form-control level01']) !!}
                        </div>
                        <div class="col-md-4 col-xs-4 pr0-xs">
                            {!! Form::select('cat_level02',$second_cats,$level02 , ['class' => 'form-control level02']) !!}
                        </div>
                        <div class="col-md-4 col-xs-4">
                            {!! Form::select('cat_level03', $third_cats, $level03 , ['class' => 'form-control level03']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="order_delivery">产品名称</label>
                    <input type="text" class="form-control" name="keywords" placeholder="产品名称" @if (array_key_exists('keywords', $input))value="{{$input['keywords']}}"@endif></div>
                <input type="hidden" name="type" value="@if(array_key_exists('type',$input)) {!! $input['type'] !!} @endif" />
                <div class="form-group col-md-1" style="padding-top: 25px;">
                    <button type="submit" class="btn btn-primary pull-right" >查询</button>
                </div>
            </form>
        </div>
        <!-- /.box-body --> </div>
    <!-- /.box -->

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-responsive" id="products-table">
                <thead>
                    <th>
                        <div></div>
                    </th>
                    <th>产品名称</th>
                    <th>规格</th>
                    <th>价格</th>
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
                        product()->first()->id !!}" data-productimg="{!! empty($item->image)?$item->
                        product()->first()->image:$item->image !!}"  data-inventory="{!! $item->inventory !!}" data-specid="{!! $item->id !!}" data-productname="{!! $item->product()->first()->name !!}" data-price="{!! $item->price !!}" data-keyname="{!! $item->key_name !!}" data-prom="{!! $item->prom_type==0?'false':'true' !!}" data-remark="{!! $item->
                        product()->first()->remark !!}">
                        <td></td>
                        <td>
                            @if(!empty($item->prom_type)) <strong style="color: red">[ @if($item->prom_type=='1')秒杀抢购中@endif @if($item->prom_type==2)团购中@endif @if($item->prom_type==3)促销中@endif @if($item->prom_type==4)订单促销中@endif @if($item->prom_type==5)拼团中@endif ]</strong> 
                            @endif {!! $item->product()->first()->name !!}
                        </td>
                        <td>{!! $item->key_name !!}</td>
                        <td>{!! $item->price !!}</td>
                        <td>{!! $item->inventory !!}</td>
                    </tr>
                    @endforeach
                @else
                    <tr data-productid="{!! $item->
                        id !!}" data-specid="0" data-productname="{!! $item->name !!}" data-price="{!! $item->price !!}" data-keyname="--" data-productimg="{!! $item->image !!}"  data-inventory="{!! $item->inventory !!}" data-prom="{!! empty($item->prom_type)?'false':'true' !!}" data-remark="{!! $item->remark !!}">
                        <td></td>
                        <td>
                            @if(!empty($item->prom_type)) <strong style="color: red">[ @if($item->prom_type=='1')秒杀抢购中@endif @if($item->prom_type==2)团购中@endif @if($item->prom_type==3)促销中@endif @if($item->prom_type==4)订单促销中@endif @if($item->prom_type==5)拼团中@endif ]</strong> 
                            @endif {!! $item->name !!}
                        </td>
                        <td>--</td>
                        <td>{!! $item->price !!}</td>
                        <td>{!! $item->inventory !!}</td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="pull-left" style="margin-top:15px;">
            <input type="button" class="btn btn-primary"  value="确定" id="product_enter"></div>
    </div>
    <div class="tc">
        <?php echo $products->appends($input)->render(); ?></div>
</div>
@endsection


@section('scripts')
<script type="text/javascript">
    /*
    分类选择
     */
     $('.level01').on('change', function(){

            $('select.level03').empty();
            $('select.level03').append("<option value='0'>请选择分类</option>");

            var newParentID = $('select.level01').val();
            if (newParentID == 0) {
                $('select.level02').empty();
                $('select.level02').append("<option value='0'>请选择分类</option>");
                return;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"/zcjy/childCategories/"+$('select.level01').val(),
                type:"GET",
                data:'',
                success: function(data) {
                    $('select.level02').empty();
                    $('select.level02').append("<option value='0'>请选择分类</option>");
                    for (var i = data.length - 1; i >= 0; i--) {
                        $('select.level02').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");
                    }
                },
                error: function(data) {
                  //提示失败消息
                    
                },
            });
        });

        $('.level02').on('change', function(){

            var newParentID = $('select.level02').val();
            if (newParentID == 0) {
                $('select.level03').empty();
                $('select.level03').append("<option value='0'>请选择分类</option>");
                return;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"/zcjy/childCategories/"+$('select.level02').val(),
                type:"GET",
                data:'',
                success: function(data) {
                    $('select.level03').empty();
                    $('select.level03').append("<option value='0'>请选择分类</option>");
                    for (var i = data.length - 1; i >= 0; i--) {
                        $('select.level03').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");
                    }
                },
                error: function(data) {
                  //提示失败消息
                    
                },
            });
        });

        //单选商品
        $('#products-tbody >tr').click(function(){
            var prom=$(this).data('prom');
            if(!prom){
                $('#products-tbody >tr').each(function(){
                    if($(this).hasClass('trSelected')){
                        $(this).removeClass('trSelected');
                    }
                });
               $(this).toggleClass('trSelected');
           }else{
            layer.alert('该商品已参加其他活动,请删除之前活动后再尝试', {icon: 2});
            return false;
           }
        });
        var team_sale='{!! $team_sale !!}';
        //确定
        $('#product_enter').click(function(){
            var selected=$('#products-tbody >tr').hasClass('trSelected');
            if(!selected){
               layer.alert('请选择商品', {icon: 2}); 
               return false;
            }
            $('#products-tbody >tr').each(function(){
                if(!$(this).hasClass('trSelected')){
                    $(this).remove();
                }
            });
            var tabHtml=$('#products-tbody').html();
            javascript:window.parent.call_back_by_one(tabHtml.replace(/选择/,'购买数量'),team_sale);
        });
</script>
@endsection