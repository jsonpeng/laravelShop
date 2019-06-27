<table class="table table-responsive" id="countries-table">
    <thead>
        <tr>
            <th>名称</th>
            <th>图片</th>
            <th>排序(权重)</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($countries as $country)
        <tr>
            <td>{!! $country->name !!}</td>
            <td><img src="{!! $country->image !!}" style="height: 25px; width: auto;"></td>
            <td>{!! $country->sort !!}</td>
            <td>
                {!! Form::open(['route' => ['countries.destroy', $country->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('countries.show', [$country->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('countries.edit', [$country->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>