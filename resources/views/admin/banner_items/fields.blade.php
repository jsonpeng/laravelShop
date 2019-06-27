
<div class="form-group col-sm-12">
    <label for="name">图像<span class="bitian">(必填):</span></label>
    <div class="input-append">
        {!! Form::text('image', null, ['class' => 'form-control', 'id' => 'image']) !!}
        <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button">选择图片</a>
        <img src="@isset($bannerItem) {{$bannerItem->image}} @endisset" style="max-width: 100%; max-height: 150px; display: block;">
    </div>

</div>

<!-- Link Field -->
<div class="form-group col-sm-12">
    {!! Form::label('link_type', '链接设置:') !!}
    <select name="link_type" class="form-control">
            <option value="" @if(empty($bannerItem) || !empty($bannerItem) && empty($bannerItem->link_type) ) selected="selected" @endif>请选择链接方式</option>
            <option value="product" @if(!empty($bannerItem) && $bannerItem->link_type=='product') selected="selected" @endif>跳转商品</option>
            <option value="cat"  @if(!empty($bannerItem) && $bannerItem->link_type=='cat') selected="selected" @endif>跳转分类</option>
            <option value="brand"  @if(!empty($bannerItem) && $bannerItem->link_type=='brand') selected="selected" @endif>跳转品牌</option>
            <option value="custom" @if(!empty($bannerItem) && $bannerItem->link_type=='custom') selected="selected" @endif>自定义跳转</option>
    </select>
</div>


<div class="form-group col-sm-12 web_link" style="display: @if(!empty($bannerItem) && !empty($bannerItem->link_type)) block @else none @endif;">
    {!! Form::label('link', '公众号/网页跳转链接:') !!}
    {!! Form::text('link', null, ['class' => 'form-control','readonly'=>'readonly']) !!}
</div>

<div class="form-group col-sm-12 mini_link" style="display: @if(!empty($bannerItem) && !empty($bannerItem->link_type)) block @else none @endif;">
    {!! Form::label('mini_link', '小程序跳转链接:') !!}
    {!! Form::text('mini_link', null, ['class' => 'form-control','readonly'=>'readonly']) !!}
</div>

<!-- Sort Field -->
<div class="form-group col-sm-12">
    {!! Form::label('sort', '排序(数值越大，权重越大，排序越靠前):') !!}
    {!! Form::number('sort', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('bannerItems.index', $banner_id) !!}" class="btn btn-default">取消</a>
</div>

<div id="product_items_table" style="display: none;"> </div>
