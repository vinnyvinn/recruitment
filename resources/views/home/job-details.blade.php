@extends('layouts.home')

@section('content')
@include('partials.messages')
  <section class="wrapper-bottom-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2 class="p-t-30 m-b-30 page-title">{{$job->designations->name}}</h2>

                   
                    <!-- Job Card Start -->
                    <div class="row">

                            <div class="col-md-8">
                    <div class="card panel-30">
                        <div class="card-body p-t-30">
                            

                                    <div class="article-content">
                                        <strong>Description</strong>
                                       <article>
                                           {!!$job->description!!}
                                       </article>
                                        

                                         <p style="margin: 20px 0;">
                                             <h4 class="info-list-title" style="font-weight: 600">Skills Required</h4>
                                             <div class="skills" style="margin: 10px 0;">
                                            @foreach ($job->skills as $item)
                                            <span class="tag is-primary"> 
                                                      {{ $item->name }}
                                                </span>
                                            @endforeach     
                                            </div> 
                                        </p>

                               <div class="row">
                                   <div class="col-md-12">
                                        @if($job->status == 'closed')
                                <span class="label label-success">Sorry this Vacancy is Closed</span>
                                @else

                                @if(Auth::check() && Auth::user()->isAppliedOnJob($job->id))

                                <a href="javascript:;" class="btn apply"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{__('Already Applied')}}</a>
                        
                              @else
                             
                              <form action="{{ route('apply.job', $job->id) }}" method="POST" >
                                    {{ csrf_field() }}
                              <button class="button is-link is-outlined" type="submit">Apply Now</button>
                                
                                {!! Form::close() !!}
                                @endif
                                @endif
                                   </div>
                               </div>

                                       

                                    </div>
                                </div>
                            </div>
                        </div>
                                <div class="col-md-4"> <div class="content-tight-panel">

                                        <div class="card p-t-30 m-b-20" style="padding-bottom: 20px;">
                                            <div class="card-body">
                                                <div class="card-title">
                                                    Job Summary
                                                </div>
                                                <ul class="info-list title-space-md">
                                                    <li>
                                                        <span class="info-list-title">Published on</span>
                                                        <span class="info-list-des">{{$job->post_date}}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-list-title">Number Of Post</span>
                                                        <span class="info-list-des">{{$job->no_position}}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-list-title">Job Type</span>
                                                        <span class="info-list-des">{{$job->job_type}}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-list-title">Experience</span>
                                                        <span class="info-list-des">{{$job->experience}}</span>
                                                    </li>

                                                    
                                                    <li>
                                                        <span class="info-list-title">Age</span>
                                                        <span class="info-list-des">{{$job->age}}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-list-title">Job Location</span>
                                                        <span class="info-list-des">{{$job->job_location}}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-list-title">Salary Range</span>
                                                        <span class="info-list-des">{{$job->salary_range}}</span>
                                                    </li>
                                                    <li>
                                                        <span class="info-list-title">Deadline</span>
                                                        <span class="info-list-des"><i class="fas fa-calendar-alt"></i> {{ $job->ldate}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>


                                        
                                         
                                        <div class="card p-t-30 m-b-20" style="padding-bottom: 20px">
                                            <div class="card-body">
                                                @auth
                                                <h4 class="m-b-20">Hello, {{ auth()->user()->present()->nameOrEmail }}</h4>
                                                  @else
                                                  <h4 class="m-b-20">Login to Apply this Job</h4>
                                                <form role="form" action="<?= url('login') ?>" method="POST" id="login-form" autocomplete="off" class="mt-3">

                    <input type="hidden" value="<?= csrf_token() ?>" name="_token">

                    @if (Input::has('to'))
                        <input type="hidden" value="{{ Input::get('to') }}" name="to">
                    @endif

                    <div class="form-group">
                        <label for="username" class="sr-only">@lang('app.email_or_username')</label>
                        <input type="text"
                                name="username"
                                id="username"
                                class="form-control"
                                placeholder="@lang('app.email_or_username')">
                    </div>

                    <div class="form-group password-field">
                        <label for="password" class="sr-only">@lang('app.password')</label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control"
                               placeholder="@lang('app.password')">
                    </div>


                    @if (settings('remember_me'))
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" value="1"/>
                            <label class="custom-control-label font-weight-normal" for="remember">
                                @lang('app.remember_me')
                            </label>
                        </div>
                    @endif


                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn-login">
                            @lang('app.log_in')
                        </button>
                    </div>
                </form>

                @if (settings('forgot_password'))
                    <a href="<?= url('password/remind') ?>" class="forgot">@lang('app.i_forgot_my_password')</a>
                @endif

                        <div class="row">
                            <div class="col-sm-12">
                                <p class="has-text-centered">or</p>
                                <p><a href="{{ url('register') }}" class="button is-link is-fullwidth is-outlined">Create Account</a></p>
                            </div>
                        </div>
                        
                                               
                                             </div>
                                        </div>
                                        @endif   

                                    </div>
</div>
                            
                    </div>
                    <!-- Job Card End -->



                </div>
            </div>
        </div>
    </section>

@endsection
