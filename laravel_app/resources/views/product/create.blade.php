@extends('layouts.app')
@section('title') {{'Create Product'}} @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create Product') }} <a href="{{route('product.index')}}" class="btn btn-info float-right">Back to Product List</a></div>                

                <div class="card-body">
                    <form method="POST" action="{{ route('product.store') }}" id="product-form" enctype="multipart/form-data">
                        @csrf                    
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}*</label>
                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autofocus placeholder="Product Title">

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}*</label>
                            <div class="col-md-8">

                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autofocus rows="6" placeholder="Product Description">{{ old('description') }}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Image') }}*</label>
                            <div class="col-md-3">

                                <input id="image" class="form-control" name="image[]" type="file" min="0" required autofocus multiple accept="image/*"/>

                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <label for="price" class="col-md-2 col-form-label text-md-right">{{ __('Price') }}*</label>
                            <div class="col-md-3">

                                <input id="price" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" type="number" min="0" required autofocus placeholder="Price"/>

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>                        
                        </div>

                        <hr/>
                        <div class="form-group row">                            
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Variants') }}*</label>

                            <div id="auto_populate" class="col-md-8">
                                <a type="button" class="btn btn-primary form-group add_criteria ">+ Add more {{ __('Variants') }} </a>
                                <div class="listing row">
                                    <div class="col-md-5">
                                        <select class="form-control" name="attribute_name[]">
                                            <option value="brand">Brand</option>                                            
                                            <option value="color">Color</option>
                                            <option value="size">Size</option>                                            
                                        </select>                                        
                                    </div>

                                    <div class="col-md-5">
                                        <input id="attribute_value" type="text" class="form-control" name="attribute_value[]" placeholder="Attribute Value" required autofocus>
                                    </div>

                                    <div class="col-md-2">                            
                                        <a href="javascript:void(0);" class="btn btn-danger form-group remove_field" id="remove">X</a>
                                    </div>
                                </div>
                            </div>                        

                            @error('attribute_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <hr/>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-success" id="register_user">
                                    {{ __('Save Product') }}
                                </button>

                                <a href="{{route('product.index')}}" class="btn btn-danger">Back</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js_script')
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js'></script>

<script>
    $(document).ready(function() {
      $("#product-form").validate({
        rules: {
            title: {
                required: true,
                minlength:4
            },
            description: {
                required: true,
                minlength:10
            },
            price: {
                required: true,
                number:true
            },
            'image[]': {
               required: true,
           }
       },
       messages : {
        title: {
            required: "Title is required",      
            minlength: "Title must be at least 4 characters long"                          
        },
        description: {
         required: "Description is required",      
         minlength: "Description must be at least 10 characters long"
     },
     price: {
         required: "Pice is required",      
         number: "Please enter valid number"
     }
 }
});

      var wrapper         = $("#auto_populate"); 
      var add_button      = $(".add_criteria"); 

      $(add_button).click(function(e){ 
        e.preventDefault();                
        $(wrapper).append('<div class="listing row"> <div class="col-md-5"> <select class="form-control"  name="attribute_name[]"> <option value="brand">Brand</option> <option value="color">Color</option> <option value="size">Size</option> </select> </div> <div class="col-md-5"> <input id="attribute_value" type="text" class="form-control" name="attribute_value[]" placeholder="Attribute Value" required autofocus> </div> <div class="col-md-2"> <a href="javascript:void(0);" class="btn btn-danger form-group remove_field" id="remove">X</a> </div> </div>');             
    });

      $(wrapper).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).closest('.listing').remove(); x--;
    });

  });
</script>
@endpush
