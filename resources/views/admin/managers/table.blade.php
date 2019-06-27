<table class="table table-responsive" id="managers-table">
    <thead>
        <th>用户名</th>
        <th>类型</th>
        <th>角色</th>
        <th>邮箱</th>
        <th>创建时间</th>
        <th>更新时间</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($managers as $manager)
    <tr>
        <td>{!! $manager->name !!}</td>
        <td>{!! $manager->type !!}</td>
        <td><?php $roles=$manager->roles()->get();?>@if(!empty($roles))@foreach($roles as $item)<a href="{!! route('roles.edit',[$item->id]) !!}">{!! $item->name !!}</a>@endforeach @else 无 @endif</td>
        <td>{!! $manager->email !!}</td>
        <td>{!! $manager->created_at !!}</td>
        <td>{!! $manager->updated_at !!}</td>
        <td>
            {!! Form::open(['route' => ['managers.destroy', $manager->id], 'method' => 'delete']) !!}
            <div class='btn-group'>
             
                <a href="{!! route('managers.edit', [$manager->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              
               
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除吗?')"]) !!}
            
            </div>
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>