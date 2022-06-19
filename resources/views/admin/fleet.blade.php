@extends('layouts.header')
@section('content')
        <!-- Admin home page -->
        <!-- sidebar -->

    @include("layouts/includes/sidebar")
    @include("admin/modal/fleet")

    <!-- main content -->
    <div class="main-content">
        <div class="page-header">
            <button
                type="button"
                class="btn btn-primary btn-icon pull-right ml-5"
                data-toggle="modal"
                data-target="#create"
                {{$permission_status}}
            >
                <i class=" mdi mdi-plus-circle-outline"></i>
                Add Vehicle
            </button>
            <h3>Fleet</h3>
            <p>Vehicles for your branch</p>
        </div>
        <!-- page content -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive" style="height: 80vh">
                            @if (\Session::has('success'))
                                <div class="alert alert-success">
                                    {!! \Session::get('success') !!}
                                </div>
                            @endif
                            @if (\Session::has('error'))
                                <div class="alert alert-danger">
                                    {!! \Session::get('error') !!}
                                </div>
                            @endif
                            <table class="table table-striped mb-0 mw-1000">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Car Type</th>
                                        <th>Car No.</th>
                                        <th>Plate</th>
                                        <th>M. Year</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($fleet))

                                        @foreach($fleet as $key => $car)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td><strong>{{$car->make}} {{$car->model}}</strong></td>
                                            <td>#{{$car->car_no}}</td>
                                            <td>{{$car->car_plate}}</td>
                                            <td>{{$car->model_year}}</td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm btn-icon" href="{{route('fleet.show', $car->id)}}" >
                                                    <i class="mdi mdi-calendar-text"></i>
                                                    Schedule
                                                </a>
                                                <div class="dropdown inline-block">
                                                    <button
                                                        class="btn btn-default btn-sm btn-icofn dropdown-toggle"
                                                        data-toggle="dropdown"
                                                        id="menu1"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                    >
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </button>
                                                    <ul
                                                        class="dropdown-menu"
                                                        role="menu"
                                                        aria-labelledby="menu1"
                                                    >
                                                        <li role="presentation">
                                                            <a
                                                                href="{{ route('fleet.form.show', $car->id)}}"
                                                             >
                                                                <i class="mdi mdi-calendar-plus"></i>
                                                                add schedule
                                                            </a>
                                                        </li>


                                                        <li role="presentation">
                                                            <a
                                                                data-toggle="modal"
                                                                data-target="#update{{ $car->id }}"
                                                                href="#"
                                                             >
                                                                <i class="mdi mdi-pencil"></i>
                                                                Edit
                                                            </a>
                                                        </li>


                                                        <li role="presentation">
                                                            <form id="deleteFleet{{$car->id}}" action="{{ route('fleet.destroy', $car->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a
                                                                    href="#"
                                                                    class="fleet_delete"
                                                                    rel="deleteFleet{{$car->id}}"
                                                                >
                                                                    <i class="mdi mdi-delete"></i>
                                                                    Delete
                                                                </a>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>


                                        @include("admin/modified/fleet")

                                    @endforeach
                                    @else
                                        <tr><th colspan="7" class="text-center">It's empty here.</th></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('../layouts/includes/footer')
    <script>

        $('.fleet_delete').on('click touchstart', function(e){
            e.preventDefault();
            if(confirm("Are you sure to delete this? This Fleet and all it's data will be deleted")){

                $fleet_data = $(this).attr('rel');
                $('#'+$fleet_data).submit();

            }
        });


    //Edit Vehicle
    $('.editcar').on('click',function(){
        var data = JSON.parse($(this).attr('data-scope'));
        $('#create .modal-title').text('Edit Branch');
        $('.submitbtn').text('Save changes');
        $('.simcy-form').attr('action',`{{url('Fleet@edit')}}${data.id}`);
        $('.carno').val(data.carno);
        $('.carplate').val(data.carplate);
        $('.carmake').val(data.carmake);
        $('.carmodel').val(data.carmodel);
        $('.modelyear').val(data.modelyear);
        for(var i =0;i<=data.names.length;i++){
            console.log(data.names[i]);
        }
        $('.instructors').val(data.instructors);
        $('.carimg').attr('data-default-file',`{{asset("uploads/fleet/")}}${data.carimg}`);
    });
    //Add Vehicle
    $('.addcar').on('click',function(){
        $('#create .modal-title').text('Add Fleet');
        $('.submitbtn').text('Add Branch');
        $('.simcy-form').attr('action',"{{url('Branch@store')}}");
        $('.carno').val('');
        $('.carplate').val('');
        $('.carmake').val('');
        $('.carmodel').val('');
        $('.modelyear').val('');
        $('.instructors').val('');
        $('.carimg').attr('data-default-file',' ');

    });
    //Select instructor
    $('.instructor').on('change', function(){
      var instructors = $('.instructors');
      var insdata = $('.insdata');
      var value = $(this).val();
      if(instructors.val().length < 1){
          instructors.val(value);
          insdata.html('<span class="badge badge-pill badge-primary col-md-5 mt-2 ml-1">'+$('.instructor option:selected').text()+'</span>');
      } else {
          if(instructors.val().indexOf(value) < 0){
            insdata.append('<span class="badge badge-pill badge-primary col-md-5 mt-2 ml-1">'+$('.instructor option:selected').text()+'</span>');
            instructors.val(instructors.val()+','+value);
          } else {
              notify('Oops!','This item already exists.','warning','Ok');
          }
      }
    });
    //On submit
    $('.simcy-form').on('submit',function(){
      $('.instructors').attr('disabled',false);
    });
   </script>
@endsection
