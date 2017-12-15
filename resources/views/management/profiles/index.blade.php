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
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="fa fa-table"></i>
                <span class="caption-subject bold uppercase"> Raw Profile List</span>
            </div>
        </div>
        <div class="portlet-body table-list">
            <div class="no-footer">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div id="sample_1_filter" class="dataTables_filter"><label>
                                {!! Form::open(['route' => 'raw-profiles.index', 'method' => 'get', 'class'=> 'search-in-table']) !!}
                                {!! Form::token() !!}
                                Search:
                                {!! Form::text('search',null, ['class'=>'form-control input-sm input-small input-inline']) !!}
                                {!! Form::close() !!}
                            </label>
                        </div>
                    </div>
                </div>
                <div id="raw-profiles" class="ajax-table">
                    @include('management.profiles.list', ['rawProfiles' => $rawProfiles]);
                </div>
            </div>
        </div>
    </div>
@endsection