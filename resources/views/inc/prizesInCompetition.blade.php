<div class="mb-3">
  <h3 class="d-inline">Prizes
    <a class="float-right btn btn-outline-primary" href="{{route('prizes.create', $competition->id)}}"><i class="fa fa-trophy" aria-hidden="true"></i> Prize</a>
  </h3> 
</div>
<table class="table table-striped">
  <thead>
    <th style="width: 25%;" scope="col">Name</th>
    <th style="width: 10%;" scope="col">Quantity</th>
    <th style="width: 10%;" scope="col">Available</th>
    @if($competition->type == Translation::TYPE_INSTANT_WIN || $competition->type == Translation::TYPE_BIRTHDAY_WILL)
    <th style="width: 40%;" scope="col">Description</th>
    @else
    <th style="width: 30%;" scope="col">Description</th>
    <th style="width: 10%;" scope="col">Priority</th>
    @endif
    <th style="width: 15%;" scope="col" class="text-center">Option</th>
  </thead>
  <tbody>
    @foreach($prizeList as $prize)
    <tr>
      <td>{{$prize->name}}</td>
      <td>{{$prize->amount}}</td>
      <td class="checkAvailablePrizes">{{$prize->getAvailablePrize()}}</td>
      <td>{{$prize->description}}</td>
      @if($competition->type == Translation::TYPE_LUCKY_DRAW)
      <td class="text-center"><input disabled type="checkbox" class="form-check-input" {{$prize->priority?'checked':''}}></td>
      @endif
      <td>
        <div class="form-row ">
          <div class="col">
            <a class="btn btn-outline-secondary float-right" style="border-radius: 50%;" href="{{route('prizes.edit', ['competition_id'=>$competition->id,'id'=>$prize->id])}}"><i class="fa fa-edit align-middle"></i></a> 
          </div>
          <div class="col">
            {!! Form::open(['action'=>['PrizesController@destroy', 'competition_id'=>$competition->id, 'id'=>$prize->id], 'method'=>'POST', 'id'=>'prizeDeleteForm-'.$prize->id]) !!}
            <a href="#" class="btn btn-outline-danger float-right" style="border-radius: 50%;" data-toggle="modal" data-id="prize" data-prize-id="{{$prize->id}}" data-target="#deleteConfirmation"><i class="fa fa-trash"></i></a>
            {{ Form::hidden('_method', 'DELETE')}}
            {!! Form::close() !!}
          </div>
        </div>
      </td>
    </tr>
    @endforeach    
  </tbody>
</table>
