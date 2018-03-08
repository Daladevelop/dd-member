@extends('layout.master')

@section('content')


        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        Radera evenemang: {{$event->name}}
                    </h1>
                </div>

            </div>
        </div>
        <!-- END Page Header -->

        <!-- Page Content -->
        <div class="content">
            <!-- My Block -->
            <div class="block">
                <div class="block-content">
                    {{Form::model($event, ['url' => route('events.delete', $event->id), 'method' => 'DELETE'] )}}
                    {{Form::submit('Bekräfta borttagning',['class' => 'btn btn-danger'])}}
                    <p></p>
                </div>
            </div>
            <!-- END My Block -->
        </div>
        <!-- END Page Content -->

@endsection
