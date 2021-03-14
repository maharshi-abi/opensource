@extends('layouts.app')
@section('title') {{'Product List'}} @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if (session('status'))
            <div class="alert alert-{{session('status')}}" role="alert">
                {{ session('message') }}
            </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Product List') }} <a href="{{route('product.create')}}" class="btn btn-success float-right">Create Product</a></div>

                <table class="table">
                    @if($products->count() > 0)
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Created Date</th>
                      <th>View</th>
                      <th>Remove</th>
                  </tr>
                  @endif
                  @forelse($products as $key => $product)
                  <tr>
                      <td>{{$key+1}}</td>
                      <td><img src="{{$product->imageData->image}}" alt="{{$product->title}}" height="40" onerror="this.onerror=null;this.src='{{asset("images/favicon.png")}}';"/></td>
                      <td>{{$product->title}}</td>                    
                      <td>{!! htmlentities(substr(strip_tags(trim(preg_replace('/<[^>]*>/', ' ',@$product->description))),  0, 30),ENT_QUOTES | ENT_IGNORE, "UTF-8") !!} ..</td>
                      <td>{{$product->price}}</td>
                      <td>{{$product->created_at->diffForHumans()}}</td>
                      <td class="text-center">
                          <a href="{{route('product.show',$product->id)}}">
                              <i class="fa fa-eye" title="view product" style="font-size:20px"></i>                
                          </a>
                      </td>
                      <td class="text-center">
                          <form action="{{ route('product.destroy', $product->id)}}" method="POST" onsubmit="return confirm('Do you really want to remove this product?');">                                
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>
                        </form>
                    </td>
                </tr>     
                @empty
                <br/>
                <h3 class="text-center">No Product Found !!</h3>
                @endforelse      
            </table>
            <div>
                {{ $products->links() }}
            </div>

        </div>
    </div>
</div>
</div>
@endsection
