@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.library_list'))

@section('css')
    @toastr_css
@endsection

@section('content')
     <!-- row -->
     <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('library.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('trans.add_new_book') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('trans.book_name') }}</th>
                                            <th>{{ trans('trans.name_teacher') }}</th>
                                            <th>{{ trans('trans.grade') }}</th>
                                            <th>{{ trans('trans.acadmy_classe') }}</th>
                                            <th>{{ trans('trans.section') }}</th>
                                            <th>{{ trans('trans.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($books as $index => $book)
                                            <tr>
                                                <td>{{ $index + 1}}</td>
                                                <td>{{$book->title}}</td>
                                                <td>{{$book->teacher->name}}</td>
                                                <td>{{$book->grade->name}}</td>
                                                <td>{{$book->classe->classe_name}}</td>
                                                <td>{{$book->section->name_section}}</td>
                                                <td>
                                                    
                                                    <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{ trans('trans.processes') }}
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="{{ route('openFile', basename($book->file_name)) }}" target="_blank" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i style="color: #ffc107" class="far fa-eye" ></i> {{ trans('trans.show_book') }}</a>
                                                            <a class="dropdown-item" href="{{ route('downloadAttachment', basename($book->file_name)) }}" title="{{ trans('trans.download_book') }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i style="color: #0000cc" class="fas fa-download"></i> {{ trans('trans.download') }}</a>
                                                            <a class="dropdown-item" href="{{ route('library.edit', $book->id) }}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i style="color:green" class="fa fa-edit"></i> {{ trans('trans.edit_book') }}</a>
                                                            <button type="button" class="dropdown-item cursor-pointer btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_book{{ $book->id }}"><i style="color: red" class="fa fa-trash"></i> {{ trans('trans.delete') }}</button>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>

                                        @include('dashboard.pages.library.destroy')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
