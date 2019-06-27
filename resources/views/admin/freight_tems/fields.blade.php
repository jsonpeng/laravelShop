<!-- Name Field -->
<div class="form-group col-sm-12">
    <label for="name">运费模板名称<span class="bitian">(必填):</span></label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('name', '计价方式:') !!}
<div class="radio">
    <label>
        <input type="radio" name="count_type" value="0" @if(!empty($freightTem)) @if($freightTem->count_type==0) checked="checked" @endif @endif)>件数</label>
</div>
<div class="radio">
    <label>
        <input type="radio" name="count_type" value="1" @if(!empty($freightTem)) @if($freightTem->count_type==1) checked="checked" @endif @endif>重量</label>
</div>
{{-- <div class="radio">
    <label>
        <input type="radio" name="count_type" value="2" @if(!empty($freightTem)) @if($freightTem->count_type==2) checked="checked" @endif @endif>体积</label>
</div> --}}
</div>
<!-- Use Default Field -->
<div class="form-group col-sm-12">
    {!! Form::label('use_default', '使用系统默认:') !!}
   <div class="radio">
    <label>
        <input type="radio" name="use_default" value="1" @if(!empty($freightTem)) @if($freightTem->use_default==1) checked="checked" @endif @endif>是</label>
</div>
<div class="radio">
    <label>
        <input type="radio" name="use_default" value="0" @if(!empty($freightTem)) @if($freightTem->use_default==0) checked="checked" @endif @endif>否</label>
</div>
</div>

<div class="form-group col-sm-12" id="freight_type_0"  @if(!empty($freightTem)) style="display: {!! $freightTem->count_type==0?'block':'none' !!};" @else style="display: none;" @endif>
<a href="javascript:;" class="add_freight_cities" data-type="0">添加自定义区域</a>
<table class="table table-responsive" id="freight_tems-table">
    <thead>
        <th>配送区域</th>
        <th>首件</th>
        <th>运费</th>
        <th>续件</th>
        <th>运费</th>
        <th >操作</th>
    </thead>
    <tbody id="freight_tems_tbody0">
         @if(!empty($freightTem))
         @if($freightTem->count_type==0)
         @if(!empty($items))
            @foreach ($items as $item)
              <tr @if($item->id==1) class="all_area" @endif>
                    <td>@if($item->id==1) {!! $item->name !!} @endif
                        <input name="area_list[]" @if($item->id!=1)onclick="select_area(this)"@endif type="{!! $item->id!=1?'text':'hidden' !!}" value="{!! $item->name !!}"><input type="hidden" name="area_ids_list[]" value="{!! $item->id !!}" >
                    </td>
                    <td>
                        <input name="freight_first_count[]" value="{!! $item->pivot->freight_first_count !!}">件
                    </td>
                    <td>
                        <input name="the_freight[]" value="{!! $item->pivot->the_freight !!}">元
                    </td>
                    <td>
                        <input name="freight_continue_count[]" value="{!! $item->pivot->freight_continue_count !!}">件
                    </td>
                    <td>
                        <input name="freight_continue_price[]" value="{!! $item->pivot->freight_continue_price !!}">元
                    </td>
                    <td>
                        <button class="btn btn-danger btn-xs" type="button" onclick="del_freight_item(this)"><i class="glyphicon glyphicon-trash"></i>删除</button>
                    </td>
              </tr>
            @endforeach
        @endif
        @endif
        @endif
    </tbody>
</table>
</div>

<div class="form-group col-sm-12" id="freight_type_1" @if(!empty($freightTem)) style="display: {!! $freightTem->count_type==1?'block':'none' !!};" @else style="display: none;" @endif>
<a href="javascript:;" class="add_freight_cities" data-type="1">添加自定义区域</a>
<table class="table table-responsive" id="freight_tems-table">
    <thead>
        <th>配送区域</th>
        <th>首重</th>
        <th>运费</th>
        <th>续重</th>
        <th>运费</th>
        <th>操作</th>
    </thead>
    <tbody id="freight_tems_tbody1">
       @if(!empty($freightTem))
        @if($freightTem->count_type==1)
        @if(!empty($items))
            @foreach ($items as $item)
              <tr @if($item->id==1) class="all_area" @endif>
                    <td>@if($item->id==1) {!! $item->name !!} @endif
                        <input name="area_list[]" @if($item->id!=1) onclick="select_area(this)" @endif type="{!! $item->id!=1?'text':'hidden' !!}" value="{!! $item->name !!}"><input type="hidden" name="area_ids_list[]" value="{!! $item->id !!}" >
                    </td>
                    <td>
                        <input name="freight_first_count[]" value="{!! $item->pivot->freight_first_count !!}">克
                    </td>
                    <td>
                        <input name="the_freight[]" value="{!! $item->pivot->the_freight !!}">元
                    </td>
                    <td>
                        <input name="freight_continue_count[]" value="{!! $item->pivot->freight_continue_count !!}">克
                    </td>
                    <td>
                        <input name="freight_continue_price[]" value="{!! $item->pivot->freight_continue_price !!}">元
                    </td>
                    <td>
                        <button class="btn btn-danger btn-xs" type="button" onclick="del_freight_item(this)"><i class="glyphicon glyphicon-trash"></i>删除</button>
                    </td>
            </tr>
            @endforeach
        @endif
        @endif
       @endif
    </tbody>
</table>
</div>

<div class="form-group col-sm-12" id="freight_type_2"  @if(!empty($freightTem)) style="display: {!! $freightTem->count_type==2?'block':'none' !!};" @else style="display: none;" @endif>
<a href="javascript:;" class="add_freight_cities" data-type="2">添加自定义区域</a>
<table class="table table-responsive" id="freight_tems-table">
    <thead>
        <th>配送区域</th>
        <th>首体积</th>
        <th>运费</th>
        <th>续体积</th>
        <th>运费</th>
        <th>操作</th>
    </thead>
    <tbody id="freight_tems_tbody2">
        @if(!empty($freightTem))
         @if($freightTem->count_type==2)
        @if(!empty($items))
            @foreach ($items as $item)
              <tr @if($item->id==1) class="all_area" @endif>
                    <td>@if($item->id==1) {!! $item->name !!} @endif
                        <input name="area_list[]" @if($item->id!=1) onclick="select_area(this)" @endif type="{!! $item->id!=1?'text':'hidden' !!}" value="{!! $item->name !!}"><input type="hidden" name="area_ids_list[]" value="{!! $item->id !!}" >
                    </td>
                    <td>
                        <input name="freight_first_count[]" value="{!! $item->pivot->freight_first_count !!}">立方米
                    </td>
                    <td>
                        <input name="the_freight[]" value="{!! $item->pivot->the_freight !!}">元
                    </td>
                    <td>
                        <input name="freight_continue_count[]" value="{!! $item->pivot->freight_continue_count !!}">立方米
                    </td>
                    <td>
                        <input name="freight_continue_price[]" value="{!! $item->pivot->freight_continue_price !!}">元
                    </td>
                    <td>
                        <button class="btn btn-danger btn-xs" type="button" onclick="del_freight_item(this)"><i class="glyphicon glyphicon-trash"></i>删除</button>
                    </td>
            </tr>
            @endforeach
        @endif
        @endif
       @endif
    </tbody>
</table>
</div>

<div class="freights_tr_select" style="display: none;">
{{-- <tr><td><input name="area_list[]" onclick="select_area()"></td><td><input name="freight_first_count[]" >件</td><td><input name="the_freight[]">元</td><td><input name="freight_continue_count[]">件</td><td><input name="freight_continue_price[]">元</td><td><button class="btn btn-danger btn-xs" type="button" onclick="del_freight_item(this)"><i class="glyphicon glyphicon-trash"></i>删除</button></td></tr> --}}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('freightTems.index') !!}" class="btn btn-default">返回</a>
</div>
