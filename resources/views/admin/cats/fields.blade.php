<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', '分类名称:') !!}<span class="bitian">(必填)</span>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('image', '分类图片:') !!}
      <div class="input-append">
        <!--input id="fieldID4" type="text" value=""-->
        {!! Form::text('image', null, ['class' => 'form-control', 'id' => 'image']) !!}
        <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button">更改</a>
        <img src="@if(isset($cats))
            {{$cats->image}}
        @endif" style="max-width: 100%; max-height: 150px; display: block;">
    </div>
</div>



<!-- Sort Field -->
<div class="form-group col-sm-12">
    {!! Form::label('sort', '权重(权重越大排名显示越靠前):') !!}
    {!! Form::text('sort', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('cats.index') !!}" class="btn btn-default">返回</a>
</div>
