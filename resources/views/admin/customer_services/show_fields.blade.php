<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $customerService->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $customerService->name !!}</p>
</div>

<!-- Platform Field -->
<div class="form-group">
    {!! Form::label('platform', 'Platform:') !!}
    <p>{!! $customerService->platform !!}</p>
</div>

<!-- Job Field -->
<div class="form-group">
    {!! Form::label('job', 'Job:') !!}
    <p>{!! $customerService->job !!}</p>
</div>

<!-- Head Img Field -->
<div class="form-group">
    {!! Form::label('head_img', 'Head Img:') !!}
    <p>{!! $customerService->head_img !!}</p>
</div>

<!-- Qr Code Field -->
<div class="form-group">
    {!! Form::label('qr_code', 'Qr Code:') !!}
    <p>{!! $customerService->qr_code !!}</p>
</div>

<!-- Commit Field -->
<div class="form-group">
    {!! Form::label('commit', 'Commit:') !!}
    <p>{!! $customerService->commit !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $customerService->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $customerService->updated_at !!}</p>
</div>

