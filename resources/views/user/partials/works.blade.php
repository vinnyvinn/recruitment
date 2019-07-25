


 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Past Work Experience
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                     
<div class="row">
   
     <div class="col-12" id="work-experience">
    @foreach($works as $item)
      
   
     <h5>Employer: {{ $item->employer}}</h5>
     
      <ul class="work-ex">
         <li><span class="heading">Designation</span><span class="body-text"> {{$item->designations->name}}  </span></li>
         <li><span class="heading">Start Date <i class="fas fa-calendar-alt"></i></span><span class="body-text">{{$item->startdate}}</span></li>
          <li><span class="heading">End Date <i class="fas fa-calendar-alt"></i></span><span class="body-text">{{$item->enddate}}</span></li>
           <li><span class="heading">Country of Employment <i class="fas fa-globe"></i></span><span class="body-text">{{$item->countries->name}}</span></li>
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
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                         Add Work Experience
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                   
<div id="employer-details">
    <div class="inner" id="inner">
        <div id="form-aread">
           
        <hr>
        <div class="row">
            <div class="col">
                    <div class="form-group">
                            <label style="display: block;">Start Date</label>
                            <input class="form-control "  type="date" name="startdate[]">
                        </div>
                       
                        
            </div>
            <div class="col">
                    <div class="form-group">
                            <label style="display: block;">End Date</label>
                            <input class="form-control"  type="date" name="enddate[]">
                        </div>
            </div>
        </div>
        
        <div class="form-group">
            <label style="display: block;">Employer</label>
            <input class="form-control" type="text" name="employer[]">
        </div>

        <div class="row">
            <div class="col-6">
                         <div class="form-group">
            <label for="address">@lang('app.country')</label>
            {!! Form::select('country_id', $countries, $edit ? $user->country_id : '', ['class' => 'form-control']) !!}
        </div>

       
            </div>
            <div class="col-6">
                 <div class="form-group">
            <label style="display:block">Designation</label>
            <select name="designation_id[]" id="industry" class="form-control select2" style="width:100%">
                @foreach ($industry as $item)
                   <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

            </div>
        </div>        </div>
    </div>
    <div id="inner2"></div>
</div>
<button class="button btn is-rounded btn-danger" id="remove_button" type="button"><i class="fas fa-minus-circle"></i> Remove</button>
<button class="button btn is-rounded" id="add" type="button"><i class="fas fa-plus-circle"></i> Add Work Experience</button>
<hr>
<button type="submit" class="btn btn-primary is-info is-outlined">Save Work Experience</button>


                </div>
            </div>
        </div>

        
    </div><!-- panel-group -->
   