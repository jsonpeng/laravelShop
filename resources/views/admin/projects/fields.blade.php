<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', '项目名称') !!}<span class="bitian">(必填):</span></label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Mobile Field -->
<div class="form-group col-sm-12">
    {!! Form::label('mobile', '手机号') !!}<span class="bitian">(必填):</span></label>
    {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
</div>

<!-- Weixin Qq Field -->
<div class="form-group col-sm-12">
    {!! Form::label('weixin_qq', '微信/QQ') !!}<span class="bitian">(必填):</span></label>
    {!! Form::text('weixin_qq', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('address', '地址') !!}<span class="bitian">(必填):</span></label>
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12">
    {!! Form::label('content', '详情') !!}<span class="bitian">(必填):</span></label>
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-12">
                      <section class="content-header" style="height: 50px; padding: 0; padding-top: 15px;">
                           <h1 class="pull-left" style="font-size: 14px; font-weight: bold; line-height: 34px;padding-bottom: 0px;">展示图片</h1>
                           <h3 class="pull-right" style="margin: 0">
                                    <div class="pull-right" style="margin: 0">
                                        <a  href="javascript:;"  class="btn btn-primary" type="button" id="uploads_image">添加展示图片</a>
                                    </div>
                          </h3>
                     </section>

                    <div class="from-group images" id="success_image_box" style="display:@if(count($images)) flex @else none @endif;">
                            @foreach ($images as $image)
                                <div class="dz-preview dz-file-preview uploads_box">
                                    <img class="success_img" src="{!! $image->image !!}"/>
                                    <input type="hidden" name="project_images[]" value="{!! $image->image !!}">
                                    <span class="dz-progress"></span>
                                    <div class="zhezhao" data-status="none" style="display: none;"></div>
                                    <a class="remove" href="javascript:;" onclick="remove(this)">删除</a>
                                </div>
                            @endforeach
                    </div>
</div>

    {!! Form::hidden('jindu', null, ['class' => 'form-control']) !!}
    {!! Form::hidden('weidu', null, ['class' => 'form-control']) !!}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('projects.index') !!}" class="btn btn-default">返回</a>
</div>
