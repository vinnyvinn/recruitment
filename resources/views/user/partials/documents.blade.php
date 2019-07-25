



<div class="row">
  <div class="col-4">
      <div class="attachment-box ripple-effect">
      
          <span>Resume</span>
          <a href="{{ $user->resume }}">
          <div><i class="fas fa-file-pdf fa-stack-1x"></i>  Download </div>
        </a>  
          <button class="btn remove-attachment" data-tippy-placement="top" data-tippy="" data-original-title="Remove">
            <i class="fas fa-trash"></i>
          </button>
         
       
      </div>
      
  
  </div>
  <div class="col-4">
      <div class="attachment-box ripple-effect">
      
          <span>Cover Letter</span>
          <a href="{{ $user->coverletter }}">
          <div><i class="fas fa-file-word fa-stack-1x"></i>  Download </div>
        </a>  
          <button class="btn remove-attachment" data-tippy-placement="top" data-tippy="" data-original-title="Remove">
            <i class="fas fa-trash"></i>
          </button>
         
       
      </div>

   
  </div>
  <div class="col-4">
    
      <div class="attachment-box ripple-effect">
      
          <span>Certificates</span>
          <a href="{{$user->certs}}">
          <div><i class="fas fa-file-archive fa-stack-1x"></i>  Download </div>
        </a>  
          <button class="btn remove-attachment" data-tippy-placement="top" data-tippy="" data-original-title="Remove">
              <i class="fas fa-trash"></i>
          </button>
         
       
      </div>
    
  </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="alert alert-info" role="alert">
            Not you can Upload new Resume, Cover Letter and Academic Certificates
          </div>
          
    </div>
      <div class="col-12">
        <div class="row">
          
     <div class="col">
        <div class="form-group">
            <label style="display: block;">Resume</label>
            <input class="form-control" type="file" name="resume">
          </div>
     </div>
     <div class="col">
        <div class="form-group">
          <label style="display: block;">Cover Letter</label>
          <input class="form-control" type="file" name="coverletter">
        </div>
     </div>
     <div class="col">
        <div class="form-group">
          <label style="display: block;">Zip all Professional Certificates and attach the zip here</label>
          <input class="form-control" type="file" name="certs">
        </div>
        </div>
      </div>
    </div>
      
      <button type="submit" class="btn btn-primary is-info is-outlined">Upload Documents</button>
</div>
