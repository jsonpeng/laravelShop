<table class="table table-responsive" id="projects-table">
    <thead>
        <tr>
        <th>项目名称</th>
        <th>手机号</th>
        <th>微信/QQ</th>
        <th>地址</th>
       
    {{--   <th>详情</th>   <th>Jindu</th>
        <th>Weidu</th> --}}
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($projects as $projects)
        <tr>
            <td>{!! $projects->name !!}</td>
            <td>{!! $projects->mobile !!}</td>
            <td>{!! $projects->weixin_qq !!}</td>
            <td>{!! $projects->address !!}</td>
       {{--        <td>{!! $projects->content !!}</td>  <td>{!! $projects->jindu !!}</td>
            <td>{!! $projects->weidu !!}</td> --}}
            <td>
                {!! Form::open(['route' => ['projects.destroy', $projects->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                      {{--   <a href="{!! route('projects.show', [$projects->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> --}}
                        <a href="{!! route('projects.edit', [$projects->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>