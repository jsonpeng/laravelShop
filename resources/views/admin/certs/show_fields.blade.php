<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $certs->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $certs->name !!}</p>
</div>

<!-- Id Card Field -->
<div class="form-group">
    {!! Form::label('id_card', 'Id Card:') !!}
    <p>{!! $certs->id_card !!}</p>
</div>

<!-- Face Image Field -->
<div class="form-group">
    {!! Form::label('face_image', 'Face Image:') !!}
    <p>{!! $certs->face_image !!}</p>
</div>

<!-- Back Image Field -->
<div class="form-group">
    {!! Form::label('back_image', 'Back Image:') !!}
    <p>{!! $certs->back_image !!}</p>
</div>

<!-- Hand Image Field -->
<div class="form-group">
    {!! Form::label('hand_image', 'Hand Image:') !!}
    <p>{!! $certs->hand_image !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $certs->user_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $certs->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $certs->updated_at !!}</p>
</div>

