


 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
       
         
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#lang" aria-expanded="true" aria-controls="lang">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Languages Speaking
                    </a>
                </h4>
            </div>
            <div id="lang" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">

                     
<div class="row">
               
   
     <div class="col-12" id="work-experience">
   
    @foreach($langskills as $row)
   
     <h5>Language: {{ $row->languages->name}}</h5>
     
      <ul class="work-ex">
         <li><span class="heading">Proficiency Level :</span><span class="body-text"> {{$row->level}}  </span></li>
          
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
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#langTwo" aria-expanded="false" aria-controls="langTwo">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Add Languages
                    </a>
                </h4>
            </div>
            <div id="langTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                   
<div id="education-details">
    <div class="inner" id="langinner">
        <div id="form-aread">
           
        <hr>
        
        <div class="row">
            <div class="col">
                <div class="form-group">
            <label style="display: block;">Language</label>
           
            <select class="form-control" name="language_id[]" id="language_id" style="width:100%">
                @foreach ($langu as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        

                               
            </div>
            <div class="col">
                    <div class="form-group">
                            <label style="display: block;">Fluency</label>
                            <select name="level[]" class="form-control" id="level">
                                <option value="Beginner">Beginner</option>
                                <option value="Fluent">Fluent</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Native Speaker">Native Speaker</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                                   
              

            </div>

        </div>
        
        

             </div>
    </div>
    <div id="langinner2"></div>
</div>
<button class="button btn is-rounded btn-danger" id="langremove_button" type="button"><i class="fas fa-minus-circle"></i> Remove</button>
<button class="button btn is-rounded" id="langadd" type="button"><i class="fas fa-plus-circle"></i> Add Language</button>
<hr>
<button type="submit" class="btn btn-primary is-info is-outlined">Save Language</button>


                </div>
            </div>
        </div>

        
    </div><!-- panel-group -->
    