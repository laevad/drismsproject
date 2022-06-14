
@extends('layouts.header') 
@section('content')     
        <!-- Admin home page --> 
        <!-- sidebar --> 

    @include("layouts/includes/sidebar")   

    <!-- main content -->
    <div class="main-content">
        <div class="page-header">
            <h3>Settings</h3> 

              
            @if( \Session::has('success'))
                <div class="alert alert-success mt-3">
                    {!! \Session::get('success') !!}
                </div>
            @endif
            @if( \Session::has('error'))
                <div class="alert alert-danger mt-3"> 
                    {!! \Session::get('error') !!} 
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div> 
        <!-- page content -->
        <div class="row">
            <div class="col-md-12">
                <div class="card settings-card"> 
                        <ul class="nav nav-tabs">
                            <li><a data-toggle="tab" href="#step-1" class="active mr-3">Update Profile Info</a></li>
                            <li><a data-toggle="tab" href="#step-2" class="mr-3">Update Account</a></li> 
                            <li><a data-toggle="tab" href="#step-3" class="mr-3">Configure Your SMS Gateway</a></li>  
                            <li><a data-toggle="tab" href="#step-4" class="mr-3">Generate QRcode</a></li>  
                        </ul> 


                    <div class="row">

                        <div class="col-md-12">
                            <div class="tab-content">  
 
                                <!-- Step-1  -->
                                <div id="step-1" class="tab-pane fade in show active">
                                  
                                <p class="mt-3">Update your personal profile here.</p>
                                    <form method="POST" action="{{ route('settings.update', Auth::user()->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
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
                                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ Auth::user()->fname }}"  autocomplete="fname" autofocus>
                                                @error('fname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <label for="lname" class="col-form-label text-md-right">{{ __('Last Name') }}</label>
                                                <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ Auth::user()->lname }}"  autocomplete="lname" autofocus>
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
                                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ Auth::user()->address }}"  autocomplete="address" autofocus>
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dob" class="col-form-label text-md-right">{{ __('Date of Birth') }}</label>
                                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ Auth::user()->dob }}"  autocomplete="dob" autofocus>
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
                                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ Auth::user()->phone }}"  autocomplete="phone" autofocus placeholder="Tell or Phone number">
                                                @error('phone')
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
                                                                <input id="male" @if(Auth::user()->gender =='Male') checked @endif  type="radio" class=" @error('gender') is-invalid @enderror" name="gender" value="Male"  autocomplete="gender" autofocus>
                                                                <label class="form-check-label" for="male">
                                                                    {{ __('Male') }}
                                                                </label>
                                                            </div>
                                                            <div class="d-inline ml-4">
                                                                <input id="female" @if(Auth::user()->gender =='Female') checked @endif  type="radio" class=" @error('gender') is-invalid @enderror" name="gender" value="Female"  autocomplete="gender" autofocus>
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
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary" name="step" value="step 1">
                                                    {{ __('Update Account') }}
                                                </button> 
                                            </div> 
                                        </div> 
                                    </form> 
                                </div>  


                                <!-- Step-2  -->

                                <div id="step-2" class="tab-pane fade">
                                    
                                    <p class="mt-3">Update your personal profile here.</p>
                                    <form method="POST" action="{{ route('settings.update', Auth::user()->id) }}" >
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">  
                                            <div class="col-md-6">
                                                <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}"  autocomplete="email">
                                            
                                            </div>
 
                                            <div class="col-md-6">
                                                <label for="username" class="col-form-label text-md-right">{{ __('Username') }}</label>
                                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ Auth::user()->username }}"  autocomplete="username">
                                             
                                            </div> 
                                        </div>
 
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                               
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary" name="step" value="step 2">
                                                    {{ __('Update Account') }}
                                                </button> 
                                            </div> 
                                        </div>
                                
                                    </form> 
                                </div>



                                
                                <!-- Step-3  -->
                                <div id="step-3" class="tab-pane fade">

                                    <p>
                                        We are using <a href="https://www.traccar.org/documentation/"> traccar sms gateway </a> you can check the decumentation for traccar sms gateway here.
                                         
                                    </p>    
                                    
                                    <p>
                                        Use this configuration to send sms to all users.     
                                    </p>
                                    @if(!$existSmsGateWay)
                                    <ul>    
                                        <li>1. Install traccar sms gateway to your mobile phone </li>
                                        <li>2. Go to settings > gateway > start  </li>
                                        <li>3. Register your API key here and Local API</li>
                                        <li>4. Please avoid spacing if not required</li>
                                        <li>5. Make sure your sim card can send a text message </li>
                                    </ul>

                                    <form method="POST" action="{{ route('smsGateWay.store') }}" >
                                        @csrf 
                                        <div class="form-group row">  
                                            <div class="col-md-6">
                                                <label for="api_key" class="col-form-label text-md-right">{{ __('Api Key') }}</label>
                                                <input id="api_key" type="text" class="form-control @error('api_key') is-invalid @enderror" name="api_key"  autocomplete="api_key" require>
                                            
                                            </div>
 
                                            <div class="col-md-6">
                                                <label for="mobile_ip" class="col-form-label text-md-right">{{ __('Mobile IP') }}</label>
                                                <input id="mobile_ip" type="text" class="form-control @error('mobile_ip') is-invalid @enderror" name="mobile_ip" autocomplete="mobile_ip" require>
                                             
                                            </div> 
                                        </div>  
                                        <div class="form-group row">
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary" >
                                                    {{ __('SMS GATEWAY') }}
                                                </button> 
                                            </div> 
                                        </div> 
                                    </form> 
                                    @else
                                        
                                        <p>
                                            Use this configuration to send sms to all users.     
                                        </p>
                                        <ul>    
                                            <li>1. Install traccar sms gateway to your mobile phone </li>
                                            <li>2. Go to settings > gateway > start  </li>
                                            <li>3. Update your API key here and Local API</li>
                                            <li>4. Please avoid spacing if not required</li>
                                            <li>5. Make sure your sim card can send a text message </li>
                                        </ul>
                                        <div> 
                                            <form method="POST" action="{{ route('smsGateWay.update', Auth::user()->id) }}" >
                                                @csrf 
                                                @method('PUT')
                                                <div class="form-group row">  
                                                    <div class="col-md-6">
                                                        <label for="api_key" class="col-form-label text-md-right">{{ __('Api Key') }}</label>
                                                        <input id="api_key" type="text" class="form-control @error('api_key') is-invalid @enderror" name="api_key"  autocomplete="api_key" require>
                                                    </div> 
                                                    <div class="col-md-6">
                                                        <label for="mobile_ip" class="col-form-label text-md-right">{{ __('Mobile IP') }}</label>
                                                        <input id="mobile_ip" type="text" class="form-control @error('mobile_ip') is-invalid @enderror" name="mobile_ip" autocomplete="mobile_ip" require>
                                                    
                                                    </div> 
                                                </div>  
                                                <div class="form-group row">
                                                </div>
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-primary" >
                                                            {{ __('SMS GATEWAY') }}
                                                        </button> 
                                                    </div> 
                                                </div> 
                                            </form> 
                                        </div>
                                    @endif 
                                </div>














                                <!-- Step-4  -->

                                <div id="step-4" class="tab-pane fade">
                                    
                                    <p class="mt-3">Get Your QRcode here fb</p>

                                    <!-- {!! $qrcodes !!} -->

                                    {!! QrCode::size(250)->generate('facebook.com'); !!}


                                    <form method="POST" action="" >
                                        @csrf
                                        @method('PUT') 

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary" name="step-4">
                                                    {{ __('Update for QRCode') }}
                                                </button> 
                                            </div> 
                                        </div>
                                
                                    </form> 
                                </div>


















                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
 
    @include('../layouts/includes/footer') 
 
@endsection
