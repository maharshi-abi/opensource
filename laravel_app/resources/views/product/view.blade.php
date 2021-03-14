@extends('layouts.app')
@section('title') {{$product->title}} @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$product->title}} <a href="{{route('product.index')}}" class="btn btn-info float-right">Back to Product List</a></div>                

                <div class="card-body">                    
                    <div class="form-group row">
                        <label for="name" class="col-md-2 text-md-right">{{ __('Title') }}:</label>
                        <div class="col-md-8">
                            {{$product->title}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 text-md-right">{{ __('Description') }}:</label>
                        <div class="col-md-8">
                            {{$product->description}}
                        </div>
                    </div>

                    <div class="form-group row">

                        <label for="price" class="col-md-2 text-md-right">{{ __('Price') }}:</label>
                        <div class="col-md-8">
                            {{$product->price}}
                        </div>                        
                    </div>

                    <div class="form-group row">

                        <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Image') }}:</label>
                        @if(!empty($product->allImage))                        
                        @foreach($product->allImage as $image)                        
                        <div class="col-md-2">
                            <img src="{{$image->image}}" height="40" onerror="this.onerror=null;this.src='{{asset("images/favicon.png")}}';">
                        </div>
                        @endforeach                        
                        @endif

                    </div>


                    <hr/>
                    <div class="form-group row">                            
                        <label for="name" class="col-md-2 text-md-right">{{ __('Variants') }}</label>

                        <div id="auto_populate" class="col-md-8">
                            @if(!empty($product->allAttributes))
                            <div class="listing row">
                                <div class="col-md-3">
                                    <b>Variant Name</b>                                    
                                </div>

                                <div class="col-md-3">
                                    <b>Variant Value</b>
                                </div>

                            </div>
                            @foreach($product->allAttributes as $attribute)  
                            <hr/>
                            <div class="listing row">
                                <div class="col-md-3">
                                   {{$attribute->attribute}}
                               </div>

                               <div class="col-md-3">
                                   {{$attribute->value}}
                               </div>
                           </div>                           
                           @endforeach
                           @endif


                       </div>                        

                       @error('attribute_name')
                       <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
