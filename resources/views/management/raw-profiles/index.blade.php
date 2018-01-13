@extends('layouts.dashboards.app')

@section('title', 'Mangagement raw profiles data')
@section('linkage.heading.first', 'Dashboard')
@section('linkage.heading.second', 'Raw Profiles')
@section('linkage.heading.second.link', route('raw-profiles.index'))
@section('page_title')
    <i class="fa fa-database"></i>
    Raw Profiles Management
@endsection
@section('container')
    <div class="portlet light bordered raw-profiles">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="fa fa-table"></i>
                <span class="caption-subject bold uppercase"> Raw Profile List</span>
            </div>
        </div>
        <div class="portlet-body table-list">
            <input id="current-page-url" hidden />
            <div class="no-footer">
                <div class="row toolkit">
                    <div class="col-xs-6">
                        <div class="row">
                            @include('management.raw-profiles.helpers.delete_selected')
                            @include('management.raw-profiles.helpers.transfer_selected')
                        </div>
                    </div>
                    <div class="col-xs-6">
                        @if($records->count())
                            @include('management.raw-profiles.helpers.delete_all')
                            @include('management.raw-profiles.helpers.transfer_all')
                        @endif
                        <div class="form-search-in-table float-right">
                            {!! Form::open(['route' => 'raw-profiles.index', 'method' => 'get', 'class'=> 'search-in-table']) !!}
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
                    @include('management.raw-profiles.records', ['records' => $records])
                </div>
            </div>
        </div>
    </div>
    @include('shared.modal', [
        'id' => 'show-record',
        'title' => 'View Raw Profile',
        'titleBg' => 'blue-dark',
        'class' => 'modal-lg modal-loadable modal-long'
    ])
    @include('shared.modal', [
        'id' => 'edit-record',
        'title' => 'Edit Raw Profile',
        'titleBg' => 'blue-steel',
        'class' => 'modal-lg modal-loadable modal-long'
    ])
    @include('shared.modal', [
        'id' => 'delete-record',
        'title' => 'Delete Raw Profile',
        'titleBg' => 'red-haze',
        'class' => 'modal-dialog'
    ])
    @include('shared.modal', [
        'id' => 'transfer-record',
        'title' => 'Transfer Raw Profile',
        'titleBg' => 'blue-steel',
        'class' => 'modal-dialog'
    ])
@endsection
