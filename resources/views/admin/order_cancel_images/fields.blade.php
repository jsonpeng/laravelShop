<!-- Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Cancel Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_cancel_id', 'Order Cancel Id:') !!}
    {!! Form::number('order_cancel_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('orderCancelImages.index') !!}" class="btn btn-default">Cancel</a>
</div>
