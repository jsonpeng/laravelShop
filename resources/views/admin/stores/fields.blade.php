<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', '店铺名称:') !!}<span class="bitian">(必填):</span>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-12">
    {!! Form::label('image', '店铺图片:') !!}

    <div class="input-append">
        {!! Form::text('image', null, ['class' => 'form-control', 'id' => 'image']) !!}
        <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button">选择图片</a>
        <img src="@if($store) {{$store->image}} @endif" style="max-width: 100%; max-height: 150px; display: block;">
    </div>
</div>

<div class="form-group col-sm-12">
    {!! Form::label('sort', '排序权重(越大排序越靠前):') !!}
    <?php 
        $sort = 0;
        if (isset($store)) 
        {
            $sort = null;
        }
    ?>
    {!! Form::number('sort', $sort, ['class' => 'form-control']) !!}
</div>

    {!! Form::hidden('jindu', null, ['class' => 'form-control']) !!}
    {!! Form::hidden('weidu', null, ['class' => 'form-control']) !!}



<div class="form-group col-sm-12" >
            <label for="stores_cats">选择适用分类:</label>
            @if(count($cats))
                <div class="row">
                    @foreach ($cats as $cat)
                        <div class="col-sm-3">
                            <label>
                                {!! Form::checkbox('stores_cats[]', $cat->id, in_array($cat->id, $selectedCats), ['class' => 'select_cats']) !!}
                                {!! $cat->name !!}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif
</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('address', '店铺地址:') !!}<span class="bitian">(必填):</span>
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12 map" style="margin: 0 auto;display: none;">
    <div id="allmap" style="height: 300px;"></div>
</div>

<div class="form-group col-sm-12">
    {!! Form::label('mobile', '联系电话:') !!}
    {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('stores.index') !!}" class="btn btn-default">返回</a>
</div>
