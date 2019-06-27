<table class="table table-responsive" id="creditLogs-table">
    <thead>
        <tr>
            <th>Time</th>
        <th>Amount</th>
        <th>Change</th>
        <th>Detail</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($creditLogs as $creditLog)
        <tr>
            <td>{!! $creditLog->time !!}</td>
            <td>{!! $creditLog->amount !!}</td>
            <td>{!! $creditLog->change !!}</td>
            <td>{!! $creditLog->detail !!}</td>
            <td>{!! $creditLog->user_id !!}</td>
            <td>
                {!! Form::open(['route' => ['creditLogs.destroy', $creditLog->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('creditLogs.show', [$creditLog->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('creditLogs.edit', [$creditLog->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>