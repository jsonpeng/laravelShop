<!-- Order Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('order_id', '订单') !!}
    {!! Form::number('order_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Reason Field -->
<div class="form-group col-sm-12">
    {!! Form::label('reason', '取消原因:') !!}
    {!! Form::text('reason', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
</div>

<!-- Money Field -->
<div class="form-group col-sm-12">
    {!! Form::label('money', '退款金额:') !!}
    @if($orderCancel->auth != 0)
        {!! Form::text('money', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    @else
        {!! Form::text('money', null, ['class' => 'form-control']) !!}
    @endif
</div>

<div class="form-group col-sm-12">
    {!! Form::label('user_money', '退还余额:') !!}
    @if($orderCancel->auth != 0)
        {!! Form::text('user_money', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    @else
        {!! Form::text('user_money', null, ['class' => 'form-control']) !!}
    @endif
</div>

<div class="form-group col-sm-12">
    {!! Form::label('credits', '退还'.getSettingValueByKeyCache('credits_alias').':') !!}
    @if($orderCancel->auth != 0)
        {!! Form::text('credits', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    @else
        {!! Form::text('credits', null, ['class' => 'form-control']) !!}
    @endif
</div>


<!-- Auth Field -->
<div class="form-group col-sm-12">
    {!! Form::label('auth', '审核:') !!}
    @if($orderCancel->auth != 0)
        {!! Form::select('auth', [0 => '待处理', 1 => '通过', 2 => '不通过'] , null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    @else
        {!! Form::select('auth', [0 => '待处理', 1 => '通过', 2 => '不通过'] , null, ['class' => 'form-control']) !!}
    @endif
    
</div>

<!-- Refound Field -->
<div class="form-group col-sm-12">
    {!! Form::label('refound', '退款路径:') !!}
    @if($orderCancel->auth != 0)
        {!! Form::select('refound', [0 => '原路返回', 1 => '返回到余额'] , null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    @else
        {!! Form::select('refound', [0 => '原路返回', 1 => '返回到余额'] , null, ['class' => 'form-control']) !!}
    @endif
    
</div>

<!-- Remark Field -->
<div class="form-group col-sm-12">
    {!! Form::label('remark', '备注:') !!}
    {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('orderCancels.index') !!}" class="btn btn-default">取消</a>
</div>
