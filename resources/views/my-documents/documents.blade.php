@extends('layouts.app')

@section('page-title', trans('app.docs'))
@section('page-heading', trans('app.docs'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
       docs
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
                            add Document
                          </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="min-width-100">@lang('app.name')</th>
                        <th class="min-width-100">File Types</th>
                        <th class="text-center">@lang('app.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (count($docs))
                            @foreach ($docs as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->file_type}}</td>

                                    <td class="text-center">
                                        <button type="button" class="btn btn-icon" title="@lang('app.edit_department')" data-toggle="modal" data-target="#edit-form-{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <div class="modal fade" id="edit-form-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editformLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">edit document</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            {!! Form::open(['route' => ['required-docs.update', $item->id], 'method' => 'PUT', 'id' => 'role-form']) !!}
                                                                
                                        
                                                           <div class="form-group">
                                                            <label>Name of the document</label>
                                                            <span class="help">e.g. "Curriculum Vitae"</span>
                                                            <input type="text" class="form-control" required name="name" value="{{$item->name}}">
                                                        </div>
                                                         <div class="form-group">
                                                            <label>File type of the document</label>
                                                            <span class="help">e.g. "PDf"</span>
                                                            <input type="text" class="form-control" required name="file_type" value="{{$item->file_type}}">
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
                                       
                                            <a href="{{ route('required-docs.destroy', $item->id) }}" class="btn btn-icon"
                                               title="delete department"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               data-method="DELETE"
                                               data-confirm-title="please confirm"
                                               data-confirm-text="are you sure you want to Delete {{ $item->name }}  department?"
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
              <h5 class="modal-title" id="exampleModalLabel">Add Required Documents from Candidates</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form class="" role="form" action="{{ route('required-docs.store')}}" method="post">
                    

                    <div class="form-group">
                        <label>Name of the document</label>
                        <span class="help">e.g. "Curriculum Vitae"</span>
                        <input type="text" class="form-control" required name="name">
                    </div>
                     <div class="form-group">
                        <label>File type of the document</label>
                        <span class="help">e.g. "PDf"</span>
                        <input type="text" class="form-control" required name="file_type">
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Document</button>
            </form>
          </div>
          </div>
        </div>
      </div>

     
@stop
