@php 
    $countAbout = Modules\About\Entities\About::count();
    $countServices = Modules\Services\Entities\Service::count(); 
    $countNews = Modules\News\Entities\News::count(); 
    $countResources = Modules\Resources\Entities\Resource::count(); 
@endphp 
@extends('layouts.backend.container')

@section('dynamicdata')
<section>
    <div class="row mt-2">

        <div class="col-lg-6 col-sm-12">
            <div class="info-box">
                <span class="info-box-icon bg-org">
                    <i class="fa fa-file-image-o"></i>
                </span>

                <div class="info-box-content mr-1">
                    <span class="info-box-text">About : {{ $countAbout }}</span>
                    <p style="margin-top: 30px;">
                        <a href="{{ route('admin.about.index') }}">Quick Link<i class="fa fa-long-arrow-right"></i></a>
                    </p>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-lg-6 col-sm-12">
            <div class="info-box">
                <span class="info-box-icon bg-light-yellow">
                    <i class="fa fa-briefcase"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">Services : {{ $countServices }}</span>
                    <p style="margin-top: 30px;">
                        <a href="{{ route('admin.services.index') }}">Quick Link<i class="fa fa-long-arrow-right"></i></a>
                    </p>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        
        <div class="col-lg-6 col-sm-12">
            <div class="info-box">
                <span class="info-box-icon bg-voilet">
                    <i class="fa fa-newspaper-o"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">News : {{ $countNews }}</span>
                    <p style="margin-top: 30px;">
                        <a href="{{ route('admin.news.index') }}">Quick Link<i class="fa fa-long-arrow-right"></i></a>
                    </p>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-lg-6 col-sm-12">
            <div class="info-box">
                <span class="info-box-icon bg-sky-blue">
                    <i class="fa fa-file"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">Resorces : {{$countResources}}</span>
                    <p style="margin-top: 30px;">
                        <a href="{{ route('admin.resources.index') }}">Quick Link<i class="fa fa-long-arrow-right"></i></a>
                    </p>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

    </div>
</section>
@endsection