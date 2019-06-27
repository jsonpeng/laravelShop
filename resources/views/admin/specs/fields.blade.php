<!-- Name Field -->
<div class="form-group col-sm-12">
    <label for="name">规格名称<span class="bitian">(必填):</span></label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('selections', '规格选项:') !!}
    {!! Form::textarea('selections', $selections, ['class' => 'form-control']) !!}
    <p class="help-block">多个选择使用回车换行，一行一个选项</p>
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

<!-- Type Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('type_id', '产品模型:') !!}
    {!! Form::select('type_id', $types, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('specs.index') !!}" class="btn btn-default">取消</a>
</div>
