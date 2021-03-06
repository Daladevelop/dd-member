@extends('errors.layout.master')

@section('content')

    <!-- Error Content -->
    <div class="content bg-white text-center pulldown overflow-hidden">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <!-- Error Titles -->
                <h1 class="font-s128 font-w300 text-flat animated bounceIn">403</h1>
                <h2 class="h3 font-w300 push-50 animated fadeInUp">We are sorry but you do not have permission to access this page..</h2>
                <!-- END Error Titles -->

                <!-- Search Form -->
                <form class="form-horizontal push-50" action="base_pages_search.html" method="post">
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="input-group input-group-lg">
                                <input class="form-control" type="text" placeholder="Search application..">
                                <div class="input-group-btn">
                                    <button class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END Search Form -->
            </div>
        </div>
    </div>
    <!-- END Error Content -->

@endsection
