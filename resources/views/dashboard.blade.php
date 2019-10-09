@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
  <!-- Events -->
  <section class="row">
    <div class="col-md-4 mb-3">
      <a href="{{route('competitions.index')}}">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title text-muted mb-0 text-center">View Competitions</h5>
          </div>
          <div class="card-body text-center">
            <i class="fa fa-newspaper-o fa-4x text-primary"></i>
            <p class="mt-3 mb-0 text-info text-sm text-right">
              <span class="text-nowrap text-muted">Total: </span>
              <span class="text-success text-info">{{$totalCompetitions}}</span>
            </p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 mb-3">
      <a href="{{route('competitions.create')}}">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title text-muted mb-0 text-center">New Competition</h5>
          </div>
          <div class="card-body text-center">
            <i class="fa fa-plus fa-4x text-primary"></i>
            <p class="mt-3 mb-0 text-info text-sm text-right">
              <span class="text-nowrap"></span>
              <span class="text-success"></span>
            </p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4 mb-3">
      <a href="{{route('listeners.index')}}">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title text-muted mb-0 text-center">View Listeners</h5>
          </div>
          <div class="card-body text-center">
            <i class="fa fa-users fa-4x text-primary"></i>
            <p class="mt-3 mb-0 text-info text-sm text-right">
              <span class="text-nowrap text-muted">Total: </span>
              <span class="text-info">{{$totalListeners}}</span>
            </p>
          </div>
        </div>
      </a>
    </div>
  </section>
  
  <div class="row mt-5">
    <div class="col-lg-6 col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <h4 class="text-center">Three Latest Competition Updates</h4>
        </div>
        <!-- <div class="tab-content"> -->
          <!-- <div class="tab-pane active"> -->
            <div class="card-body">
              @foreach($recentActivities as $activity)
              <div class="p-3 pb-4 mb-3 bg-light border border-secondary ">
                <a href="{{route('competitions.show', $activity->competition_id)}}" class="text-info">{!!$activity->getUpdate()!!}</a>
                <span class="text-muted float-right">{{$activity->getFormattedDate()}}</span>
              </div>
              @endforeach
            </div>
            <!-- </div> -->
            <!-- </div> -->
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="text-center">Three Latest Listener Updates</h4>
            </div>
            <div class="card-body">
              @foreach($listenerRecentActivities as $activity)
              <div class="p-3 pb-4 mb-3 bg-light border border-secondary">
                <a href="{{route('listeners.show', $activity->listener_id)}}" class="text-info">{!!$activity->getUpdate()!!}</a>
                <span class="text-muted float-right">{{$activity->getFormattedDate()}}</span>
              </div>
              @endforeach
            </div>
          </div>
        </div>

<!-- <section id="competitionRecentActivities" class="mt-4">
  <div class="container-fluid">
    <div class="card bg-gradient-default shadow">
      <div class="card-header">
        <h5 class="card-title text-muted mb-0"> Three Latest Competition Updates</h5>
      </div>
      <div class="card-body">
        @foreach($recentActivities as $activity)
        <div class="p-3 pb-4 mb-3 bg-light border border-secondary ">
          <a href="{{route('competitions.show', $activity->competition_id)}}" class="text-info">{!!$activity->getUpdate()!!}</a>
          <span class="text-muted float-right">{{$activity->getFormattedDate()}}</span>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<section id="listenerRecentActivities" class="mt-4">
  <div class="container-fluid">
    <div class="card bg-gradient-default shadow">
      <div class="card-header">
        <h5 class="card-title text-muted mb-0">Three Latest Listener Updates</h5>
      </div>
      <div class="card-body">
        @foreach($listenerRecentActivities as $activity)
        <div class="p-3 pb-4 mb-3 bg-light border border-secondary">
          <a href="{{route('listeners.show', $activity->listener_id)}}" class="text-info">{!!$activity->getUpdate()!!}</a>
          <span class="text-muted float-right">{{$activity->getFormattedDate()}}</span>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section> -->
</div>

@endsection
