@extends('admin.layouts.app_shop')

@section('content')
<div class="content container-fluid">
    <input type="hidden" name="product_id" value="{{ $product->
    id }}">
       @include('adminlte-templates::common.errors')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li>
                <a href="javascript:;">
                    <span style="font-weight: bold;">商品设置</span>
                </a>
            </li>
            <li class="{!! !$edit_rember && !$spec_show ? 'active': '' !!}">
                <a href="#tab_1" data-toggle="tab">通用设置</a>
            </li>
            <li class="{!! $edit_rember ? 'active' : '' !!}">
                <a href="#tab_2" data-toggle="tab">商品相册</a>
            </li>
            <li class="{!! $spec_show ? 'active' : '' !!}">
                <a href="#tab_3" data-toggle="tab">商品模型</a>
            </li>
            <!--li>
                <a href="#tab_4" data-toggle="tab">多件打折</a>
            </li-->
        </ul>
        <div class="tab-content">
            <div class="tab-pane {!! !$edit_rember && !$spec_show ? 'active' : '' !!}" id="tab_1">
                <div class="box ">
                    <!-- form start -->
                    <div class="box-body">
                        {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'patch']) !!}
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="box box-primary mb10-xs">
                                    <div class="box-body">
                                        <div class="form-group">
                                              <label for="name">商品名称<span class="bitian">(必填):</span></label>
                                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                        </div>
                                            @if(funcOpen('FUNC_MANY_SHOP'))
                                               <?php $admin=auth('admin')->user();?>
                                                 @if($admin->system_tag)
                                                 <div class="form-group" >
                                                    <label for="name">选择店铺:</label>
                                                    <div class="row">
                                                    @foreach ($stores as $store)
                                                        <div class="col-sm-3">
                                                            <label>
                                                            {!! Form::checkbox('stores[]', $store->id, in_array($store->id, $selectedStores), ['class' => 'select_stores']) !!}
                                                            {!! $store->name !!}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div>
                                                @else
                                                    
                                                        <?php $shop = $admin->shop()->first();?>
                                                        @if($shop)
                                                            <input type="hidden" name="stores[]" value="{!! $shop->id !!}">
                                                        @endif
                                                    
                                                @endif
                                            @endif
                                        <div class="form-group">
                                            {!! Form::label('remark', '商品简介:') !!}
                                                {!! Form::text('remark', null, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('image', '图片:') !!}
                                            <div class="input-append">
                                                <!--input id="fieldID4" type="text" value=""-->
                                                {!! Form::text('image', null, ['class' => 'form-control', 'id' => 'image']) !!}
                                                <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button">更改</a>
                                                <img src="{{ $product->image }}" style="max-width: 100%; max-height: 150px; display: block;"></div>
                                        </div>

                                         
                                        <div class="row">
                                            @if(funcOpen('FUNC_BRAND'))
                                            <div class="form-group col-xs-4">
                                                {!! Form::label('brand', '商品品牌:') !!}
                                                    {!! Form::select('brand_id', $brands, null , ['class' => 'form-control']) !!}
                                            </div>
                                            @endif

                                            <div class="form-group col-xs-4">
                                                {!! Form::label('country_id', '产地:') !!}
                                                    {!! Form::select('country_id', $countries, null , ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('category', '商品分类:') !!}
                                            <div class="row">
                                                
                                                @if (getSettingValueByKey('category_level') >= 1)
                                                <div class="col-xs-4 col-sm-4 pr0-xs">
                                                    {!! Form::select('level01',$categories, $level01 , ['class' => 'form-control level01']) !!}
                                                </div>
                                                @endif

                                                @if (getSettingValueByKey('category_level') >= 2)
                                                <div class="col-xs-4 col-sm-4 pr0-xs">
                                                    {!! Form::select('level02',$second_cats, $level02 , ['class' => 'form-control level02']) !!}
                                                </div>
                                                @endif

                                                @if (getSettingValueByKey('category_level') >= 3)
                                                <div class="col-xs-4 col-sm-4">
                                                    {!! Form::select('level03',$third_cats,$level03 , ['class' => 'form-control level03']) !!}
                                                </div>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-xs-4">
                                                <label for="name">产品价格<span class="bitian">(必填):</span></label>
                                                    {!! Form::text('price', null, ['class' => 'form-control', 'onkeyup' => 'this.value=this.value.replace(/[^\d.]/g,&quot;&quot;)', 'onpaste' => 'this.value=this.value.replace(/[^\d.]/g,&quot;&quot;)']) !!}
                                            </div>

                                            <div class="form-group col-xs-4 pr0-xs">
                                                {!! Form::label('market_price', '市场价格:') !!}
                                                    {!! Form::text('market_price', null, ['class' => 'form-control', 'onkeyup' => 'this.value=this.value.replace(/[^\d.]/g,&quot;&quot;)', 'onpaste' => 'this.value=this.value.replace(/[^\d.]/g,&quot;&quot;)']) !!}
                                            </div>
                                            <div class="form-group col-xs-4 pr0-xs">
                                                {!! Form::label('cost', '产品成本:') !!}
                                                    {!! Form::text('cost', null, ['class' => 'form-control', 'onkeyup' => 'this.value=this.value.replace(/[^\d.]/g,&quot;&quot;)', 'onpaste' => 'this.value=this.value.replace(/[^\d.]/g,&quot;&quot;)']) !!}
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="form-group col-xs-4">
                                                    <label for="name">所需{{ getSettingValueByKeyCache('credits_alias') }}</label>
                                                    {!! Form::number('jifen', null, ['class' => 'form-control', 'onkeyup' => 'this.value=this.value.replace(/[^\d.]/g,&quot;&quot;)', 'onpaste' => 'this.value=this.value.replace(/[^\d.]/g,&quot;&quot;)']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('intro', '商品介绍') !!}
                                                {!! Form::textarea('intro', null, ['class' => 'form-control intro']) !!}
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="box box-primary mb10-xs">
                                    <div class="box-body">
                                        <label class="fb">
                                            {!! Form::checkbox('shelf', 1, null, ['class' => 'field minimal']) !!}上架
                                        </label>
                                    </div>
                                </div>
                                <div class="box box-primary">
                                    <div class="box-body">
                                        <!-- Submit Field -->
                                        <div class="form-group">
                                            {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
                                            <a href="{!! route('products.index') !!}" class="btn btn-default">取消</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- 开启分销，并且按商品提成时设置 -->
                                @if(funcOpen('FUNC_DISTRIBUTION') && getSettingValueByKey('distribution')=='是' && getSettingValueByKey('distribution_type')=='商品')
                                    <div class="box ">
                                        <div class="box-body">
                                            <!-- Submit Field -->
                                            <div class="form-group">
                                                {!! Form::label('commission', '佣金用于提成:') !!}
                                                {!! Form::text('commission', null, ['class' => 'form-control', 'onkeyup' => 'this.value=this.value.replace(/[^\d.]/g,&quot;&quot;)', 'onpaste' => 'this.value=this.value.replace(/[^\d.]/g,&quot;&quot;)']) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="box box-primary mb10-xs">
                                    <div class="box-body">

                                        <div class="row">
                                            <div class="form-group col-xs-12 pr0-xs">
                                                {!! Form::label('sn', '商品货号:') !!}
                                                        {!! Form::text('sn', null, ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="form-group col-xs-12 pr0-xs">
                                                {!! Form::label('sort', '排序权重:') !!}
                                                {!! Form::number('sort', null, ['class' => 'form-control', ]) !!}
                                                <p class="help-block">权重越高，排序越靠前</p>
                                            </div>
                                            <div class="form-group col-xs-12 pr0-xs">
                                                {!! Form::label('sales_count', '已售数量:') !!}
                                                {!! Form::text('sales_count', null, ['class' => 'form-control']) !!}
                                            </div>
                                            <!--div class="form-group col-xs-4 pr0-xs">
                                                {!! Form::label('sku', 'SKU:') !!}
                                                        {!! Form::text('sku', null, ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="form-group col-xs-4">
                                                {!! Form::label('spu', 'SPU:') !!}
                                                        {!! Form::text('spu', null, ['class' => 'form-control']) !!}
                                            </div-->
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-xs-12">
                                                {!! Form::label('inventory', '总库存') !!}
                                                {!! Form::number('inventory', null, ['class' => 'form-control']) !!}
                                                <p class="help-block">用后购买商品会消耗库存，库存消耗完后，用户将无法购买该商品。如果是无限量供应，请将库存设置为-1</p>
                                            </div>
                                            <!--div class="form-group col-xs-6">
                                                {!! Form::label('keywords', '关键词') !!}
                                                    {!! Form::text('keywords', null, ['class' => 'form-control']) !!}
                                            </div-->
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-xs-12">
                                                {!! Form::label('weight', '重量(单位:克):') !!}
                                                {!! Form::text('weight', null, ['class' => 'form-control']) !!}
                                                <p class="help-block">用于计算邮费，免邮费可以设置重量为0</p>
                                            </div>
                                            <!--div class="form-group col-xs-6">
                                                <label for="free_shipping" class="control-label">是否包邮</label>
                                                <div class="">
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="free_shipping" value=1 @if($product->
                                                            free_shipping == 1) checked="checked" @endif>
                                                          是
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="free_shipping" value=0 @if($product->
                                                            free_shipping == 0) checked="checked" @endif>
                                                          否
                                                        </label>
                                                    </div>
                                                </div>
                                            </div-->
                                            <div class="form-group col-xs-4">
                                                {!! Form::label('is_hot', '热销商品:') !!}
                                                    {!! Form::select('is_hot', [0 => '否', 1 => '是'], null , ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="form-group col-xs-4">
                                                {!! Form::label('is_new', '新品上市:') !!}
                                                    {!! Form::select('is_new', [0 => '否', 1 => '是'], null , ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-6"> {!! Form::label('words', '产品保障:') !!}</div>
                                            <div class="form-group col-xs-12" style="overflow: hidden;">

                                                @foreach ($wordlist as $item)
                                                <div style="float: left; margin-right: 20px; ">
                                                    <label>
                                                        {!! Form::checkbox('words[]', $item->id, in_array($item->id, $selectedWords)) !!}
                                                            {!! $item->name !!}
                                                    </label>
                                                </br>
                                                </div>
                                            @endforeach
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box box-primary visible-xs mb10-xs">
                                    <div class="box-body">
                                        <!-- Submit Field -->
                                        <div class="form-group">
                                            {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
                                            <a href="{!! route('products.index') !!}" class="btn btn-default">取消</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.box-body --> </div>
            </div>

            <!-- /.tab-pane -->
            <div class="tab-pane {!! $edit_rember?'active':'' !!}" id="tab_2">
                <div class="box ">
                    <!-- form start -->
                    <div class="box-body">
                        <section class="content-header" style="height: 50px; padding: 0; padding-top: 15px;">
                            <input type="hidden" name="addimage" value="" id="product_image">
                            <input type="hidden" id="product_id" value="{{$product->id}}"></input>
                        <h1 class="pull-left" style="font-size: 14px; font-weight: bold; line-height: 34px;">展示图片</h1>
                        <h3 class="pull-right" style="margin: 0">
                            <div class="pull-right" style="margin: 0">
                                <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn btn-primary" type="button" onclick="productimage('product_image')">添加商品图片</a>
                            </div>
                        </h3>
                    </section>
                    <div class="images">
                        @foreach ($images as $image)
                        <div class="image-item" id="product_image_{{$image->
                            id}}">
                            <img src="{!! $image->
                            url !!}" alt="" style="max-width: 100%;">
                            <div class="tr">
                                <div class="btn btn-danger btn-xs" onclick="deletePic({{ $image->id }})">删除</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        <!-- /.tab-pane -->
        <div class="tab-pane {!! $spec_show ? 'active' : '' !!}" id="tab_3">
            <div class="box ">
                <!-- form start -->
                <form id="typeattrForm">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-2 col-md-2 col-lg-1 col-xl-1">商品模型:</div>
                            <div class="col-sm-8">
                                <select name="goods_type" id="spec_type" class="form-control" style="width:250px;">
                                    <option value="0">选择商品模型</option>
                                    @foreach ($types as $type)
                                    <option value="{{$type->
                                        id}}" @if($type->id == $product->type_id) selected="selected" @endif >{{$type->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <!-- ajax 返回规格-->

                            <div id="ajax_spec_data" class="col-xs-12 col-sm-12 col-md-8 col-lg-8"></div>
                            <div id="" class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="border-left:1px solid #ddd;">
                                <table class="table table-bordered" id="goods_attr_table">
                                    <tr>
                                        <td colspan="2"> <b>商品属性</b>
                                            ：
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>

                </form>
                <div class="box-footer">
                    <button class="btn btn-primary pull-right" onclick="saveTypeForm()">保存</button>
                </div>
            </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_4">
            <div class="box">
                <!-- form start -->
                <div class="box-body"></div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right" onclick="">保存</button>
                </div>
            </div>
        </div>
        <!-- /.tab-pane --> </div>
    <!-- /.tab-content -->
</div>
</div>
@include('admin.partials.imagemodel')
@include('admin.partials.imagemodel_product_spec')

@endsection

@section('scripts')
    @include('admin.products.partials.js')
    @include('admin.products.partials.js_edit')
@endsection