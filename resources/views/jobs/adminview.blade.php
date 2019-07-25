@extends('layouts.app')

@section('page-title', 'Applicants')
@section('page-heading', 'Applicants')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
            Applicants
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="row">
        <div class="freelancers-container freelancers-list-layout compact-list">
            @foreach ($applicants as $item)
                
          
           
                <div class="freelancer">

                        <!-- Overview -->
                        <div class="freelancer-overview">
                            <div class="freelancer-overview-inner">
                                
                                <!-- Bookmark Icon -->
                                <span class="bookmark-icon"></span>
                                
                                <!-- Avatar -->
                                <div class="freelancer-avatar">
                                    <div class="verified-badge"></div>
                                    <a href="single-freelancer-profile.html"><img src="{{ $item->users->avatar }}" alt=""></a>
                                </div>
    
                                <!-- Name -->
                                <div class="freelancer-name">
                                    <h4><a href="#">{{ $item->users->first_name  }}<img class="flag" src="" alt="" data-tippy-placement="top" data-tippy="" data-original-title="United Kingdom"></a></h4>
                                    <span>{{ $item->users->email }}</span>
                                    <!-- Rating -->
                                    <div class="freelancer-rating">
                                        <div class="star-rating" data-rating="4.9"><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Details -->
                        <div class="freelancer-details">
                            <div class="freelancer-details-list">
                                <ul>
                                    <li>Position Applied <strong><i class="fas fa-marker"></i> {{ $item->jobs->designations->name }}</strong></li>
                                    <li>Job Location <strong>{{ $item->jobs->job_location }}</strong></li>
                                    <li>Job Success <strong>95%</strong></li>
                                </ul>
                            </div>
                            <a href="single-freelancer-profile.html" class="button button-sliding-icon ripple-effect" style="width: 190px;">View Profile <i class="icon-material-outline-arrow-right-alt"></i></a>
                        </div>
                    </div>
                    @endforeach
        </div>
    </div>
    @stop