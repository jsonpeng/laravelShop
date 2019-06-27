<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', '退款编号:') !!}
    <p>{!! $refundMoney->id !!}</p>
</div>

<!-- Snumber Field -->
<div class="form-group">
    {!! Form::label('snumber', '商户订单号:') !!}
    <p>{!! $refundMoney->snumber !!}</p>
</div>

<!-- Transaction Id Field -->
<div class="form-group">
    {!! Form::label('transaction_id', '平台订单号:') !!}
    <p>{!! $refundMoney->transaction_id !!}</p>
</div>

<!-- Total Fee Field -->
<div class="form-group">
    {!! Form::label('platform', '支付方式:') !!}
    <p>{!! $refundMoney->platform !!}</p>
</div>

<!-- Total Fee Field -->
<div class="form-group">
    {!! Form::label('snumber_refund', '退款单号:') !!}
    <p>{!! $refundMoney->snumber_refund !!}</p>
</div>

<div class="form-group">
    {!! Form::label('total_fee', '订单费用:') !!}
    <p>{!! $refundMoney->total_fee !!}</p>
</div>

<!-- Refund Fee Field -->
<div class="form-group">
    {!! Form::label('refund_fee', '退款金额:') !!}
    <p>{!! $refundMoney->refund_fee !!}</p>
</div>

<!-- Desc Field -->
<div class="form-group">
    {!! Form::label('desc', '退款原因:') !!}
    <p>{!! $refundMoney->desc !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', '退款状态:') !!}
    <p>{!! $refundMoney->status !!}</p>
</div>

<!-- Last Query Field -->
<div class="form-group">
    {!! Form::label('last_query', '最新查询时间:') !!}
    <p>{!! $refundMoney->last_query !!}</p>
</div>

<!-- Remark Field -->
<div class="form-group">
    {!! Form::label('remark', '备注:') !!}
    <p>{!! $refundMoney->remark !!}</p>
</div>

@if ($refundMoney->order_type == '取消订单')
    <a href="/zcjy/orders/{{ $refundMoney->order_id }}">查看订单详情</a>
@elseif($refundMoney->order_type == '售后退款')
    <a href="/zcjy/orderRefunds/{{ $refundMoney->order_id }}/edit">查看售后订单</a>
@endif

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', '提交申请时间:') !!}
    <p>{!! $refundMoney->created_at !!}</p>
</div>
