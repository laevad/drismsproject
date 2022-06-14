<div class="row"> 
    <div class="col-md-12">
        <table class="border borderless table">
            <thead>
                
                <th>#</th>
                <th>Name</th> 
                <th>Day</th> 
                <th>Start Time</th> 
                <th>Start Date</th> 
                <th>End Date</th> 
                <th>Duration</th> 
                <th>Period</th> 
                <th>Action</th>   
            </thead>
            <tbody>
                @forelse($instructor_fleet_schedule as $key=>$val)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $val->fname}} {{ $val->lname}} </td>
                    <td>{{ $val->day}}  </td>
                    <td>{{ $val->time_start_end}}  </td>
                    <td>{{ $val->start}}  </td>
                    <td>{{ $val->end}}  </td>
                    <td>{{ $val->duration}}  </td>
                    <td>{{ $val->period}}  </td> 

                    @if($val->evaluation == 'pass' || $val->evaluation == 'failed') 
                        <td colspan="2" class="text-center alert @if($val->evaluation == 'pass') alert-success @else alert-danger @endif"> {{ $val->evaluation}}  </td>      
                    @else
                            <td> 
                            <form action="{{ route('practical.instructor.update.student',  $val->id) }}" method="POST" >
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="evaluation" value="pass">
                                    <input type="submit" class="btn btn-success @if($val->status == 'completed') disabled @endif" value="Pass" />
                            </form>
                            </td>
                            <td>  
                                <form action="{{ route('practical.instructor.update.student',  $val->id) }}" method="POST" >
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="evaluation" value="failed">
                                    <input type="submit" class="btn btn-danger @if($val->status == 'completed') disabled @endif" value="Failed" />
                                </form>
                                
                                </td> 
                        @endif 
                    
                    
                </tr>


                @empty
                    @include("admin/empty/empty") 
                @endforelse
            </tbody>
        </table>

        
        <button class="btn btn-primary mb-2" id="print-fleet-schedule" >Print</button>
    <div>
</dov>