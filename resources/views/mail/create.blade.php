@extends('layout.master')

@section('content')


        @include('partials.message')
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
                    <strong>{{$recipient_string}}</strong>

                </div>
                <div class="block-content">
                   {!! Form::open() !!}
                    {!! Form::hidden('type', $type) !!}
                    {!! Form::hidden('type_id', $type_id) !!}
                    {!! Form::hidden('recipient_string', $recipient_string) !!}
                    <div class="form-group">
                        {{Form::label('to', 'Mottagare', ['class' => 'col-md-3'])}}
                        <div>
                            @foreach($recipients as $recipient)
                                {{$recipient->name}},
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('subject', 'Ämne', ['class' => 'col-md-3'])}}
                        {{Form::text('subject', null, ['form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('maincontent', 'Innehåll', ['class' => 'col-md-3'])}}
                        {{Form::textarea('maincontent', null, ['form-control'])}}
                    </div>

                    {{Form::submit('Skicka mail', ['class' => 'btn btn-success'])}}


                </div>
                <div class="block-footer">
                    &nbsp;
                </div>
            </div>
            <!-- END My Block -->

        </div>
        <!-- END Page Content -->


@endsection
