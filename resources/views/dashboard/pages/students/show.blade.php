@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans.show_student'))

@section('css')
    @toastr_css
@endsection

@section('content')
      <!-- row -->
      <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="card-body">
                        <div class="tab nav-border">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                       role="tab" aria-controls="home-02"
                                       aria-selected="true">{{trans('trans.Student_information')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                       role="tab" aria-controls="profile-02"
                                       aria-selected="false">{{trans('trans.attachments')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{trans('trans.name')}}</th>
                                            <td>{{ $student->name }}</td>
                                            <th scope="row">{{trans('trans.Email')}}</th>
                                            <td>{{$student->email}}</td>
                                            <th scope="row">{{trans(key: 'trans.gender')}}</th>
                                            <td>{{$student->genders->name}}</td>
                                            <th scope="row">{{trans('trans.nationality')}}</th>
                                            <td>{{$student->nationality->name}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('trans.grade')}}</th>
                                            <td>{{ $student->grades->name }}</td>
                                            <th scope="row">{{trans('trans.classes')}}</th>
                                            <td>{{$student->classes->classe_name}}</td>
                                            <th scope="row">{{trans('trans.section')}}</th>
                                            <td>{{$student->sections->name_section}}</td>
                                            <th scope="row">{{trans('trans.date_of_birth')}}</th>
                                            <td>{{ $student->date_birth}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('trans.parent')}}</th>
                                            <td>{{ $student->myParent->name_father}}</td>
                                            <th scope="row">{{trans('trans.academic_year')}}</th>
                                            <td>{{ $student->academic_year }}</td>
                                            <th scope="row"></th>
                                            <td></td>
                                            <th scope="row"></th>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <form method="post" action="{{ route('upload_attachment') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="academic_year">{{trans('trans.attachments')}}
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="file" accept="image/*" name="photos[]" multiple required>
                                                        <input type="hidden" name="student_name" value="{{$student->name}}">
                                                        <input type="hidden" name="student_id" value="{{$student->id}}">
                                                    </div>
                                                </div>
                                                <br><br>
                                                <button type="submit" class="button button-border x-small">
                                                       {{trans('trans.submit')}}
                                                </button>
                                            </form>
                                        </div>
                                        <br>
                                        <table class="table center-aligned-table mb-0 table-hover"
                                               style="text-align:center">
                                            <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{trans('trans.filename')}}</th>
                                                <th scope="col">{{trans('trans.created_at')}}</th>
                                                <th scope="col">{{trans('trans.processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($student->images as $attachment)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$attachment->file_name}}</td>
                                                    <td>{{$attachment->created_at->diffForHumans()}}</td>
                                                    <td colspan="2">

                                                        <a class="btn btn-outline-success btn-sm" target="_blank"
                                                        href="{{url('show_attachment')}}/{{ $attachment->imageable->name }}/{{$attachment->file_name}}"
                                                        role="button"><i class="fas fa-eye"></i>&nbsp; {{trans('trans.show')}}</a>

                                                        <a class="btn btn-outline-info btn-sm"
                                                           href="{{url('download_attachment')}}/{{ $attachment->imageable->name }}/{{$attachment->file_name}}"
                                                           role="button"><i class="fas fa-download"></i>&nbsp; {{trans('trans.download')}}</a>

                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#Delete_img{{ $attachment->id }}"
                                                                title="{{ trans('trans.delete') }}"><i class="fa fa-trash"></i> {{trans('trans.delete')}}
                                                        </button>

                                                    </td>
                                                </tr>
                                                @include('dashboard.pages.students.delete_img')
                                            @endforeach
                                            </tbody>
                                        </table>
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