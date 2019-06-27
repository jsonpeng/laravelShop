<!-- Admin Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('admin_id', 'Admin Id:') !!}
    {!! Form::text('admin_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Shop Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shop_id', 'Shop Id:') !!}
    {!! Form::text('shop_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('adminShops.index') !!}" class="btn btn-default">Cancel</a>
</div>
