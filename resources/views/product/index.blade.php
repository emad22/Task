@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('product.create') }}"> Create New product</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-condensed">
        <tr>
            <th>No</th>
            <th>product Name</th>
            <th>Descirption</th>
            <th>product Photo</th>
            <th >Action</th>
        </tr>
        @foreach ($products as $key => $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->productName }}</td>
            <td>{{ $product->descirption }}</td>
            <td> <img src="{{ asset('images/' . $product->photo) }}" alt="{{ $product->productName }}" height="100" width="100"> </td>
            <td>
                <a class="btn btn-info" href="{{ route('product.show',$product->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('product.edit',$product->id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['product.destroy', $product->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </table>
    {!! $products->links() !!}
@endsection