<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', '姓名:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Card Field -->
<div class="form-group col-sm-12">
    {!! Form::label('id_card', '身份证号:') !!}
    {!! Form::text('id_card', null, ['class' => 'form-control']) !!}
</div>

<!-- Face Image Field -->
<div class="form-group col-sm-12">
    {!! Form::label('face_image', '人脸照:') !!}
    {!! Form::text('face_image', null, ['class' => 'form-control']) !!}
</div>

<!-- Back Image Field -->
<div class="form-group col-sm-12">
    {!! Form::label('back_image', '背面国徽照:') !!}
    {!! Form::text('back_image', null, ['class' => 'form-control']) !!}
</div>

<!-- Hand Image Field -->
<div class="form-group col-sm-12">
    {!! Form::label('hand_image', '手持身份证照:') !!}
    {!! Form::text('hand_image', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('user_id', '发布人:') !!}
    {!! Form::text('user_name', optional($certs->user()->first())->nickname, ['class' => 'form-control','readonly'=>'readonly']) !!}
    {!! Form::hidden('user_id', null, ['class' => 'form-control']) !!}

</div>

<div class="form-group col-sm-12">
    {!! Form::label('status', '审核状态:') !!}
    <select name="status" class="form-control">
        <option value="审核中" @if($certs && $certs->status=='审核中') selected="selected" @endif>审核中</option>
        <option value="已通过" @if($certs && $certs->status=='已通过') selected="selected" @endif>已通过</option>
        <option value="未通过" @if($certs && $certs->status=='未通过') selected="selected" @endif>未通过</option>
    </select>
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('certs.index') !!}" class="btn btn-default">返回</a>
</div>
