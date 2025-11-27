@extends('dashboard.layouts.master')

@section('title', __('trans.school_mangement_system') . ' | ' . __('trans-parent.parents'))

@section('css')
    @toastr_css
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 mb-2">
                <h4 class="mb-0" style="font-family: 'Cairo', sans-serif"> {{ trans('trans-teacher.welcome') }}:
                    {{ auth()->guard('parent')->user()->name_father }}</h4>
                </h4>
            </div>
            <div class="col-sm-6 mt-3">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                </ol>
            </div>
        </div>
    </div>

    <!-- widgets -->
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-success">
                                <i class="fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark" style="font-family: 'Cairo', sans-serif">
                                {{ trans('trans.student_counts') }}</p>
                            <h4></h4>
                        </div>
                    </div>

                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{ route('parent.children') }}"
                            target="_blank"><span
                                class="text-danger">
                                {{ trans('trans.show_data') }}
                            </span></a>
                    </p>
                </div>
            </div>

        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-warning">
                                <i class="fas fa-chalkboard-teacher highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark" style="font-family: 'Cairo', sans-serif">
                                {{ trans('trans-teacher.sections_counts') }}</p>
                            <h4></h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{ route('parent.grades') }}" target="_blank"><span
                                class="text-danger">
                                {{ trans('trans.show_data') }}
                            </span>
                        </a>
                    </p>
                </div>
            </div>
        </div>

    </div>

    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row justify-content-center">
                @forelse ($sons as $son)
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <a href="">
                            <div class="card text-black mt-4">
                                <img class="w-50 mx-auto" src="{{ $son->image ? asset('storage/' . $son->image) : asset('assets/images/my_son.png') }}" />
                                <div class="card-body">
                                    <div class="text-center">
                                        <h5 style="font-family: 'Cairo', sans-serif" class="card-title">{{ $son->name }}
                                        </h5>
                                        <p class="text-muted mb-4">{{ trans('trans.Student_information') }}</p>
                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-between">
                                            <span>{{ trans('trans.grade') }}</span><span>{{ $son->grades->name }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>{{ trans('trans.class') }}</span><span>{{ $son->classes->classe_name }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>{{ trans('trans.section') }}</span><span>{{ $son->sections->name_section }}</span>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            {{--                                                    @if (\App\Models\Degree::where('student_id', $son->id)->count() == 0) --}}
                                            {{--                                                        <span>عدد الاختبارات</span><span --}}
                                            {{--                                                            class="text-danger">{{\App\Models\Degree::where('student_id',$son->id)->count()}}</span> --}}
                                            {{--                                                    @else --}}
                                            {{--                                                        <span>عدد الاختبارات</span><span --}}
                                            {{--                                                            class="text-success">{{\App\Models\Degree::where('student_id',$son->id)->count()}}</span> --}}
                                            {{--                                                    @endif --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <h3>
                        {{ trans('trans-parent.no_data') }}
                    </h3>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
