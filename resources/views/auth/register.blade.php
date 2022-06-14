@extends('layouts.header')
@section('content')
<style>
    
    
</style>

<div class="container">
    
    
    
    <div class="row justify-content-center rg-form">
        
        
        <div class="col-md-10">
            
             
            
            <div class="reg_card" style="background-color: #f8fafc !important; color: black">
                <div class="reg_card-header">Register</div>
                @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        {!! \Session::get('error') !!} 
                    </div>
                @endif  
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Upload Profile</label>
                                    <input type="file" name="profile_image" class="croppie" placeholder="Course Cover Image" crop-width="400" crop-height="190" accept="image/*" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group row"> 
                            <div class="col-md-6">
                                <label for="fname" class="col-form-label text-md-right">{{ __('First Name') }}</label>
                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>
                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                         
                            <div class="col-md-6">
                                <label for="lname" class="col-form-label text-md-right">{{ __('Last Name') }}</label>
                                <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>
                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6"> 
                                <label for="address" class="col-form-label text-md-right">{{ __('Address') }}</label>
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="dob" class="col-form-label text-md-right">{{ __('Date of Birth') }}</label>
                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob"  required autocomplete="dob" autofocus>
                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6"> 
                                <label for="phone" class="col-form-label text-md-right">{{ __('Phone') }}</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="Tell or Phone number">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" id="role" name="role">
                                       <option value="Instructor">Instructor</option>
                                       <option value="Staff">Staff</option>
                                    </select>
                                </div>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label text-md-right">Gender</label>
                                <div>  
                                    <div class="form-check">
                                        <div class="d-flex justify-content-start">
                                            <div class="d-inline">
                                                <input id="male" type="radio" class=" @error('gender') is-invalid @enderror" name="gender" value="Male" required autocomplete="gender" autofocus>
                                                <label class="form-check-label" for="male">
                                                    {{ __('Male') }}
                                                </label>
                                            </div>
                                            <div class="d-inline ml-4">
                                                <input id="female" type="radio" class=" @error('gender') is-invalid @enderror" name="gender" value="Female" required autocomplete="gender" autofocus>
                                                <label class="form-check-label" for="female">
                                                    {{ __('Female') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="email" class="col-form-label text-md-right">{{ __('Username') }}</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                             <div class="col-md-6">
                                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                            </div>
                            <div class="col-md-6">
                                <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <a class="btn btn-link" href="{{url('login')}}">
                                    {{ __('Already have an account?') }}
                                </a>  
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 


@include('../layouts/includes/footer') 



<!--<script>-->
    
<!--    $('#rg-select-opt > div').on('click', function(){-->
<!--        alert("Hello world");-->
<!--    })-->
<!--</script>-->
 
@endsection
