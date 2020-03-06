@extends('products.layout')

@section('content')

    <div class="card">
        <div class="row">
            <div class="col-lg-12 margin-tb">                
                <div class="card-header">
                    <div class="row">                    
                        <div class="col-sm-9">
                            <h3>Show Product</h3>
                        </div>
                        <div class="col-sm-3">
                            <a class="btn btn-primary btn-lg float-right" href="{{ route('products.index') }}"> Back</a>
                        </div>                        
                    </div>    
                </div>                               
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $product->title }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Details:</strong>
                        {{ $product->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>    
        
@endsection
