@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New PRoduct</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('product.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::open(array('route' => 'product.store','method'=>'POST','files'=>TRUE)) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>product Name:</strong>
                {!! Form::text('productName', null, array('placeholder' => 'Product Name','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Email:</strong>
                {!! Form::text('description', null, array('placeholder' => 'Description Of Product','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>PHoto:</strong>
                {!! Form::file('photo', null, array('placeholder' => 'PHoto','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection