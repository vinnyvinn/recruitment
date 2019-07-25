


 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
       
         
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#edu" aria-expanded="true" aria-controls="edu">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Past Education Background
                    </a>
                </h4>
            </div>
            <div id="edu" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">

                     
<div class="row">
               
   
     <div class="col-12" id="work-experience">

    @foreach($education as $key)
   
    <h5>Name of the School: {{ $key->institution}}</h5>
     
    <ul class="work-ex">
       <li><span class="heading">Area of Study</span><span class="body-text"> {{ $key->studies->name}}  </span></li>
        <li><span class="heading">Achieved <i class="fas fa-user-graduate "></i> </span><span class="body-text"> {{$key->achievement->name}}  </span></li>
       <li><span class="heading">Start Date <i class="fas fa-calendar-alt"></i></span><span class="body-text">{{$key->startdate}}</span></li>
        <li><span class="heading">End Date <i class="fas fa-calendar-alt"></i></span><span class="body-text">{{$key->enddate}}</span></li>
         <li><span class="heading">Country of Study <i class="fas fa-globe"></i></span><span class="body-text">{{$key->countries->name}}</span></li>
   </ul>

   
     
     @endforeach
      </div>
</div>
                </div>
            </div>
        </div>
       
        
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#eduTwo" aria-expanded="false" aria-controls="eduTwo">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                         Add Education Background
                    </a>
                </h4>
            </div>
            <div id="eduTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                   
<div id="education-details">
    <div class="inner" id="eduinner">
        <div id="form-aread">
           
        <hr>
        
        <div class="row">
            <div class="col">
                <div class="form-group">
            <label style="display: block;">Institutions/Name of the School</label>
            <input class="form-control" type="text" name="institution[]">
        </div>
        <div class="form-group">
            <label style="display:block">Achieved/Attained</label>
            <select name="certificate_id[]" id="certificate" class="form-control" style="width:100%">
                @foreach ($achieved as $key)
                   <option value="{{ $key->id }}">{{ $key->name }}</option>
                @endforeach
            </select>
        </div>

                    <div class="form-group">
                            <label style="display: block;">Start Date</label>
                            <input class="form-control "  type="date" name="startdate[]">
                        </div>
                                               
            </div>
            <div class="col">
                <div class="form-group">
            <label for="address">@lang('app.country')</label>
            {!! Form::select('country_id[]', $countries, $edit ? $user->country_id : '', ['class' => 'form-control']) !!}
        </div>
         <div class="form-group">
            <label style="display:block">Area of Study</label>
            <select name="areastudied_id[]" id="education" class="form-control" style="width:100%">
                @foreach ($study as $key)
                   <option value="{{ $key->id }}">{{ $key->name }}</option>
                @endforeach
            </select>
        </div>
                    <div class="form-group">
                            <label style="display: block;">End Date</label>
                            <input class="form-control"  type="date" name="enddate[]">
                        </div>

            </div>
        </div>
        
        

             </div>
    </div>
    <div id="eduinner2"></div>
</div>
<button class="button btn is-rounded btn-danger" id="eduremove_button" type="button"><i class="fas fa-minus-circle"></i> Remove</button>
<button class="button btn is-rounded" id="eduadd" type="button"><i class="fas fa-plus-circle"></i> Add Education Background</button>
<hr>
<button type="submit" class="btn btn-primary is-info is-outlined">Save Education Background</button>


                </div>
            </div>
        </div>

        
    </div><!-- panel-group -->
    