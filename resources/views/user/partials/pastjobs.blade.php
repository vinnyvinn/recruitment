<div class="row">
               
   
        <div class="col-12" id="work-experience">
      
       @foreach($pastjobs as $row)
      
        <h5>Position: {{ $row->jobs->designations->name}}</h5>
        
         <ul class="work-ex">
            <li><span class="heading">Application Status :</span><span class="body-text"> @if ($row->status ==3)
                Not Viewed
            @elseif($row->status ==9)
                Successful
            @else 
            Viewed
            @endif  </span></li>

            <li><span class="heading">Date Applied :</span><span class="body-text">{{ $row->created_at->format('d-m-Y') }}</span></li>
            <li><span class="heading">Expected Salary :</span><span class="body-text">{{ $row->jobs->salary_range }}</span></li>
            <li><span class="heading">Job Status :</span><span class="body-text">{{ $row->jobs->status }}</span></li>
            <li><span class="heading">Location :</span><span class="body-text">{{ $row->jobs->job_location }}</span></li>
            <li><span class="heading">Job type :</span><span class="body-text">{{ $row->jobs->job_type }}</span></li>
             </ul>
   
             
        
        @endforeach
         </div>
   </div>