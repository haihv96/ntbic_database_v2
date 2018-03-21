@extends('layouts.dashboards.app')

@section('title', 'Mangagement projects data')
@section('linkage.heading.first', 'Dashboard')
@section('linkage.heading.second', 'Projects')
@section('linkage.heading.second.link', route('projects.index'))
@section('page_title')
    <i class="fa fa-database"></i>
    Projects Management
@endsection
@section('container')
    <div class="portlet light bordered projects">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="fa fa-table"></i>
                <span class="caption-subject bold uppercase"> Project List</span>
            </div>
        </div>
        <div class="portlet-body table-list">
            <input id="current-page-url" hidden />
            <div class="no-footer">
                <div class="row toolkit">
                    <div class="col-xs-6">
                        <div class="row">
                            @include('management.projects.helpers.delete_selected')
                        </div>
                    </div>
                    <div class="col-xs-6">
                        @if($records->count())
                            @include('management.projects.helpers.delete_all')
                        @endif
                        <div class="form-search-in-table float-right">
                            {!! Form::open(['route' => 'projects.index', 'method' => 'get', 'class'=> 'search-in-table']) !!}
                            {!! Form::token() !!}
                            Search:
                            {!! Form::text('search',null, ['class'=>'form-control input-sm input-small input-inline']) !!}
                            <span id="search-loadable"></span>
                            {!! Form::close() !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div id="records" class="ajax-table">
                    @include('management.projects.records', ['records' => $records])
                </div>
            </div>
        </div>
    </div>
    @include('shared.modal', [
        'id' => 'show-record',
        'title' => 'View Project',
        'titleBg' => 'blue-dark',
        'class' => 'modal-lg modal-loadable modal-long'
    ])
    @include('shared.modal', [
        'id' => 'edit-record',
        'title' => 'Edit Project',
        'titleBg' => 'blue-steel',
        'class' => 'modal-lg modal-loadable modal-long'
    ])
    @include('shared.modal', [
        'id' => 'delete-record',
        'title' => 'Delete Project',
        'titleBg' => 'red-haze',
        'class' => 'modal-dialog'
    ])
@endsection
