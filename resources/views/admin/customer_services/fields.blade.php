<!-- Name Field -->
<div class="form-group">
    <label for="name">名称<span class="bitian">(必填):</span></label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Platform Field -->
<div class="form-group">
    {!! Form::label('platform', '平台:') !!}
    {!! Form::select('platform', $platforms, $selectPlatforms , ['class' => 'form-control']) !!}
</div>

<!-- Job Field -->
<div class="form-group">
    {!! Form::label('job', '职位:') !!}
    {!! Form::select('job', $jobs, $selectJobs , ['class' => 'form-control']) !!}
</div>

<!-- Head Img Field -->
<div class="form-group">
    {!! Form::label('head_img', '头像:') !!}
    {!! Form::text('head_img', null, ['class' => 'form-control','id'=>'image1']) !!}
     <div class="input-append">
                                    <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button" onclick="changeImageId('image1')">选择图片</a>
                                    <img src="@if($customerService) {{ $customerService->head_img }} @endif" style="max-width: 100%; max-height: 150px; display: block;">
    </div>
</div>

<!-- Qr Code Field -->
<div class="form-group">
    {!! Form::label('qr_code', '二维码:') !!}
    {!! Form::text('qr_code', null, ['class' => 'form-control','id'=>'image2']) !!}
    <div class="input-append">
                                    <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button" onclick="changeImageId('image2')">选择图片</a>
                                    <img src="@if($customerService) {{ $customerService->qr_code }} @endif" style="max-width: 100%; max-height: 150px; display: block;">
    </div>
</div>

<!-- Commit Field -->
<div class="form-group">
    {!! Form::label('commit', '联系方式:') !!}
    {!! Form::text('commit', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', '是否显示:') !!}
<div class="radio">
    <label>
        <input type="radio" name="show" value="1" @if(!empty($customerService)) @if($customerService->show==1) checked="checked" @endif @endif)>是</label>
</div>
<div class="radio">
    <label>
        <input type="radio" name="show" value="0" @if(!empty($customerService)) @if($customerService->show==0) checked="checked" @endif @endif>否</label>
</div>
<!-- Submit Field -->
<div class="form-group">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('customerServices.index') !!}" class="btn btn-default">返回</a>
</div>
