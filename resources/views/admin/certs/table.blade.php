<table class="table table-responsive" id="certs-table">
    <thead>
        <tr>
        <th>姓名</th>
        <th>身份证号</th>
        <th>人脸图</th>
        <th>背部国徽图</th>
        <th>手持图</th>
        <th>上传人</th>
        <th>审核状态</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($certs as $certs)
        <tr>
            <td>{!! $certs->name !!}</td>
            <td>{!! $certs->id_card !!}</td>
            <td><img src="{!! $certs->face_image !!}" style="max-width: 100%; max-height: 100px;"></td>
            <td><img src="{!! $certs->back_image !!}" style="max-width: 100%; max-height: 100px;"></td>
            <td><img src="{!! $certs->hand_image !!}" style="max-width: 100%; max-height: 100px;"></td>
            <td>{!! optional($certs->user()->first())->nickname !!}</td>
            <td>{!! $certs->status !!}</td>
            <td>
                {!! Form::open(['route' => ['certs.destroy', $certs->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                   {{--  <a href="{!! route('certs.show', [$certs->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> --}}
                    <a href="{!! route('certs.edit', [$certs->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>