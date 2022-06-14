<!--<strong>{{ $name }}</strong>,-->
@if(isset($from_email) && ($from_email !==null))
    <h4>From:  <a href="{{ $from_email }}"><i>{{ $from_email }}</i></a> </h4>
@endif
<p>{{$body}}</p>
