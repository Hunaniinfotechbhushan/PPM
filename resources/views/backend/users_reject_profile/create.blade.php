@extends('layouts.backend.header')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      General Form Elements
      <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i>Home</a></li>
      <?php $segments = ''; ?>
       @foreach(Request::segments() as $key=>$segment)
      <?php $segments .= '/'.$segment; ?>
      @if($key > 0)
      <li>
        <a href="{{ $segments }}">{{ ucfirst($segment) }}</a>
      </li>
      @endif
      @endforeach
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Quick Example</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          {!! Form::open(['action' => 'App\Http\Controllers\backend\UserController@store','id' => 'form_validation','files'=>true]) !!}
          @include('backend.users.form', ['submitButtonText' => 'Submit'])
          {!! Form::close() !!}
        </div>

      </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@stop

