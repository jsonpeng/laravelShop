<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', '活动名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('time_begin', '开始时间:') !!}
    <div class='input-group date' id='datetimepicker_begin'>
        {!! Form::text('time_begin', null, ['class' => 'form-control']) !!}
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('time_end', '结束时间:') !!}
    <div class='input-group date' id='datetimepicker_end'>
        {!! Form::text('time_end', null, ['class' => 'form-control']) !!}
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
</div>

<!-- Product Id Field 
<div class="form-group col-sm-12">
    {!! Form::label('product_id', 'Product Id:') !!}
    {!! Form::number('product_id', null, ['class' => 'form-control']) !!}
</div>-->

<!-- Spec Id Field
<div class="form-group col-sm-12">
    {!! Form::label('spec_id', 'Spec Id:') !!}
    {!! Form::number('spec_id', null, ['class' => 'form-control']) !!}
</div> -->
<!-- Product Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_name', '设置产品:') !!}
    
    <button class="btn btn-primary btn-sm daterange" type="button" title="添加商品" onclick="addProductMenuFunc(1)" style="margin-top:15px;"><i class="fa fa-plus"></i></button>

     {!! Form::hidden('product_spec', $product_spec, ['class' => 'form-control']) !!}
</div>

<!-- Product Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_name', '产品名称:') !!}
    {!! Form::text('product_name', null, ['class' => 'form-control']) !!}
    <div id="seleted_one_goods">
      @if(!empty($product_spec))

        @if($spec_id==0)
        <!--是没有规格的商品则-->
        <div style="float: left;margin: 10px auto;" class="selected-group-goods">
            <div class="goods-thumb">
                <img style="width: 162px;height: 162px" src="{!! $product->image !!}">
            </div>
            <div class="goods-name">
                <a target="_blank" href="">{!! $product->name !!}</a>
            </div>
            <div class="goods-price">
                商城价：￥{!! $product->price !!}库存:{!! $product->inventory !!}
            </div>
        </div>
        @else
        <!--商品带规格的-->
        <div style="float: left;margin: 10px auto;" class="selected-group-goods">
            <div class="goods-thumb">
                <img style="width: 162px;height: 162px" src="{!! $product->image !!}">
            </div>
            <div class="goods-name">
                <a target="_blank" href="">{!! $product->product()->first()->name !!} {!! $product->key_name !!}</a>
            </div>
            <div class="goods-price">
                商城价：￥{!! $product->price !!}库存:{!! $product->inventory !!}
            </div>
        </div>
        @endif

      @endif  
    </div>
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', '团购价格:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Origin Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('origin_price', '原价:') !!}
    {!! Form::text('origin_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Max Field -->
<div class="form-group col-sm-4">
    {!! Form::label('product_max', '最大销售数量:') !!}
    {!! Form::number('product_max', null, ['class' => 'form-control']) !!}
</div>

<!-- Buy Num Field 
<div class="form-group col-sm-4">
    {!! Form::label('buy_num', '已购数量:') !!}
    {!! Form::number('buy_num', null, ['class' => 'form-control']) !!}
</div>-->

<!-- Order Num Field
<div class="form-group col-sm-4">
    {!! Form::label('order_num', '订单数量:') !!}
    {!! Form::number('order_num', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Buy Base Field -->
<div class="form-group col-sm-4">
    {!! Form::label('buy_base', '虚拟购买量:') !!}
    {!! Form::number('buy_base', null, ['class' => 'form-control']) !!}
</div>

<!-- View Field -->
<div class="form-group col-sm-4">
    {!! Form::label('view', '浏览量:') !!}
    {!! Form::number('view', null, ['class' => 'form-control']) !!}
</div>

<!-- Intro Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('intro', '活动介绍:') !!}
    {!! Form::textarea('intro', null, ['class' => 'form-control', 'rows' => 2]) !!}
</div>

<!-- Recommend Field -->
<div class="form-group col-sm-12">
    {!! Form::label('recommend', '推荐:') !!}
    {!! Form::select('recommend', [0 => '否', 1 => '是'],null, ['class' => 'form-control']) !!}
</div>

<div id="product_items_table" style="display:none;"> </div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('groupSales.index') !!}" class="btn btn-default">取消</a>
</div>
