@extends('Home::layouts.master')

@section('title','صفحه اصلی')

@section('content')
    <main class="position-relative">
        @include('Home::parts.vip_posts', ['homeRepo' => $homeRepo])
        <div class="container">
            <!--Ads-->
            @include('Home::parts.advs_top', ['homeRepo' => $homeRepo])
            <!--Content-->
            <div class="row">
                <!-- sidebar-left -->
            @include('Home::parts.sidebar_right', ['homeRepo' => $homeRepo])
                <!-- main content -->
                <div class="col-lg-10 col-md-9 order-1 order-md-2">
                    <div class="row">
                       @include('Home::parts.news_posts')
                        @include('Home::parts.sidebar_left')
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
