<!-- Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('time', 'Time:') !!}
    {!! Form::text('time', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Change Field -->
<div class="form-group col-sm-6">
    {!! Form::label('change', 'Change:') !!}
    {!! Form::number('change', null, ['class' => 'form-control']) !!}
</div>

<!-- Detail Field -->
<div class="form-group col-sm-6">
    {!! Form::label('detail', 'Detail:') !!}
    {!! Form::text('detail', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('creditLogs.index') !!}" class="btn btn-default">Cancel</a>
</div>
