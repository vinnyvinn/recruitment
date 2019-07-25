


 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
       
         
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#cert" aria-expanded="true" aria-controls="cert">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Certifications Archieved
                    </a>
                </h4>
            </div>
            <div id="cert" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">

                     
<div class="row">
               
   
     <div class="col-12" id="work-experience">
   
    @foreach($pcertification as $row)
   
     <h5>Name of the Certification: {{ $row->certification}}</h5>
     
      <ul class="work-ex">
         <li><span class="heading">Date Acquired <i class="fas fa-calendar-alt"></i></span><span class="body-text"> {{$row->dateacquired}}  </span></li>
          <li><span class="heading">Expiration Date <i class="fas fa-calendar-alt"></i></span><span class="body-text"> @if ($row->expirationdate)
            {{ $row->expirationdate}}
          @else
            Not Set  
          @endif  </span></li>
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
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#certTwo" aria-expanded="false" aria-controls="certTwo">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Certification
                    </a>
                </h4>
            </div>
            <div id="certTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                   
<div id="education-details">
    <div class="inner" id="certinner">
        <div id="form-aread">
           
        <hr>
        
        <div class="row">
            <div class="col">
                <div class="form-group">
            <label style="display: block;">Certification</label>
            <input class="form-control" type="text" name="certification[]">
        </div>
        

                               
            </div>
            <div class="col">
                    <div class="form-group">
                            <label style="display: block;">Date Acquired</label>
                            <input class="form-control "  type="date" name="dateacquired[]">
                        </div>
                                   
              

            </div>
            <div class="col">
                    <div class="form-group">
                            <label style="display: block;">End Date  (if applicable)</label>
                            <input class="form-control"  type="date" name="expirationdate[]">
                        </div>
            </div>
        </div>
        
        

             </div>
    </div>
    <div id="certinner2"></div>
</div>
<button class="button btn is-rounded btn-danger" id="certremove_button" type="button"><i class="fas fa-minus-circle"></i> Remove</button>
<button class="button btn is-rounded" id="certadd" type="button"><i class="fas fa-plus-circle"></i> Add Education Background</button>
<hr>
<button type="submit" class="btn btn-primary is-info is-outlined">Save Education Background</button>


                </div>
            </div>
        </div>

        
    </div><!-- panel-group -->
    