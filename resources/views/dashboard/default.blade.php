@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('app.dashboard')
    </li>
@stop

@section('content')

<div class="fun-facts-container">
        <div class="fun-fact" data-fun-fact-color="#36bd78">
            <div class="fun-fact-text">
                <span>Task Bids Won</span>
                <h4>22</h4>
            </div>
            <div class="fun-fact-icon" style="background-color: rgba(54, 189, 120, 0.07);"><i class="icon-material-outline-gavel" style="color: rgb(54, 189, 120);"></i></div>
        </div>
        <div class="fun-fact" data-fun-fact-color="#b81b7f">
            <div class="fun-fact-text">
                <span>Jobs Applied</span>
                <h4> {{ $pastjobs }}</h4>
            </div>
            <div class="fun-fact-icon" style="background-color: rgba(184, 27, 127, 0.07);"><i class="fas fa-briefcase" style="color: rgb(184, 27, 127);"></i></div>
        </div>
        <div class="fun-fact" data-fun-fact-color="#efa80f">
            <div class="fun-fact-text">
                <span>Reviews</span>
                <h4>28</h4>
            </div>
            <div class="fun-fact-icon" style="background-color: rgba(239, 168, 15, 0.07);"><i class="icon-material-outline-rate-review" style="color: rgb(239, 168, 15);"></i></div>
        </div>

        <!-- Last one has to be hidden below 1600px, sorry :( -->
        <div class="fun-fact" data-fun-fact-color="#2a41e6">
            <div class="fun-fact-text">
                <span>This Month Views</span>
                <h4>987</h4>
            </div>
            <div class="fun-fact-icon" style="background-color: rgba(42, 65, 230, 0.07);"><i class="icon-feather-trending-up" style="color: rgb(42, 65, 230);"></i></div>
        </div>
    </div>


<div class="row" style="margin-top:20px;">
    <div class="col-md-9">
            <div class="dashboard-box">
                    <div class="headline">
                        <h3><i class="icon-material-outline-assignment"></i> Latest Jobs Applied</h3>
                    </div>
                    <div class="content">
                        <ul class="dashboard-box-list">
                            
                            @foreach ($pastjob as $item)
                            <li>
                                <div class="invoice-list-item">
                                <strong>{{ $item->jobs->designations->name }}</strong>
                                    <ul>
                                            @if ($item->status ==3)
                                            <li>Application Status: <span class="unpaid">Not Viewed</span></li>
                                        @elseif($item->status ==9)
                                        <li><span class="unpaid">Successfully</span></li>
                                        @else 
                                        <li><span class="paid">Viewed</span></li>
                                        @endif 
                                        
                                        @if($item->jobs->status =='Open')
                                        <li>Vacancy Status: <span class="paid">Open</span></li>
                                        @elseif($item->jobs->status =='Closed')
                                        <li>Vacancy Status: <span class="unpaid">Closed</span></li>
                                        @endif
                                       
                                        <li>Date Applied <i class="fas fa-calendar-alt"></i> : {{ $item->created_at->toFormattedDateString() }}</li>
                                    </ul>
                                </div>
                               
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
    </div>
    <div class="col-md-3">
      </div>
</div>

@stop

@section('scripts')
    <script>
        var labels = {!! json_encode(array_keys($activities)) !!};
        var activities = {!! json_encode(array_values($activities)) !!};
        var trans = {
            chartLabel: "{{ trans('app.registration_history')  }}",
            action: "{{ trans('app.action_sm')  }}",
            actions: "{{ trans('app.actions_sm')  }}"
        };
    </script>
    {!! HTML::script('assets/js/chart.min.js') !!}
    {!! HTML::script('assets/js/as/dashboard-default.js') !!}
@stop