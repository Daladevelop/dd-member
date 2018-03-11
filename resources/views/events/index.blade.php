@extends('layout.master')

@section('content')


        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">

                        Evenemang
                    </h1>
                </div>

            </div>
        </div>
        <!-- END Page Header -->

        <!-- Page Content -->

        <div class="content">
            <div class="block">
                <div class="block-header">
                    <h3>Anmäld till följande evenemang:</h3>
                </div>
                <div class="block-content">
                    <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Namn</th>
                                    <th>Startar</th>
                                    <th>Slutar</th>
                                    <th>Kostnad</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($registrations as $registration)
                                <tr>
                                    <td><a href="{{ route('events.show', $registration->event_id) }}">{{$registration->event->name}}</a></td>
                                    <td>{{$registration->event->start_date}}</td>
                                    <td>{{$registration->event->end_date}}</td>
                                    <td>{{$registration->event->cost}}</td>
                                    <td><a href="{{ route('events.cancelSignup', $registration->event_id) }}">Avanmäl</a>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            <!-- My Block -->
            <div class="block">
                @if(Bouncer::can('edit_events'))
                <div class="block-header">
                    <a class="btn btn-success" href="{{route('events.create')}}"><i class="si si-calendar"></i> Skapa nytt</a>
                </div>
                @endif
                <div class="block-content">
                    <h3>Alla evenemang</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Namn</th>
                                <th>Beskrivning</th>
                                <th>Startar</th>
                                <th>Slutar</th>
                                <th>Kostnad</th>
                                <th>Max deltagare</th>
                                <th>Endast medlemmar</th>
                                <th></th>
                                @if(Bouncer::can('delete_events') || Bouncer::can('edit_events'))
                                <th></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{$event->name}}</td>
                                <td>{{$event->description}}</td>
                                <td>{{$event->start_date}}</td>
                                <td>{{$event->end_date}}</td>
                                <td>{{$event->cost}}</td>
                                <td>{{$event->max_participants}}</td>
                                <td>@if($event->members_only == 1) Ja @else Nej @endif</td>
                                <td>
                                        <a href="{{ route('events.signup',$event->id) }}">Anmäl</a>
                                </td>
                                @if(Bouncer::can('edit_events') || Bouncer::can('delete_events'))
                                <td>
                                    @if(Bouncer::can('edit_events'))
                                        <a href="{{route('events.edit', $event->id)}}"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @if(Bouncer::can('delete_events'))
                                    <a href="{{route('events.confirmDelete', $event->id)}}"><i class="fa fa-remove"></i></a>
                                    @endif
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END My Block -->
        </div>
        <!-- END Page Content -->


@endsection
