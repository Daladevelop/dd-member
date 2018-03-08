@extends('layout.master')

@section('content')


        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        @if($event)
                            Redigera: {{$event->name}}
                        @else
                            Skapa nytt evenemang
                        @endif
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
                    <strong>Evenemangsinfo</strong>

                </div>
                <div class="block-content">
                    @if($event)
                        {{Form::model($event, ['url' => route('events.update', $event->id)] )}}
                    @else
                        {{Form::open()}}
                    @endif

                    <div class="form-group">
                        {{Form::label('name', 'Namn', ['class' => 'col-md-3'])}}
                        {{Form::text('name', null, ['form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('description', 'Beskrivning',['class' => 'col-md-3'])}}
                        {{Form::textarea('description', null, ['form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('start_date', 'Startdatum',['class' => 'col-md-3'])}}
                        {{Form::date('start_date', null, ['form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('end_date', 'Slutdatum',['class' => 'col-md-3'])}}
                        {{Form::date('end_date', null, ['form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('cost', 'Kostnad',['class' => 'col-md-3'])}}
                        {{Form::number('cost', null, ['form-control'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('max_participants', 'Max deltagare', ['class' => 'col-md-3'])}}
                        {{Form::number('max_participants',null,['form-control'] )}}
                    </div>
                        <div class="form-group">
                            {{Form::label('members_only', 'Endast medlemmar', ['class' => 'col-md-3'])}}
                            {{Form::checkbox('members_only', true)}}
                        </div>
                        <div class="col-md-offset-1 col-md-3"></div>
                        {{Form::submit('Skicka',['class' => 'btn btn-success'])}}

                    {{Form::close()}}
                </div>
            </div>
            <!-- END My Block -->
        </div>
        <!-- END Page Content -->

@endsection
