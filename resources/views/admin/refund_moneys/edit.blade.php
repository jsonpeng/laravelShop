@extends('admin.layouts.app_shop')

@section('content')
    <section class="content-header">
        <h1>
            Refund Money
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($refundMoney, ['route' => ['refundMoneys.update', $refundMoney->id], 'method' => 'patch']) !!}

                        @include('admin.refund_moneys.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection