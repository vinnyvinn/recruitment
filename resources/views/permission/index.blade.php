@extends('layouts.app')

@section('page-title', trans('app.permissions'))
@section('page-heading', trans('app.permissions'))

@section ('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('app.permissions')
    </li>
@stop

@section('content')

@include('partials.messages')




<div class="row">
    <div class="col-4">
            
        
        <div class="card">
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-md-12">
                           <form action="{{ route('permission.store') }}" id="permission-form" method="POST" accept-charset="UTF-8" class="mb-4">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="name">@lang('app.name')</label>
                                    <input type="text" class="form-control" id="name"
                                        name="name" placeholder="@lang('app.permission_name')" value="{{ $edit ? $permission->name : old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="display_name">@lang('app.display_name')</label>
                                    <input type="text" class="form-control" id="display_name"
                                        name="display_name" placeholder="@lang('app.display_name')" value="{{ $edit ? $permission->display_name : old('display_name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">@lang('app.description')</label>
                                    <textarea name="description" id="description" class="form-control">{{ $edit ? $permission->description : old('description') }}</textarea>
                                </div>
                                <div class="row">
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary" name="createpermission">
                                                {{ trans('app.create_permission') }}
                                            </button>
                                        </div>
                                    </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
       
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                   
                    <form action="{{ route('permission.save') }}" method="POST" class="mb-4" id="permission-attach" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="table-responsive" id="users-table-wrapper">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th class="min-width-200">@lang('app.name')</th>
                                        @foreach ($roles as $role)
                                            <th class="text-center">{{ $role->display_name }}</th>
                                        @endforeach
                                        <th class="text-center min-width-100">@lang('app.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if (count($permissions))
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->display_name ?: $permission->name }}</td>
                
                                            @foreach ($roles as $role)
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        {!!
                                                            Form::checkbox(
                                                                "roles[{$role->id}][]",
                                                                $permission->id,
                                                                $role->hasPermission($permission->name),
                                                                [
                                                                    'class' => 'custom-control-input',
                                                                    'id' => "cb-{$role->id}-{$permission->id}"
                                                                ]
                                                            )
                                                        !!}
                                                        <label class="custom-control-label d-inline"
                                                               for="cb-{{ $role->id }}-{{ $permission->id }}"></label>
                                                    </div>
                                                </td>
                                            @endforeach
                
                                            <td class="text-center">
                                                <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-icon"
                                                   title="@lang('app.edit_permission')" data-toggle="tooltip" data-placement="top">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                
                                                @if ($permission->removable)
                                                    <a href="{{ route('permission.destroy', $permission->id) }}" class="btn btn-icon"
                                                       title="@lang('app.delete_permission')"
                                                       data-toggle="tooltip"
                                                       data-placement="top"
                                                       data-method="DELETE"
                                                       data-confirm-title="@lang('app.please_confirm')"
                                                       data-confirm-text="@lang('app.are_you_sure_delete_permission')"
                                                       data-confirm-delete="@lang('app.yes_delete_it')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                @endif
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
                        @if (count($permissions))
                        <div class="row">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary" name="assignpermission">@lang('app.save_permissions')</button>
                            </div>
                        </div>
                    @endif
                    
                    {!! Form::close() !!}
                    </div>
                </div>
                
                
                
                @stop
                
            </div>
        </div>
    </div>
</div>


        
@section('scripts')
    @if ($edit)
        {!! JsValidator::formRequest('Boaz\Http\Requests\Permission\UpdatePermissionRequest', '#permission-form') !!}
    @else
        {!! JsValidator::formRequest('Boaz\Http\Requests\Permission\CreatePermissionRequest', '#permission-form') !!}
    @endif
@stop