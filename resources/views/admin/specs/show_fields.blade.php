<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $spec->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $spec->name !!}</p>
</div>

<!-- Sort Field -->
<div class="form-group">
    {!! Form::label('sort', 'Sort:') !!}
    <p>{!! $spec->sort !!}</p>
</div>

<!-- Type Id Field -->
<div class="form-group">
    {!! Form::label('type_id', 'Type Id:') !!}
    <p>{!! $spec->type_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $spec->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $spec->updated_at !!}</p>
</div>

