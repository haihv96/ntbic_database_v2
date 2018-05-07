@extends('layouts.dashboards.app')

@section('title', 'Mangagement patents data')
@section('linkage.heading.first', 'Dashboard')
@section('linkage.heading.second', 'Patents')
@section('linkage.heading.second.link', route('patents.index'))
@section('page_title')
    <i class="fa fa-database"></i>
    Patents Management
@endsection
@section('container')
    <div class="portlet light bordered patents">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="fa fa-table"></i>
                <span class="caption-subject bold uppercase"> Patent List</span>
            </div>
        </div>
        <div class="portlet-body table-list">
            <input id="current-page-url" hidden />
            <div class="no-footer">
                <div class="row toolkit">
                    <div class="col-xs-6">
                        <div class="row">
                            @include('management.patents.helpers.create')
                            @include('management.patents.helpers.delete_selected')
                        </div>
                    </div>
                    <div class="col-xs-6">
                        @if($records->count())
                            @include('management.patents.helpers.delete_all')
                        @endif
                        <div class="form-search-in-table">
                            {!! Form::open(['route' => 'patents.index', 'method' => 'get', 'class'=> 'search-in-table']) !!}
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
                    @include('management.patents.records', ['records' => $records])
                </div>
            </div>
        </div>
    </div>
    @include('shared.modal', [
        'id' => 'create-record',
        'title' => 'Create Patent',
        'titleBg' => 'blue',
        'class' => 'modal-lg modal-loadable modal-long'
    ])
    @include('shared.modal', [
        'id' => 'show-record',
        'title' => 'View Patent',
        'titleBg' => 'blue-dark',
        'class' => 'modal-lg modal-loadable modal-long'
    ])
    @include('shared.modal', [
        'id' => 'edit-record',
        'title' => 'Edit Patent',
        'titleBg' => 'blue-steel',
        'class' => 'modal-lg modal-loadable modal-long'
    ])
    @include('shared.modal', [
        'id' => 'delete-record',
        'title' => 'Delete Patent',
        'titleBg' => 'red-haze',
        'class' => 'modal-dialog'
    ])
@endsection
