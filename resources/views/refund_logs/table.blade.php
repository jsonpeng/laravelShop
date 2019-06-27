<table class="table table-responsive" id="refundLogs-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Des</th>
        <th>Time</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($refundLogs as $refundLog)
        <tr>
            <td>{!! $refundLog->name !!}</td>
            <td>{!! $refundLog->des !!}</td>
            <td>{!! $refundLog->time !!}</td>
            <td>
                {!! Form::open(['route' => ['refundLogs.destroy', $refundLog->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('refundLogs.show', [$refundLog->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('refundLogs.edit', [$refundLog->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>