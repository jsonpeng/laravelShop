@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Order Action
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($orderAction, ['route' => ['orderActions.update', $orderAction->id], 'method' => 'patch']) !!}

                        @include('order_actions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection