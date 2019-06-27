<!-- Name Field -->
<div class="form-group col-sm-12">
  {!! Form::label('name', '字段名称:') !!}
   @if(Request::is('zcjy/*/customPostTypeItems*/edit'))
    {!! Form::hidden('name', null, ['class' => 'form-control']) !!}
    {!! Form::text('name', null, ['class' => 'form-control','disabled'=>'disabled']) !!}
   @else
   {!! Form::text('name', null, ['class' => 'form-control']) !!}
   @endif
</div>

<!-- Des Field -->
<div class="form-group col-sm-12">
  {!! Form::label('des', '描述:') !!}
    {!! Form::text('des', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-12">
  {!! Form::label('type', '表单类型:') !!}
  <select class="form-control"  name="type" id="items_select">
    <option  value="image"   @if(!empty($customPostTypeItems))@if($customPostTypeItems->type=="image") selected @endif @endif>image(适用于上传图片)</option>
    <option  value="text"   @if(!empty($customPostTypeItems))@if($customPostTypeItems->type=="text") selected @endif @endif>text(适用于单行文本)</option>
    <option  value="textarea"   @if(!empty($customPostTypeItems))@if($customPostTypeItems->
      type=="textarea") selected @endif @endif>textarea(适用于多行文本,不可添加图片)
    </option>
    <option  value="number"   @if(!empty($customPostTypeItems))@if($customPostTypeItems->type=="number") selected @endif @endif>number(适用于简单的数字)</option>
    <option  value="select"   @if(!empty($customPostTypeItems))@if($customPostTypeItems->
      type=="select") selected @endif @endif>select(适用于多项预设的值,只能选一个)
    </option>
    <option  value="checkbox"   @if(!empty($customPostTypeItems))@if($customPostTypeItems->
      type=="checkbox") selected @endif @endif>checkbox(适用于多项预设的值,可选多个)
    </option>
    <option  value="longText"   @if(!empty($customPostTypeItems))@if($customPostTypeItems->
      type=="longText") selected @endif @endif>longText(适用于多行文本,可添加图片)
    </option>
  </select>
</div>

<div class="form-group col-sm-12" id="items_value" style="display:{!! empty($customPostTypeItems)?'none':'block' !!};">
  {!! Form::label('value', '设定预设值:') !!}
    {!! Form::text('value', null, ['class' => 'form-control','placeholder'=>'多个请用逗号隔开']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('customPostTypeItems.index',[$customPostType->id]) !!}" class="btn btn-default">返回</a>
</div>