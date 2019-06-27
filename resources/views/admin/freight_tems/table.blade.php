<table class="table table-responsive" id="freightTems-table">
    <thead>
        <tr>
        <th>运费模板名称</th>
        <th>计价方式</th>
        <th>是否使用系统默认</th>
        <th>包含地区</th>
        <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($freightTems as $freightTem)
        <tr>
            <td>{!! $freightTem->name !!}</td>
            <td>{!! $freightTem->Type !!}</td>
            <td>{!! $freightTem->SystemDefault !!}</td>
            <td>{!! $freightTem->CitiesHtml!!}</td>
            <td>
                {!! Form::open(['route' => ['freightTems.destroy', $freightTem->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
               {{--      <a href="{!! route('freightTems.show', [$freightTem->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> --}}
                    <a href="{!! route('freightTems.edit', [$freightTem->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>