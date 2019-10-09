<div class="mb-3">
  <h3 class="d-inline">Participants
    @if($prizeList->count() != 0) 
      @if(!($competition->type==Translation::TYPE_LUCKY_DRAW && $competition->drawn))
      <a class="float-right btn btn-outline-primary" href="{{route('searchListeners', $competition->id)}}"><i class="fa fa-user-plus" aria-hidden="true"></i>  Add {{$competition->type==Translation::TYPE_INSTANT_WIN? 'Winner':'Participant'}}</a>
      @endif
    @else
      @if($competition->type == Translation::TYPE_CASH_PRIZE)
        <a class="float-right btn btn-outline-primary" href="{{route('searchListeners', $competition->id)}}"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Winner</a>
      @endif
    @endif
  </h3> 
</div>

<table class="table table-striped dataTable">
  <thead>
    <th style="width: 25%;" scope="col">Participant Name</th>
    <th style="width: 20%;" scope="col">Enrolled by</th>
    <th style="width: 20%;" scope="col">Prize Won</th>
    <th style="width: 20%;" scope="col">Status</th>
    <th style="width: 15%;" scope="col" class="text-center">Option</th>
  </thead>
  <tbody>
    <!-- Instant Win -->
    @if($competition->type == Translation::TYPE_INSTANT_WIN || 
        $competition->type == Translation::TYPE_BIRTHDAY_WILL || 
        $competition->type == Translation::TYPE_CASH_PRIZE)
    @foreach ($participants as $participant)
      @foreach ($participant->prizes as $prize)
        @if ($prize->competition_id == $competition->id)
        <tr>
          <td><a class="text-info" href="{{route('listeners.show', $participant->id)}}">{{$participant->firstName}}</a></td>
          <td>{{$participant->getUsername()}}</td>
          <td>{{$competition->type == Translation:: TYPE_CASH_PRIZE? "$":""}} {{$prize->name}}</td>
          <td>{{$prize->pivot->getStatus()}}</td>
          <td>
            <div class="form-row">
              <div class="col">
                <a href="{{route('editParticipant', [$competition->id, $participant->id])}}" style="border-radius: 50%;" class='btn btn-outline-secondary float-right'><i class="fa fa-edit"></i></a>
              </div>
              <div class="col">
                {!! Form::open(['action'=>['CompetitionsController@removeParticipant', $competition->id, $participant->id], 'method'=>'POST', 'id'=>'participantDeleteForm-'.$participant->id]) !!}
                <a href="#" class="btn btn-outline-danger float-right" style="border-radius: 50%;" data-toggle="modal" data-id="participant" data-participant-id="{{$participant->id}}" data-target="#deleteConfirmation"><i class="fa fa-trash"></i></a>
                {{ Form::hidden('prize_id', $prize->id)}}
                {{ Form::hidden('_method', 'DELETE')}}
                {!! Form::close() !!}
              </div>
            </div>
          </td>
        </tr>
        @endif
      @endforeach
    @endforeach

    <!-- Lucky Draw -->
    @elseif ($competition->type == Translation::TYPE_LUCKY_DRAW && !$competition->drawn) 
    @foreach ($participants as $participant)
    <tr>
      <td><a class="text-info" href="{{route('listeners.show', $participant->id)}}">{{$participant->firstName}}</a></td>
      <td>{{$participant->getUsername()}}</td>
      <td>Waiting</td>
      <td>Waiting</td>
      <td class="text-center">
        {!! Form::open(['action'=>['CompetitionsController@removeParticipant', $competition->id, $participant->id], 'method'=>'POST', 'id'=>'participantDeleteForm-'.$participant->id]) !!}
        <a href="#" class="btn btn-outline-danger" style="border-radius: 50%;" data-toggle="modal" data-id="participant" data-participant-id="{{$participant->id}}" data-target="#deleteConfirmation"><i class="fa fa-trash"></i></a>
        {{ Form::hidden('_method', 'DELETE')}}
        {!! Form::close() !!}
      </td>
    </tr>
    @endforeach
    @elseif ($competition->type == Translation::TYPE_LUCKY_DRAW && $competition->drawn) 
      @foreach ($participants as $participant)
        @foreach ($participant->prizes as $prize)
          @if ($prize->competition_id == $competition->id)
          <tr>
            <td><a class="text-info" href="{{route('listeners.show', $participant->id)}}">{{$participant->firstName}}</a></td>
            <td>{{$participant->getUsername()}}</td>
            <td>{{$prize->name}}</td>
            <td>{{$prize->pivot->getStatus()}}</td>
            <td class="text-center">
              {!! Form::open(['action'=>['CompetitionsController@removeParticipant', $competition->id, $participant->id], 'method'=>'POST', 'id'=>'participantDeleteForm-'.$participant->id]) !!}
              <a href="#" class="btn btn-outline-danger" style="border-radius: 50%;" data-toggle="modal" data-id="participant" data-participant-id="{{$participant->id}}" data-target="#deleteConfirmation"><i class="fa fa-trash"></i></a>
              {{ Form::hidden('_method', 'DELETE')}}
              {!! Form::close() !!}
            </td>
          </tr>
          @endif
        @endforeach
      @endforeach
    @endif
  </tbody>
</table>