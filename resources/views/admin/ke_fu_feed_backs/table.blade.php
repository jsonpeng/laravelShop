<table class="table table-responsive" id="keFuFeedBacks-table">
    <thead>
        <tr>
        <th>反馈类型</th>
        <th>反馈内容</th>
        <th>联系电话</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($keFuFeedBacks as $keFuFeedBack)
        <tr>
            <td>{!! $keFuFeedBack->type !!}</td>
            <td>{!! $keFuFeedBack->content !!}</td>
            <td>{!! $keFuFeedBack->tel !!}</td>
            <td>
                {!! Form::open(['route' => ['keFuFeedBacks.destroy', $keFuFeedBack->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
            {{--         <a href="{!! route('keFuFeedBacks.show', [$keFuFeedBack->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> --}}
                    <a href="{!! route('keFuFeedBacks.edit', [$keFuFeedBack->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>