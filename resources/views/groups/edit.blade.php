@extends('layout.master')

@section('content')


        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        @if($group)
                            Redigera: {{$group->name}}
                        @else
                            Skapa ny grupp
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
                    <strong>Gruppinformation</strong>

                </div>
                <div class="block-content">
                    @if($group)
                        {{Form::model($group, ['url' => route('groups.update', $group->id)] )}}
                    @else
                        {{Form::open()}}
                    @endif

                    <div class="form-group">
                        {{Form::label('name', 'Namn', ['class' => 'col-md-3'])}}
                        {{Form::text('name', null, ['form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('description', 'Beskrivning',['class' => 'col-md-3'])}}
                        {{Form::text('description', null, ['form-control'])}}
                    </div>
                    <div class="col-md-offset-1 col-md-3"></div>
                    {{Form::submit('Spara',['class' => 'btn btn-success'])}}

                    {{Form::close()}}
                </div>
                <div class="block-footer">
                    &nbsp;
                </div>
            </div>
            <!-- END My Block -->
            @if($group)
                <div class="block">
                    <div class="block-header">
                        <strong>Gruppmedlemmar</strong>
                    </div>
                    <div class="block-content">


                        @foreach($group->users as $user)
                            <a href="{{route('groups.removemember',[ $group->id, $user->id])}}" class="label label-danger"><i class="si si-close"></i> {{$user->name}}</a>
                        @endforeach
                        <hr/>
                        {!! Form::open(['route' => ['groups.addmember', $group->id]]) !!}
                        <p><strong>Lägg till användare i grupp</strong></p>
                        <div class="col-md-3">

                            {!! Form::select('user_id', $users ,null, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('Lägg till',['class' => 'btn']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div class="block-footer">
                        &nbsp;
                    </div>
                </div>
            @endif
        </div>
        <!-- END Page Content -->


@endsection
