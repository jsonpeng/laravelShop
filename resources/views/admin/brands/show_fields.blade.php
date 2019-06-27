<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $brand->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $brand->name !!}</p>
</div>

<!-- Intro Field -->
<div class="form-group">
    {!! Form::label('intro', 'Intro:') !!}
    <p>{!! $brand->intro !!}</p>
</div>

<!-- Sort Field -->
<div class="form-group">
    {!! Form::label('sort', 'Sort:') !!}
    <p>{!! $brand->sort !!}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <img src="{!! $brand->image !!}" style="display: block; max-height: 150px; max-width: 100%;">
    <p></p>
</div>

<!-- Parent Id Field -->
<div class="form-group">
    {!! Form::label('parent_id', 'Parent Id:') !!}
    <p>{!! $brand->parent !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $brand->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $brand->updated_at !!}</p>
</div>

