<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Coupon Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('coupon_id', 'Coupon Id:') !!}
    {!! Form::number('coupon_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Coupon Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('coupon_type', 'Coupon Type:') !!}
    {!! Form::number('coupon_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_id', 'Order Id:') !!}
    {!! Form::number('order_id', null, ['class' => 'form-control']) !!}
</div>

<!-- From Way Field -->
<div class="form-group col-sm-6">
    {!! Form::label('from_way', 'From Way:') !!}
    {!! Form::text('from_way', null, ['class' => 'form-control']) !!}
</div>

<!-- Use Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('use_time', 'Use Time:') !!}
    {!! Form::text('use_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::number('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('couponUsers.index') !!}" class="btn btn-default">Cancel</a>
</div>
