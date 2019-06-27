<!-- Name Field -->
<div class="form-group col-sm-12">
    <label for="name">名称<span class="bitian">(必填):</span></label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('type_id', '产品模型:') !!}
    {!! Form::select('type_id', $types, null, ['class' => 'form-control']) !!}
</div>

<!-- Isindex Field -->
<div class="form-group col-sm-12">
    {!! Form::label('isIndex', '是否索引:') !!}
    {!! Form::select('isIndex', ['否' => '否', '是' => '是'], null, ['class' => 'form-control']) !!}
    <p class="help-block">用于商品筛选</p>
</div>

<!-- Input Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('input_type', '输入类型:') !!}
    {!! Form::select('input_type', [0 => '手动输入', 1 => '列表选择', 2 => '手动多行输入'], null, ['class' => 'form-control']) !!}
</div>

<!-- Values Field -->
<div class="form-group col-sm-12">
    {!! Form::label('values', '可选择列表:') !!}
    {!! Form::text('values', null, ['class' => 'form-control']) !!}
    <p class="help-block">仅当“输入类型”为[列表选择]时设置，多个选择项以空格分隔</p>
</div>

<!-- Sort Field -->
<div class="form-group col-sm-12">
    {!! Form::label('sort', '排序:') !!}
    {!! Form::number('sort', null, ['class' => 'form-control']) !!}
    <p class="help-block">数值越小，越靠前</p>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('productAttrs.index') !!}" class="btn btn-default">取消</a>
</div>
