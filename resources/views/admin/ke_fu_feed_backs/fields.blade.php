<!-- Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('type', '反馈类型:') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12">
    {!! Form::label('content', '反馈内容:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Tel Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tel', '联系电话:') !!}
    {!! Form::text('tel', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('keFuFeedBacks.index') !!}" class="btn btn-default">返回</a>
</div>
