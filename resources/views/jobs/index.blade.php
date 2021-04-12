@extends('layouts.app')

@section('content')
    <div class="row justify-content-center min-vh-100" style="background-color: #EAEAEA !important;">
        <div class="col-2 my-5">
            <a class="btn rounded-pill text-uppercase w-75 my-1 py-2 mt-3" style="border: 1px solid #1C1C1C; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.05rem; line-height: 1.3rem; color: #1C1C1C;">Full Time</a>
            <a class="btn rounded-pill text-uppercase w-75 my-1 py-2" style="border: 1px solid #1C1C1C; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.05rem; line-height: 1.3rem; color: #1C1C1C;">Part Time</a>
            <a class="btn rounded-pill text-uppercase w-75 my-1 py-2" style="border: 1px solid #1C1C1C; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.05rem; line-height: 1.3rem; color: #1C1C1C;">Temporary</a>

            <a class="btn rounded-pill text-uppercase w-75 my-1 py-2 mt-5" style="border: 1px solid #1C1C1C; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.05rem; line-height: 1.3rem; color: #1C1C1C;">Remotely</a>
            <a class="btn rounded-pill text-uppercase w-75 my-1 py-2" style="border: 1px solid #1C1C1C; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.05rem; line-height: 1.3rem; color: #1C1C1C;">In Office</a>

            <a class="btn rounded-pill text-uppercase w-75 my-1 py-2 mt-5" style="border: 1px solid #1C1C1C; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.05rem; line-height: 1.3rem; background-color: #1C1C1C; color: #FF9900;">Show Map</a>

            <select class="btn rounded-pill text-uppercase w-100 my-1 py-2 mt-5 d-none" style="border: 1px solid #1C1C1C; color: #1C1C1C;">
                <option selected>Country</option>
            </select>
            <select class="btn rounded-pill text-uppercase w-100 my-1 py-2 d-none" style="border: 1px solid #1C1C1C; color: #1C1C1C;">
                <option selected>Region</option>
            </select>
            <select class="btn rounded-pill text-uppercase w-100 my-1 py-2 d-none" style="border: 1px solid #1C1C1C; color: #1C1C1C;">
                <option selected>< 10 km</option>
            </select>
        </div>
        <div class="col-7 my-5">
            <div class="row justify-content-center">
                @forelse($jobs as $job)
                    <div class="col-10 bg-white rounded px-5 py-3 mb-4">
                        <div class="row align-items-start pt-2">
                            <div class="col-9">
                                <div class="row align-items-center">
                                    <div class="h3"><strong>{{ $job->title}}</strong></div>
                                    <div class="rounded-pill px-4 py-1 ml-5 text-lowercase" style=" font-size: 1rem; line-height: 1.7rem; border: 2px outset #0099FF; color: #1C1C1C; font-weight: 600;">
                                        {{ $job->min_price }} - {{ $job->max_price }} {{ $job->currency }}</div>
                                </div>
                                <div class="row align-items-center my-4">
                                    @foreach($job->languages()->get() as $language)
                                        <div class="text-center rounded-pill py-1 px-3 mr-2" style="border: 2px outset #9900FF; color: #1C1C1C; font-weight: 600;">
                                            {{ $language->name }}</div>
                                    @endforeach
                                    <div class="text-center rounded-pill py-1 px-3 mr-2" style="border: 2px inset #9900FF; font-weight: 600; ">
                                        {{ $job->work_time }}</div>
                                    <div class="text-center rounded-pill py-1 px-3 mr-2" style="border: 2px inset #9900FF; font-weight: 600; ">
                                        {{ $job->work_type }}</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row justify-content-center mb-3">
                                    <img style="max-height: 100px; max-width: 100%;" src="/storage/images/{{ $job->company->logo ?? 'default_logo.png'}}">
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-end">
                            <div class="col-9">
                                <div class="row">
                                    <div class="h6 text-muted text-uppercase" style="font-weight: 600;">{{ $job->company->name }}&emsp;{{ $job->company->country }}, {{ $job->company->city }}</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row justify-content-end">
                                    <a href="/jobs/{{ $job->id }}" class="rounded-pill py-2 px-5 h5 text-center w-100" style="background-color: #1C1C1C; color: #FF9900;">Apply Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-10 bg-white rounded px-5 py-3 text-center">No job offers available now.</div>
                @endforelse
            </div>
            <div class="row justify-content-center text-center py-5">
                {{ $jobs->links("pagination::bootstrap-4") }}
            </div>
        </div>
        <div class="col-2 text-center" id="output">

        </div>
    </div>
@endsection
