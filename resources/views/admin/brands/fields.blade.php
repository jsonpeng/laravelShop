<!-- Name Field -->
<div class="form-group col-sm-12">
    <label for="name">品牌名称<span class="bitian">(必填):</span></label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Intro Field -->
<div class="form-group col-sm-12">
    {!! Form::label('intro', '介绍:') !!}
    {!! Form::text('intro', null, ['class' => 'form-control']) !!}
</div>

<!-- Sort Field -->
<div class="form-group col-sm-12">
    {!! Form::label('sort', '排序:') !!}
    <?php 
        $sort = 50;
        if (!empty($category)) {
            $sort = null;
        }
    ?>
    {!! Form::number('sort', $sort, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-12">
    {!! Form::label('image', '品牌LOGO:') !!}
    <div class="input-append">
        {!! Form::text('image', null, ['class' => 'form-control', 'id' => 'image']) !!}
        <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button">更改</a>
        <img src="@if($brand)
            {{$brand->image}}
        @endif" style="max-width: 100%; max-height: 150px; display: block;">
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('brands.index') !!}" class="btn btn-default">取消</a>
</div>
