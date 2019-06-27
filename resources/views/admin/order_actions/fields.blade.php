<!-- Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_id', 'Order Id:') !!}
    {!! Form::number('order_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_status', 'Order Status:') !!}
    {!! Form::text('order_status', null, ['class' => 'form-control']) !!}
</div>

<!-- Shipping Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shipping_status', 'Shipping Status:') !!}
    {!! Form::text('shipping_status', null, ['class' => 'form-control']) !!}
</div>

<!-- Pay Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pay_status', 'Pay Status:') !!}
    {!! Form::text('pay_status', null, ['class' => 'form-control']) !!}
</div>

<!-- Action Field -->
<div class="form-group col-sm-6">
    {!! Form::label('action', 'Action:') !!}
    {!! Form::text('action', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Desc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_desc', 'Status Desc:') !!}
    {!! Form::text('status_desc', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('orderActions.index') !!}" class="btn btn-default">Cancel</a>
</div>
