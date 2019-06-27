<table class="table table-responsive" id="orderCancels-table">
    <thead>
        <tr>
            <th>订单</th>
            <th>退款金额</th>
            <th>审核</th>
            <th>退款路径</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orderCancels as $orderCancel)
        <tr>
            <td>{!! $orderCancel->order_id !!}</td>
            <td>{!! $orderCancel->money !!}</td>
            <td>{!! $orderCancel->authStatus !!}</td>
            <td>{!! $orderCancel->refoundStatus !!}</td>
            <td>
                <div class='btn-group'>
                    <a href="{!! route('orderCancels.edit', [$orderCancel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>