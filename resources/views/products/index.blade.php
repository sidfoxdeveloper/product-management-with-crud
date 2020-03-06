@extends('products.layout')

@section('content')

    <div class="card">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="card-header">
                    <div class="row">                    
                        <div class="col-sm-9">
                            <h3>Products Available</h3>
                        </div>
                        <div class="col-sm-3">
                            <a class="btn btn-primary btn-lg float-right" href="{{ route('products.create') }}"> Add New </a>
                        </div>                  
                    </div>    
                </div>
            </div>
        </div>
        <div class="card-body">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($errors as $product)
                
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" id="productForm" >
                                <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a>   
                                <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="areYouSure();" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach            
            </table>

            {!! $errors->links() !!} 
            
            <script>
                function areYouSure() {                 
                    if(confirm("Are you sure want to delete this product ?")) {                        
                            $("#productForm").submit();                            
                    }
                    return false;
                }
            </script>

        </div>
    </div>

@endsection