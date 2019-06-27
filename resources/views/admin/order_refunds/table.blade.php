<table class="table table-responsive" id="orderRefunds-table">
    <thead>
        <tr>
            <th>商品</th>
            <th>用户</th>
            <th>售后类型</th>
            <th>状态</th>
            <th>退款金额</th>
            <th>退款余额</th>
            <th>积分退还</th>
            <th>退款路径</th>
            <th>用户已收到货</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orderRefunds as $orderRefund)
        <tr>
            <td>{!! $orderRefund->item_id !!}</td>
            <td>{!! $orderRefund->user_id !!}</td>
            <td>{!! $orderRefund->typeString !!}</td>
            <td>{!! $orderRefund->statusString !!}</td>
            <td>{!! $orderRefund->refund_money !!}</td>
            <td>{!! $orderRefund->refund_deposit !!}</td>
            <td>{!! $orderRefund->refund_credit !!}</td>
            <td>{!! $orderRefund->refundTypeString !!}</td>
            <td>{!! $orderRefund->isReceiveString !!}</td>
            <td>
                {!! Form::open(['route' => ['orderRefunds.destroy', $orderRefund->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('orderRefunds.edit', [$orderRefund->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>