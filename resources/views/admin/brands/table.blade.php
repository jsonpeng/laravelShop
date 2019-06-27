<table class="table table-responsive" id="brands-table">
    <thead>
        <th>品牌名称</th>
        <th>简介</th>
        <th>排序</th>
        <th>品牌LOGO</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($brands as $brand)
        <tr>
            <td>{!! $brand->name !!}</td>
            <td>{!! $brand->intro !!}</td>
            <td>{!! $brand->sort !!}</td>
            <td> <img src="{!! $brand->image !!}" style="max-width: 100%; max-height: 25px;"> </td>
            <td>
                {!! Form::open(['route' => ['brands.destroy', $brand->id], 'method' => 'delete']) !!}
                <div class='btn-group'>

                    <a href="{!! route('brands.edit', [$brand->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>

                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>