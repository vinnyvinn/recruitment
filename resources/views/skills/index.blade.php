@extends('layouts.app')

@section('page-title', trans('app.skills'))
@section('page-heading', trans('app.skills'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('app.skills')
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
                             @lang('app.add_skill')
                          </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="min-width-100">@lang('app.name')</th>
                        <th class="text-center">@lang('app.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (count($list_skills))
                            @foreach ($list_skills as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>

                                    <td class="text-center">
                                        <button type="button" class="btn btn-icon" title="@lang('app.edit_skill')" data-toggle="modal" data-target="#edit-form-{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <div class="modal fade" id="edit-form-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editformLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">edit Skill</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            {!! Form::open(['route' => ['skills.update', $item->id], 'method' => 'PUT', 'id' => 'role-form']) !!}
                                                                
                                        
                                                            <div class="form-group">
                                                                <label>@lang('app.skillname')</label>
                                                                <span class="help">e.g. "Web"</span>
                                                                <input type="text" class="form-control" required name="name" value="{{ $item->name }}">
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
                                       
                                            <a href="{{ route('skills.destroy', $item->id) }}" class="btn btn-icon"
                                               title="delete skill"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               data-method="DELETE"
                                               data-confirm-title="please confirm"
                                               data-confirm-text="are you sure you want to Delete this skill?"
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
              <h5 class="modal-title" id="exampleModalLabel">Add Skill</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form class="" role="form" action="{{ route('skills.store')}}" method="post">
                    

                    <div class="form-group">
                        <label>@lang('app.skillname')</label>
                        <span class="help">e.g. "Web"</span>
                        <input type="text" class="form-control" required name="name">
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
