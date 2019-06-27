<table class="table table-responsive" id="moneyLogs-table">
    <thead>
        <tr>
            <th>Amount</th>
        <th>Change</th>
        <th>Detail</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($moneyLogs as $moneyLog)
        <tr>
            <td>{!! $moneyLog->amount !!}</td>
            <td>{!! $moneyLog->change !!}</td>
            <td>{!! $moneyLog->detail !!}</td>
            <td>{!! $moneyLog->user_id !!}</td>
            <td>
                {!! Form::open(['route' => ['moneyLogs.destroy', $moneyLog->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('moneyLogs.show', [$moneyLog->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('moneyLogs.edit', [$moneyLog->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>