@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Admin Shop
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($adminShop, ['route' => ['adminShops.update', $adminShop->id], 'method' => 'patch']) !!}

                        @include('admin_shops.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection