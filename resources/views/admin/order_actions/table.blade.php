<table class="table table-responsive" id="orderActions-table">
    <thead>
        <tr>
            <th>Order Id</th>
        <th>User Id</th>
        <th>Order Status</th>
        <th>Shipping Status</th>
        <th>Pay Status</th>
        <th>Action</th>
        <th>Status Desc</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orderActions as $orderAction)
        <tr>
            <td>{!! $orderAction->order_id !!}</td>
            <td>{!! $orderAction->user_id !!}</td>
            <td>{!! $orderAction->order_status !!}</td>
            <td>{!! $orderAction->shipping_status !!}</td>
            <td>{!! $orderAction->pay_status !!}</td>
            <td>{!! $orderAction->action !!}</td>
            <td>{!! $orderAction->status_desc !!}</td>
            <td>
                {!! Form::open(['route' => ['orderActions.destroy', $orderAction->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('orderActions.show', [$orderAction->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('orderActions.edit', [$orderAction->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>