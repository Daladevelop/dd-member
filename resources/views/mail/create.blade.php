@extends('layout.master')

@section('content')

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        Skapa mail
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
                    <strong>Innehåll</strong>

                </div>
                <div class="block-content">
                   {!! Form::open() !!}
                    <div class="form-group">
                        {{Form::label('to', 'Mottagare', ['class' => 'col-md-3'])}}
                        {{Form::text('to', $recipients, ['form-control'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('subject', 'Ämne', ['class' => 'col-md-3'])}}
                        {{Form::text('subject', null, ['form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('content', 'Innehåll', ['class' => 'col-md-3'])}}
                        {{Form::textarea('content', null, ['form-control'])}}
                    </div>



                </div>
                <div class="block-footer">
                    &nbsp;
                </div>
            </div>
            <!-- END My Block -->

        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

@endsection
