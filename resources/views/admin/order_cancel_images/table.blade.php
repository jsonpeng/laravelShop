<table class="table table-responsive" id="orderCancelImages-table">
    <thead>
        <tr>
            <th>Url</th>
        <th>Order Cancel Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orderCancelImages as $orderCancelImage)
        <tr>
            <td>{!! $orderCancelImage->url !!}</td>
            <td>{!! $orderCancelImage->order_cancel_id !!}</td>
            <td>
                {!! Form::open(['route' => ['orderCancelImages.destroy', $orderCancelImage->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('orderCancelImages.show', [$orderCancelImage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('orderCancelImages.edit', [$orderCancelImage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>