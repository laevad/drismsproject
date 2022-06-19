@extends('layouts.header')
@section('content')

    <style>
        body {
            overflow: hidden; /* Hide scrollbars */
        }
    </style>
    <div class="container">
        @php $n = 1 @endphp
        <div class="text-center">
            <h1>Student Registration</h1>
            <a class="btn btn-link" href="{{url('login')}}">
                {{ __('Already have an account?') }}
            </a>

        </div>

        <div class="row justify-content-center">
            <div class="col-md-10 m-auto">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="reg_card" style="background-color: #f8fafc !important; color: black">
                    <!--@foreach($schools as $school)-->
                    <!--    {{ $school->name }}-->
                    <!--@endforeach-->
                    <table class="">

                        <tbody>

                        <tr class="dc-cls" id="">
                            <td colspan="10">
                                <form method="POST" action="{{ route('registerStudent') }}"
                                      enctype="multipart/form-data">
                                    @csrf

                                    {{--                                    <input type="hidden" name="rg_stdnt" value="rg_stdnt"/>--}}
                                    {{--                                    <input type="hidden" name="instructor_id"--}}
                                    {{--                                           value="{{$sc->instructor_id}}"/>--}}
                                    {{--                                    <input type="hidden" name="school_id" value="{{$school->id}}"/>--}}
                                    {{--                                    <input type="hidden" name="course_id" value="{{$course->id}}"/>--}}
                                    {{--                                    <input type="hidden" name="school_course_id" value="{{$sc->id}}"/>--}}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <table class="table table-borderless form-drisms">
                                                    <tbody>
                                                    <tr>
                                                        <td class=""><input type="checkbox"
                                                                            name="driving_lto_requirement"
                                                                            value="Driving for LTO requirement"/>
                                                        </td>
                                                        <td><label>Driving for LTO requirement</label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox"
                                                                   name="theoretical_driving_course"
                                                                   value="15 Hours Theoretical Driving Course"/>
                                                        </td>
                                                        <td><label>15 Hours Theoretical Driving
                                                                Course</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox"
                                                                   name="practical_driving_course_mv"
                                                                   value="8 Hours Practical Driving Course (MV)"/>
                                                        </td>
                                                        <td><label>8 Hours Practical Driving Course
                                                                (MV)</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" name="manual_transmission_mv"
                                                                   value="Manual Transmission"/></td>
                                                        <td><label>Manual Transmission</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" name="automatic_transmission_mv"
                                                                   value="Automatic Transmission"/></td>
                                                        <td><label>Automatic Transmission</label></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-4">
                                                <table class="table table-borderless form-drisms">
                                                    <tbody>
                                                    <tr>
                                                        <td><input type="checkbox"
                                                                   name="practical_driving_course_mc"
                                                                   value="8 Hours Practical Driving Course (MC)"/>
                                                        </td>
                                                        <td><label>8 Hours Practical Driving Course
                                                                (MC)</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" name="manual_transmission_mc"
                                                                   value="Manual Transmission"/></td>
                                                        <td><label>Manual Transmission</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" name="automatic_transmission_mc"
                                                                   value="Automatic Transmission"/></td>
                                                        <td><label>Automatic Transmission</label></td>
                                                    </tr>

                                                    <tr>
                                                        <td><input type="checkbox" class="others_mc"/>
                                                        </td>
                                                        <td><label>OTHERS</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"
                                                            class="hidden other-transmission">
                                                            <label>
                                                                <input type="text" name="others_mc"/>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-4">

                                                <label>Where did you know {{$school->name}} ( School
                                                    )</label>

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <table
                                                            class="table table-borderless form-drisms">
                                                            <tbody>
                                                            <tr>
                                                                <td><input type="checkbox"
                                                                           name="where_did_you_know_school_[]"
                                                                           value="Facebook"/></td>
                                                                <td><label>Facebook</label></td>
                                                            </tr>

                                                            <tr>
                                                                <td><input type="checkbox"
                                                                           name="where_did_you_know_school_[]"
                                                                           value="Radio"/></td>
                                                                <td><label>Radio</label></td>
                                                            </tr>


                                                            <tr>
                                                                <td><input type="checkbox"
                                                                           name="where_did_you_know_school_[]"
                                                                           value="Google"/></td>
                                                                <td><label>Google</label></td>
                                                            </tr>

                                                            <tr>
                                                                <td><input type="checkbox"
                                                                           name="where_did_you_know_school_[]"
                                                                           value="Refferal"/></td>
                                                                <td><label>Refferal</label></td>
                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table
                                                            class="table table-borderless form-drisms">
                                                            <tbody>
                                                            <tr>
                                                                <td><input type="checkbox"
                                                                           name="where_did_you_know_school_[]"
                                                                           value="TV"/></td>
                                                                <td><label>TV</label></td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="checkbox"
                                                                           name="where_did_you_know_school_[]"
                                                                           value="Flyers"/></td>
                                                                <td><label>Flyers</label></td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="checkbox"
                                                                           name="where_did_you_know_school_[]"
                                                                           value="Billboard"/></td>
                                                                <td><label>Billboard</label></td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="checkbox"
                                                                           class="others_"/></td>
                                                                <td><label>Others</label></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="hidden other_inform">

                                                        <label> Refered by: </label>
                                                        <input type="text"
                                                               name="where_did_you_know_school_[]">

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-borderless form-drisms">
                                                    <tbody>
                                                    <tr>
                                                        {{--                                                        <td><label>Signature:</label></td>--}}
                                                        <td><label>Assisted by: </label></td>
                                                    </tr>
                                                    <tr>
                                                        {{--                                                        <td class="">--}}
                                                        {{--                                                            <hr>--}}
                                                        {{--                                                        </td>--}}
                                                        <td class="">
                                                            <hr>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <div class="alert alert-danger">NOTE: REGISTRATION FEE
                                                    OF P2000 IS NON-REFUNDABLE
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Upload Profile</label>
                                                <input type="file" name="profile_image" class="croppie"
                                                       placeholder="Course Cover Image" crop-width="400"
                                                       crop-height="190" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="fname"
                                                   class="col-form-label text-md-right">{{ __('First Name') }}</label>
                                            <input id="fname" type="text"
                                                   class="form-control @error('fname') is-invalid @enderror fname-{{ $n }}"
                                                   name="fname" value="{{ old('fname') }}"
                                                   autocomplete="fname" autofocus>
                                            @error('fname')
                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="lname"
                                                   class="col-form-label text-md-right">{{ __('Last Name') }}</label>
                                            <input id="lname" type="text"
                                                   class="form-control @error('lname') is-invalid @enderror"
                                                   name="lname" value="{{ old('lname') }}"
                                                   autocomplete="lname" autofocus>
                                            @error('lname')
                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="address"
                                                   class="col-form-label text-md-right">{{ __('Address') }}</label>
                                            <input id="address" type="text"
                                                   class="form-control @error('address') is-invalid @enderror"
                                                   name="address" value="{{ old('address') }}"
                                                   autocomplete="address" autofocus>
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="dob"
                                                   class="col-form-label text-md-right">{{ __('Date of Birth') }}</label>
                                            <input id="dob" type="date"
                                                   class="form-control @error('dob') is-invalid @enderror"
                                                   name="dob" autocomplete="dob" autofocus>
                                            @error('dob')
                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="phone"
                                                   class="col-form-label text-md-right">{{ __('Phone') }}</label>
                                            <input id="phone" type="text"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   name="phone" value="{{ old('phone') }}"
                                                   autocomplete="phone" autofocus
                                                   placeholder="Tell or Phone number">
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
                                                    <option selected value="Student">Student</option>
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
                                            <label for="email"
                                                   class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}"
                                                   autocomplete="email">
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
                                                            <input id="male" type="radio"
                                                                   class=" @error('gender') is-invalid @enderror"
                                                                   name="gender" value="Male"
                                                                   autocomplete="gender" autofocus>
                                                            <label class="form-check-label" for="male">
                                                                {{ __('Male') }}
                                                            </label>
                                                        </div>
                                                        <div class="d-inline ml-4">
                                                            <input id="female" type="radio"
                                                                   class=" @error('gender') is-invalid @enderror"
                                                                   name="gender" value="Female"
                                                                   autocomplete="gender" autofocus>
                                                            <label class="form-check-label"
                                                                   for="female">
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
                                            <label for="email"
                                                   class="col-form-label text-md-right">{{ __('Username') }}</label>
                                            <input id="username" type="text"
                                                   class="form-control @error('username') is-invalid @enderror"
                                                   name="username" value="{{ old('username') }}"
                                                   autocomplete="username">
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="password"
                                                   class="col-form-label text-md-right">{{ __('Password') }}</label>
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" autocomplete="new-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password-confirm"
                                                   class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                            <input id="password-confirm" type="password"
                                                   class="form-control" name="password_confirmation"
                                                   autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
                                            </button>

                                        </div>
                                    </div>
                                </form>


                            </td>
                        </tr>
                        </tbody>
                    </table>




                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            {!! \Session::get('error') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('../layouts/includes/footer')

    <script>

        $('.ec_forn_c').on('change', function () {
            $('.ec_forn_c').not(this).prop('checked', false);
            $data = $(this).attr('rel');

            $('.dc-cls').addClass('hidden');
            $('#' + $data).removeClass('hidden');


            var n = $(this).attr('relAtt');


            console.log(n);


            $('.fname-' + n).val('');


        });

        $('.others_mc').on('change', function () {

            if ($(this).is(":checked")) {
                $('.other-transmission').removeClass('hidden');
            } else {
                $('.other-transmission').addClass('hidden');
            }

        })

        $('.others_').on('change', function () {

            if ($(this).is(":checked")) {
                $('.other_inform').removeClass('hidden');
            } else {

                $('.other_inform').addClass('hidden');
            }

        })


    </script>
@endsection
