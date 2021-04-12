@extends('layouts.app')

@section('content')
    <div class="row justify-content-center min-vh-100" style="background-color: #EAEAEA !important;">
        <div class="col-2 my-5">

        </div>
        <div class="col-7 my-5">
            <div class="row justify-content-center">
                <div class="col-10 bg-white rounded px-5 py-3 mb-4">
                    <div class="row my-3 align-items-center">
                        <div class="col-3">
                            <img src="/storage/images/{{$job->company->logo ?? 'default_logo.png'}}" style="max-height: 100px; max-width: 100%;">
                        </div>
                        <div class="col-8 h2 text-center pt-2">
                            <strong>{{ $job->title }}</strong>
                        </div>
                    </div>
                    <h5 class="text-muted text-uppercase mt-5">your role at this position</h5>
                    <p class="h5 mt-3 pr-5" style="font-weight: 600;">{{ $job->description }}</p>
                    <h5 class="text-muted text-uppercase mt-5">You'll be working&ensp;<strong class="text-capitalize" style="color: #1C1C1C; font-weight: 600;">{{ $job->work_type }}</strong>&ensp;
                        |&ensp;<strong class="text-capitalize" style="color: #1C1C1C; font-weight: 600;">{{ $job->work_time }}</strong></h5>
                    <h5 class="text-muted text-uppercase mt-4">SALARY BETWEEN&ensp;<strong class="text-lowercase" style="color: #1C1C1C; font-weight: 600;">{{ $job->min_price }}</strong>&ensp;
                        AND&ensp;<strong class="text-lowercase" style="color: #1C1C1C; font-weight: 600;">{{ $job->max_price }} {{ $job->currency }}</strong></h5>
                    <h5 class="text-muted text-uppercase mt-4">Required skills level&ensp;<strong class="text-capitalize" style="color: #1C1C1C; font-weight: 600;">{{ $job->age }}</strong>&ensp;
                        with&ensp;<strong class="text-capitalize" style="color: #1C1C1C; font-weight: 600;">{{ $job->experience }}</strong>&ensp;experience</h5>
                    <h5 class="text-muted text-uppercase mt-5">Languages</h5>
                    <div class="row my-3 pl-2">
                    @forelse($job->languages()->get() as $language)
                            <div style="color: #1c1c1c; border: 1px solid #1C1C1C;" class="py-1 px-3 rounded-pill mx-1 my-1 text-capitalize">{{ $language->name }}</div>
                    @empty
                        No languages required.

                    @endforelse
                    </div>
                    <h5 class="text-muted text-uppercase mt-4">Technologies</h5>
                    <div class="row my-3 pl-2">
                    @forelse($job->technologies()->get() as $technology)
                            <div style="color: #1c1c1c; border: 1px solid #1C1C1C;" class="py-1 px-3 rounded-pill mx-1 my-1 text-capitalize">{{ $technology->name }}</div>
                        @empty
                            No technologies required.
                    @endforelse
                    </div>

                    <h5 class="text-muted text-uppercase mt-5">
                        Company&ensp;<strong style="text-transform: none !important; color: #1C1C1C; font-weight: 600;">{{ $job->company->name }}</strong>
                    </h5>
                    <h5 class="text-muted text-uppercase mt-4">
                        Office Location&ensp;<strong class="text-capitalize" style="color: #1C1C1C; font-weight: 600;">{{ $job->company->country }}</strong>
                        &ensp;|&ensp;<strong class="text-capitalize" style="color: #1C1C1C; font-weight: 600;">{{ $job->company->city }}</strong>&ensp;|&ensp;<strong class="text-capitalize" style="color: #1C1C1C; font-weight: 600;">{{ $job->company->adress }}</strong>
                    </h5>
                    <h5 class="text-muted text-uppercase mt-4">About us</h5>
                    <p class="h5 mt-3 pr-5" style="font-weight: 600;">{{ $job->company->about_us }}</p>
                    <div class="row justify-content-center">
                        <div class="col text-center">
                            <a class="btn rounded-pill text-white px-5 pt-3 pb-2 my-5" href="{{ $job->url ?? '/jobs/apply/'.$job->id}}" style="background-color: #1C1C1C; font-weight: 600 "><h5>Apply Now</h5></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2 text-center">

        </div>
    </div>
@endsection
