<table class="table table-responsive" id="cats-table">
    <thead>
        <tr>
        <th>分类名称</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($cats as $cats)
        <tr>
            <td>{!! $cats->name !!}</td>
         {{--    <td>{!! $cats->sort !!}</td> --}}
            <td>
                {!! Form::open(['route' => ['cats.destroy', $cats->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
             {{--        <a href="{!! route('cats.show', [$cats->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> --}}
                    <a href="{!! route('cats.edit', [$cats->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>