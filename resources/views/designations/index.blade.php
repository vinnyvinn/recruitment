@extends('layouts.app')

@section('page-title', 'Designations')
@section('page-heading', 'Designations')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
       designations
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
                            add designation
                          </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="min-width-100">@lang('app.name')</th>
                        <th>Department</th>
                        <th class="text-center">@lang('app.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (count($designations))
                            @foreach ($designations as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->departments->name }}</td>

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
                                                                <label>designation Name</label>
                                                                <span class="help">e.g. "Procurement"</span>
                                                                <input type="text" class="form-control" required name="name" value="{{ $item->name }}">
                                                            </div>
                                                            <div class="form-group">
                                                                    <label>Department</label>
                                                                    <select name="department_id" class="form-control select2" id="" style="width:100%">
                                                                        @foreach ($dept as $des)
                                                                            <option value="{{ $des->id }}"  @if($item->department_id == $des->id) selected @endif>{{ $des->name }}</option>
                                                                        @endforeach
                                                                    </select>
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
                                       
                                            <a href="{{ route('designations.destroy', $item->id) }}" class="btn btn-icon"
                                               title="delete designation"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               data-method="DELETE"
                                               data-confirm-title="please confirm"
                                               data-confirm-text="are you sure you want to Delete {{ $item->name }}  designation?"
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
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add designation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form class="" role="form" action="{{ route('designations.store')}}" method="post">
                    

                    <div class="form-group">
                        <label>Name of the designation</label>
                        <span class="help">e.g. "Finance"</span>
                        <input type="text" class="form-control" required name="name">
                    </div>

                    <div class="form-group">
                        <label>Department</label>
                        <select name="department_id" class="form-control select2" id="" style="width:100%">
                            @foreach ($dept as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
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
