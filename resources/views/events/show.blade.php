@extends('layout.master')

@section('content')


        @include('partials.message')
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        Evenemang - {{$event->name}}
                    </h1>
                </div>

            </div>
        </div>
        <!-- END Page Header -->

        <!-- Page Content -->
        <div class="content">
            <!-- My Block -->
            <div class="block">
                <div class="block-header">
                    
                </div>
                <div class="block-content">

                </div>
                <div class="block-footer">
                    &nbsp;
                </div>
            </div>
            <!-- END My Block -->

        </div>
        <!-- END Page Content -->


@endsection
