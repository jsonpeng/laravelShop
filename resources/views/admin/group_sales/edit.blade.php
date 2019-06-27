@extends('admin.layouts.app_promp')

@section('content')
    <section class="content-header">
        <h1>
            编辑团购
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary form">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($groupSale, ['route' => ['groupSales.update', $groupSale->id], 'method' => 'patch']) !!}

                        @include('admin.group_sales.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

@section('scripts')
    @include('admin.group_sales.partial.js')
@endsection