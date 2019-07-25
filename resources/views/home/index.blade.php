@extends('layouts.home')
@section('content')

    @include('partials.messages')
 <section class="wrapper-bottom-sec">

        <div class="container">
            <div class="row">
                
                <div class="col-md-12">
                   
                    <h2 class="p-t-30 m-b-30 page-title">All Jobs</h2>
                    
                    @foreach($jobs as $j)
                    <!-- Job Card Start -->
                    <a href="{{url('view-job/details/'.$j->id)}}">
                    <div class="panel cp-clickable cp-linkable panel-hoverd panel-30">

                       
                        
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="boxer is-link">
                                        <a href="{{url('view-job/details/'.$j->id)}}">
                                            <h2 class="panel-title panel-title-15" style="color: #fff">{{$j->designations->name}}
                                            </h2>
                               
                                        </a>
                                         <p>
                                            <span class="info-list-title" style="margin-right: 10px; font-size: 13px">Number of Vacancies</span>
                                            <span class="info-list-des tag is-primary"> {{$j->no_position}}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row"  style="margin: 10px 0">

                                        <!-- Job Meta Information -->
                                        <div class="col-lg-4 col-md-12">
                                            <ul class="info-list title-space-md">
                                               
                                                <li><span class="info-list-title">Experience</span><span class="info-list-des">{{$j->experience}}</span></li>
                                                <li><span class="info-list-title">Job Type</span><span class="info-list-des">{{$j->job_type}}</span></li>
                                                <li><span class="info-list-title">Deadline</span><span class="info-list-des">{{$j->ldate}}</span></li>
                                                <li><span class="info-list-title">Job Status</span> @if($j->status == 'closed')
                                        <span class="tag is-danger is-outlined">Closed</span>
                                        @else
                                        <span class="tag is-primary is-outlined">Open</span>
                                        @endif
                                        </li>
                                        <li><span class="info-list-title">Ref No:</span><span class="info-list-des">{{ $j->jreference }}</span></li>
                                            </ul>
                                        </div>

                                

                                        <!-- Job Short Descrition -->
                                        <div class="col-lg-8 col-md-12">
                                            <div class="last-child-m-b-n">
                                               <strong>Short Description</strong>
                                                <p style="margin-top: 10px">{{$j->short_description}}</p>
                                               <p style="margin-top: 10px;float: right;margin-bottom: 5px;"> <a href="{{url('view-job/details/'.$j->id)}}" class="button is-link is-outlined is-rounded is-small">View Vacancy</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                   
                    <!-- Job Card End -->
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@stop