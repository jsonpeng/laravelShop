<table class="table table-responsive" id="couponUsers-table">
    <thead>
        <tr>
            <th>User Id</th>
        <th>Coupon Id</th>
        <th>Coupon Type</th>
        <th>Order Id</th>
        <th>From Way</th>
        <th>Use Time</th>
        <th>Code</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($couponUsers as $couponUser)
        <tr>
            <td>{!! $couponUser->user_id !!}</td>
            <td>{!! $couponUser->coupon_id !!}</td>
            <td>{!! $couponUser->coupon_type !!}</td>
            <td>{!! $couponUser->order_id !!}</td>
            <td>{!! $couponUser->from_way !!}</td>
            <td>{!! $couponUser->use_time !!}</td>
            <td>{!! $couponUser->code !!}</td>
            <td>{!! $couponUser->status !!}</td>
            <td>
                {!! Form::open(['route' => ['couponUsers.destroy', $couponUser->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('couponUsers.show', [$couponUser->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('couponUsers.edit', [$couponUser->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>