@extends('layouts.app')

@section('page-title', trans('app.my_profile'))
@section('page-heading', trans('app.my_profile'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('app.my_profile')
    </li>
@stop

@section('content')

@include('partials.messages')

<div class="row">
    <div class="col-md-12">
       
               <div class="row">
                <div class="col-md-3">
                        
                   <div class="card">
            <div class="card-body">
              <div class="card-title">Candidate Profile</div>
              <hr>
                <ul class="nav nav-tabs flex-column" id="nav-tab" role="tablist">
                   <li class="nav-item">
                        <a class="nav-link active" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="doc" aria-selected="true">
                            My Documents
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" id="experience-tab" data-toggle="tab" href="#experience" role="tab" aria-controls="experience" aria-selected="true">
                            Work Experience
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" id="education-tab" data-toggle="tab" href="#education"  role="tab" aria-controls="education" aria-selected="true">
                            Education Background
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" id="certification-tab" data-toggle="tab" href="#certification"  role="tab" aria-controls="certification" aria-selected="true">
                            Professional Certification
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" id="language-tab" data-toggle="tab" href="#language" role="tab" aria-controls="language" aria-selected="true">
                            Language Skills
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" id="pastjobs-tab" data-toggle="tab" href="#pastjobs" role="tab" aria-controls="pastjobs" aria-selected="true">
                            Past Jobs Applied
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                        id="details-tab"
                        data-toggle="tab"
                        href="#details"
                        role="tab"
                        aria-controls="home"
                        aria-selected="true">
                            @lang('app.user_details')
                        </a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" id="avatar-tab" data-toggle="tab" href="#avatar" role="tab" aria-controls="avatar" aria-selected="true">
                                Profile Pic
                            </a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           id="authentication-tab"
                           data-toggle="tab"
                           href="#login-details"
                           role="tab"
                           aria-controls="home"
                           aria-selected="true">
                            @lang('app.login_details')
                        </a>
                    </li>
                    @if (settings('2fa.enabled'))
                        <li class="nav-item">
                            <a class="nav-link"
                               id="authentication-tab"
                               data-toggle="tab"
                               href="#2fa"
                               role="tab"
                               aria-controls="home"
                               aria-selected="true">
                                @lang('app.two_factor_authentication')
                            </a>
                        </li>
                    @endif
                </ul>
                </div>
                 </div>
                 
        
   
               </div>
              
                 <div class="col-md-9">
                   <div class="card">
            <div class="card-body">
                    <div class="tab-content mt-4" id="nav-tabContent">
                      <div class="tab-pane fade show active px-2" id="documents" role="tabpanel" aria-labelledby="nav-doc-tab">
                        <h4>My Documents</h4>
                        <hr>
                        {!! Form::open(['route' => 'docs.upload', 'method' => 'POST', 'id' => 'docdetails-form', 'enctype'=>'multipart/form-data']) !!}
                            @include('user.partials.documents', ['profile' => true])
                        {!! Form::close() !!}
                    </div>
                    <div class="tab-pane fade  px-2" id="avatar" role="tabpanel" aria-labelledby="nav-avatar-tab">
                            <h4>Profile Pic</h4>
                            <hr>
                            {!! Form::open(['route' => 'profile.update.avatar', 'files' => true, 'id' => 'avatar-form']) !!}
                                        @include('user.partials.avatar', ['updateUrl' => route('profile.update.avatar-external')])
                                    {!! Form::close() !!}
                        </div>
                    <div class="tab-pane fade px-2" id="experience" role="tabpanel" aria-labelledby="nav-works-tab">
                       <h4>Work Experience</h4>
                        <hr>
                        {!! Form::open(['route' => 'past.works', 'method' => 'POST', 'id' => 'workdetails-form']) !!}
                            @include('user.partials.works', ['profile' => true])
                        {!! Form::close() !!}
                    </div>

                     <div class="tab-pane fade px-2" id="education" role="tabpanel" aria-labelledby="nav-education-tab">
                       <h4>Education Background</h4>
                        <hr>
                        {!! Form::open(['route' => 'past.academic', 'method' => 'POST', 'id' => 'edudetails-form']) !!}
                            @include('user.partials.education', ['profile' => true])
                        {!! Form::close() !!}
                    </div>

                    <div class="tab-pane fade px-2" id="certification" role="tabpanel" aria-labelledby="nav-certification-tab">
                        <h4>Professional Certification</h4>
                         <hr>
                         {!! Form::open(['route' => 'professional.certification', 'method' => 'POST', 'id' => 'certdetails-form']) !!}
                             @include('user.partials.certifications', ['profile' => true])
                         {!! Form::close() !!}
                     </div>
                     <div class="tab-pane fade px-2" id="language" role="tabpanel" aria-labelledby="nav-language-tab">
                            <h4>Language Skills</h4>
                             <hr>
                             {!! Form::open(['route' => 'myprofile.languages', 'method' => 'POST', 'id' => 'langdetails-form']) !!}
                                 @include('user.partials.languages', ['profile' => true])
                             {!! Form::close() !!}
                         </div>
                    <div class="tab-pane fade px-2" id="pastjobs" role="tabpanel" aria-labelledby="nav-pastjobs-tab">
                                <h4>Past Jobs Applied</h4>
                                 <hr>
                                 @include('user.partials.pastjobs', ['profile' => true])
                    </div>

                    <div class="tab-pane fade px-2" id="details" role="tabpanel" aria-labelledby="nav-home-tab">
                            {!! Form::open(['route' => 'profile.update.details', 'method' => 'PUT', 'id' => 'details-form']) !!}
                                @include('user.partials.details', ['profile' => true])
                            {!! Form::close() !!}
                        </div>

                    <div class="tab-pane fade px-2" id="login-details" role="tabpanel" aria-labelledby="nav-profile-tab">
                       <h4>Login Details</h4>
                        <hr>
                        {!! Form::open(['route' => 'profile.update.login-details', 'method' => 'PUT', 'id' => 'login-details-form']) !!}
                            @include('user.partials.auth')
                        {!! Form::close() !!}
                    </div>

                    @if (settings('2fa.enabled'))
                        <div class="tab-pane fade px-2" id="2fa" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <?php $route = Authy::isEnabled($user) ? 'disable' : 'enable'; ?>

                            {!! Form::open(['route' => "profile.two-factor.{$route}", 'id' => 'two-factor-form']) !!}
                                @include('user.partials.two-factor')
                            {!! Form::close() !!}
                        </div>
                    @endif
                </div>
                 </div>
               </div>

            </div>
        </div>
    </div>

   
</div>

@stop

@section('scripts')
    {!! HTML::script('assets/js/as/btn.js') !!}
    {!! HTML::script('assets/js/as/profile.js') !!}
    {!! JsValidator::formRequest('Boaz\Http\Requests\User\UpdateDetailsRequest', '#details-form') !!}
    {!! JsValidator::formRequest('Boaz\Http\Requests\User\UpdateProfileLoginDetailsRequest', '#login-details-form') !!}

    @if (settings('2fa.enabled'))
        {!! JsValidator::formRequest('Boaz\Http\Requests\User\EnableTwoFactorRequest', '#two-factor-form') !!}
    @endif
@stop