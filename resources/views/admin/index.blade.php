@extends('layouts.admin')
@section('content')
   <div class="row">
      <h1>administrador</h1>
   </div>
   <hr>
   <div class="row">
      <div class="col-lg-3 col-6">
         <!-- small box -->
         <div class="small-box bg-success">
           <div class="inner">
             <h3>{{$total_usuarios}}</h3>
   
             <p>User Registrations</p>
           </div>
           <div class="icon">
             <i class="fas fa-user-plus"></i>
           </div>
           <a href="{{url('/admin/usuarios')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
         </div>
      </div>
      <div class="col-lg-3 col-6">
         <!-- small box -->
         <div class="small-box bg-warning">
           <div class="inner">
             <h3>{{$total_carpetas}}</h3>
   
             <p>carpetas Registrations</p>
           </div>
           <div class="icon">
             <i class="ion ion-person-add"></i>
           </div>
           <a href="admin/usuarios" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
         </div>
      </div>
   </div>

@endsection