
{{--     @if(empty($card))
     {!! Form::hidden('number', $new_code, ['class' => 'form-control','readonly'=>'readonly']) !!}
    @else
     {!! Form::hidden('number', null, ['class' => 'form-control','readonly'=>'readonly']) !!}
    @endif --}}

<!-- Price Field -->
{{-- <div class="form-group col-sm-12">
    {!! Form::label('price', '金额:') !!}<span class="bitian">(必填)</span>
   
</div> --}}
{!! Form::hidden('price', 1000, ['class' => 'form-control']) !!}
<!-- Num Field -->
<div class="form-group col-sm-12">
    {!! Form::label('num', '货呗面额:') !!}<span class="bitian">(必填)</span>
    {!! Form::text('num', null, ['class' => 'form-control']) !!}
</div>

@if(!empty($card))
    <!-- Password Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('password', '密码:') !!}
        {!! Form::text('password',null, ['class' => 'form-control']) !!}
    </div>
@endif

@if(!empty($card))
    <div class="form-group col-sm-12">
        {!! Form::label('status', '使用(使用)状态:') !!}
        <select name="status" class="form-control">
            <option value="0" @if($card->status == 0) selected="selected" @endif>未使用</option>
            <option value="1" @if($card->status == 1) selected="selected" @endif>已使用</option>
        </select>
    </div>
@else
{{--     <div class="form-group col-sm-12">
        {!! Form::label('length', '生成卡号位数:') !!}
        <select name="length" class="form-control">
            <option value="8">8位</option>
            <option value="12">12位</option>
            <option value="16">16位</option>
        </select>
    </div> --}}
    
    <div class="form-group col-sm-12">
        {!! Form::label('card_num', '批量生成数量(不填生成一个):') !!}
        {!! Form::text('card_num', null, ['class' => 'form-control']) !!}
    </div>
@endif


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('cards.index') !!}" class="btn btn-default">返回</a>
</div>
