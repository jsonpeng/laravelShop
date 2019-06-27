<table class="table table-responsive" id="refundMoneys-table">
    <thead>
        <tr>
            <th>商户订单号</th>
            <th>平台订单号</th>
            <th>退款单号</th>
            <th>支付方式</th>
            <th>订单总金额</th>
            <th>退款金额</th>
            <th>退款原因</th>
            <th>退款状态</th>
            <th>查询时间</th>
            <th>备注</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($refundMoneys as $refundMoney)
        <tr>
            <td>{!! $refundMoney->snumber !!}</td>
            <td>{!! $refundMoney->transaction_id !!}</td>
            <td>{!! $refundMoney->snumber_refund !!}</td>
            <td>{!! $refundMoney->platform !!}</td>
            <td>{!! $refundMoney->total_fee !!}</td>
            <td>{!! $refundMoney->refund_fee !!}</td>
            <td>{!! $refundMoney->desc !!}</td>
            <td>{!! $refundMoney->status !!}</td>
            <td>{!! $refundMoney->last_query !!}</td>
            <td>{!! $refundMoney->remark !!}</td>
            <td>

                <div class='btn-group'>
                    <a href="{!! route('refundMoneys.show', [$refundMoney->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                </div>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>