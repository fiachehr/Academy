@php
$lessonCounter = 1;
$homeworkCounter = 1;
$colors = ['info', 'warning', 'danger', 'primary', 'secondary', 'success'];
$colorIndex = 0;
@endphp
@extends('panel.layouts.panelMasterpage')
@section('pageTitle', $course->course->title)
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $course->course->title }}</h3>
        </div>
        <div class="card-body">
            <div id="accordion">

                @foreach ($course->course->lessons as $lesson)
                    @if ($lesson->is_active)
                        @php
                            $isShow = '';
                            if ($lessonCounter == 1) {
                                $isShow = 'show';
                            }
                        @endphp
                        <div class="card card-{{ $colors[$colorIndex] }}">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapse{{ $lessonCounter }}">
                                        {{ $lessonCounter . '- ' . $lesson->title }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse{{ $lessonCounter }}" class="collapse {{ $isShow }}"
                                data-parent="#accordion">
                                <div class="card-body">
                                    {{ $lesson->body }}
                                </div>
                            </div>
                        </div>
                        @php
                            $lessonCounter++;
                            $colorIndex == 5 ? ($colorIndex = 0) : $colorIndex++;
                        @endphp
                    @endif
                @endforeach

            </div>
        </div>
    </div>
@endsection
