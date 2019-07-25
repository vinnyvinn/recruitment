@extends('layouts.app')

@section('page-title', 'Job Vacancies')
@section('page-heading', 'Job Vacancies')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
            Job Vacancies
    </li>
@stop

@section('content')

    @include('partials.messages')

    <div class="card">
        <div class="card-body">
            <div class="row mb-3 pb-3 border-bottom-light">
                <div class="col-lg-12">
                    <div class="float-right">
                        
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-plus mr-2"></i>
                            add a Job Vacancy
                          </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="min-width-100">Position</th>
                        <th>Job Location</th>
                        <th>Posted date</th>
                        <th>Last Date</th>
                        <th>Close</th>
                        <th>Status</th>
                        <th class="text-center">@lang('app.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                        @if (count($vacancies))
                            @foreach ($vacancies as $item)
                                <tr>
                                    <td>{{ $item->designations->name }}</td>
                                    <td>{{ $item->job_location }}</td>
                                    <td>{{ $item->post_date }}</td>
                                    <td>{{ $item->ldate }}</td>
                                    <td>{{ $item->cdate }}</td>
                                    <td>@if ($item->status == 'Open')
                                            <span class="badge badge-warning">{{ $item->status }}</span>
                                    @else
                                    <span class="badge badge-primary">{{ $item->status }}</span>
                                    @endif</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-icon" title="@lang('app.edit_designation')" data-toggle="modal" data-target="#edit-form-{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <div class="modal fade" id="edit-form-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editformLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">edit designation</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            {!! Form::open(['route' => ['designations.update', $item->id], 'method' => 'PUT', 'id' => 'role-form']) !!}
                                                                
                                        
                                                            
                                                            <div class="form-group">
                                                                    <label>Position</label>
                                                                    <select name="department_id" class="form-control select2" id="" style="width:100%">
                                                                        @foreach ($design as $des)
                                                                            <option value="{{ $des->id }}"  @if($item->designation_id == $des->id) selected @endif>{{ $des->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                            
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                           
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                      <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Job</button>
                                                    </form>
                                                  </div>
                                                  </div>
                                                </div>
                                              </div>
                                       
                                            <a href="{{ route('jobs.destroy', $item->id) }}" class="btn btn-icon"
                                               title="delete Job Vacancy"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               data-method="DELETE"
                                               data-confirm-title="please confirm"
                                               data-confirm-text="are you sure you want to Delete {{ $item->designations->name }}  Vacancy?"
                                               data-confirm-delete="yes Delete it">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                      
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4"><em>@lang('app.no_records_found')</em></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Job</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="container-fluid">
                            
                <form class="" role="form" action="{{ route('jobs.store')}}" method="post">
                        <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                                <label>Position</label>
                                                <select name="designation_id" class="form-control select2" id="" style="width:100%">
                                                    @foreach ($design as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        <div class="form-group">
                                            <label>Number of Posts <span>e.g 2</span></label>
                                            <input type="number" class="form-control" name="no_position">
                                        </div>

                                        <div class="form-group">
                                            <label>Job Type</label>
                                            <select name="job_type" class="form-control select2" id="" style="width:100%">
                                                    <option value="Contractual">Contractual</option>
                                                    <option value="Part Time">Part Time</option>
                                                    <option value="Full Time">Full Time</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                                <label>Job Status</label>
                                                <select name="status" class="form-control select2" id="" style="width:100%">
                                                        <option value="Open">Open</option>
                                                        <option value="Closed">Closed</option>
                                                        <option value="Drafted">Drafted</option> 
                                                </select>
                                        </div>
                                        <div class="form-group">
                                                <label>Age Required</label>
                                                <input type="text" name="age" class="form-control">
                                            </div>
                                        <div class="form-group">
                                                    <label>Short Description</label>
                                                    <textarea class="form-control" rows="5" name="short_description"></textarea>
                                        </div>
                                </div>
                    
                                <div class="col-md-6">
                                        <div class="form-group">
                                                <label>Experience Required</label>
                                                <input type="text" name="experience" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                    <label>Job Location</label>
                                                    <input type="text" name="job_location" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                        <label>Salary Range</label>
                                                        <input type="text" name="salary_range" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                            <label>Select Skills Required</label>
                                                                <select class="form-control select-engine is-primary" name="skill_id[]" multiple="multiple" style="width: 100%">
                                                                     @foreach($skills as $myskills)
                                                                      <option value="{{$myskills->id}}">{{$myskills->name}}</option>
                                                                      @endforeach
                                                                  </select>
                        
                                                        </div>
                                                    <div class="form-group">
                                                            <label>Post Date</label>
                                                            <input type="text" id="datepicker" name="post_date" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                                <label>Last Date to Apply</label>
                                                                <input type="text" id="datepicker1" name="ldate" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                    <label>Close Date</label>
                                                                    <input type="text"id="datepicker2"  name="cdate" class="form-control">
                                                                </div>
                                </div>
                                
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" id="summernote" name="description" style="width:100%:"></textarea>
                                            </div>
                                    </div>
                                

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Save changes</button>
            </form>
          </div>
          </div>
        </div>
      </div>

     
@stop
