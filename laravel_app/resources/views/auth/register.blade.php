@extends('layouts.app')
@section('title') {{'User Registration'}} @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="registration-form">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}*</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}*</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}*</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Required min 8 characters">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}*</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Same as new password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="education" class="col-md-4 col-form-label text-md-right">{{ __('Education') }}*</label>

                            <div class="col-md-6">
                                <select name="education" id="education" class="form-control @error('education') is-invalid @enderror" required>
                                    <option value="" selected disabled>Select Education</option>
                                    <option value="primary" {{ old('education') == 'primary' ? "selected" : "" }}>Primary and Higher Secondary education</option>
                                    <option value="under_graduate" {{ old('education') == 'under_graduate' ? "selected" : "" }}>Under-Graduate/ Bachelor’s level education</option>
                                    <option value="post_graduate" {{ old('education') == 'post_graduate' ? "selected" : "" }}>Post-Graduate/Master’s level education</option>
                                    <option value="certificate_diploma" {{ old('education') == 'certificate_diploma' ? "selected" : "" }}>Certificate and Diploma programs</option>
                                    <option value="distance_education" {{ old('education') == 'distance_education' ? "selected" : "" }}>Distance Education</option>
                                </select>
                                @error('education')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}*</label>

                            <div class="col-md-6">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" id="gender" value="male" {{ old('gender') == 'male' ? "checked" : "" }} checked="" required>Male
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" id="gender" value="female" {{ old('gender') == 'female' ? "checked" : "" }} required>Female
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" id="gender"  id="gender" value="other" {{ old('gender') == 'other' ? "checked" : "" }} required>Other
                                </label>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hobbies" class="col-md-4 col-form-label text-md-right">{{ __('Hobbies') }}*</label>

                            <div class="col-md-6">
                                <label class="checkbox">
                                    <input type="checkbox" name="hobbies[]" value="cricket" @if(is_array(old('hobbies')) && in_array('cricket', old('hobbies'))) checked @endif> Cricket
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="hobbies[]" value="programming" @if(is_array(old('hobbies')) && in_array('programming', old('hobbies'))) checked @endif> Programming
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="hobbies[]" value="data_analyst" @if(is_array(old('hobbies')) && in_array('data_analyst', old('hobbies'))) checked @endif> Data Analyst
                                </label>

                                @error('hobbies')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="register_user">
                                    {{ __('Register') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('login') }}">
                                    You already have an account? Login
                                </a>
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
      $("#registration-form").validate({
        rules: {
            name: {
                required: true,
                minlength:4
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength:8
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            },
            'hobbies[]': {
              required: true
          }
      },
      messages : {
        name: {
            required: "Name is required",      
            minlength: "Name must be at least 4 characters long"                          
        },
        email: {
            email: "The email should be in the format: abc@domain.tld"
        },
        password: {
            required: "Password is required",      
            minlength: "Your password must be at least 8 characters long"                          
        },
        password_confirmation: {
            required: "Confirm password is required",      
            minlength: "Your password must be at least 8 characters long",                         
            equalTo: "Your confirm password must same as password"                          
        },
    }
});
  });
</script>
@endpush
