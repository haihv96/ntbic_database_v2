@extends('layouts.dashboards.app')

@section('title', 'Mangagement raw profiles data')
@section('linkage.heading.first', 'Dashboard')
@section('linkage.heading.second', 'Raw Products')
@section('linkage.heading.second.link', route('raw-products.index'))
@section('page_title')
    <i class="fa fa-database"></i>
    Raw Products Management
@endsection
@section('container')
    <div class="portlet light bordered raw-products">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="fa fa-table"></i>
                <span class="caption-subject bold uppercase"> Raw Product List</span>
            </div>
        </div>
        <div class="portlet-body table-list">
            <input id="current-page-url" hidden/>
            <div class="no-footer">
                <div class="row toolkit">
                    <div class="col-xs-6">
                        <a href="#delete-record" data-toggle="modal" class="request-client-modal font-red btn-sm">
                            <button id="button-delete-selected" class="btn red display-none">Delete</button>
                            <div class="modal-content" hidden>
                                @component('management.raw-products.helpers.form_delete', [
                                    'id' => 'form-delete-selected',
                                ])
                                    @slot('body')
                                        Do you sure delete
                                        <span class="bold font-red">
                                            <span id="records-checked"></span>
                                            SELECTED RAW PROFILES
                                        </span> ?
                                    @endslot
                                @endcomponent
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-search-in-table">
                            {!! Form::open(['route' => 'raw-products.index', 'method' => 'get', 'class'=> 'search-in-table']) !!}
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
                    @include('management.raw-products.records', ['records' => $records])
                </div>
            </div>
        </div>
    </div>
    @include('shared.modal', [
        'id' => 'show-record',
        'title' => 'View Raw Product',
        'titleColor' => 'blue-dark',
        'class' => 'modal-lg modal-loadable modal-long'
    ])
    @include('shared.modal', [
        'id' => 'edit-record',
        'title' => 'Edit Raw Product',
        'titleColor' => 'blue-steel',
        'class' => 'modal-lg modal-loadable modal-long'
    ])
    @include('shared.modal', [
        'id' => 'delete-record',
        'title' => 'Delete Raw Product',
        'titleColor' => 'red-haze',
        'class' => 'modal-dialog'
    ])
@endsection
