@extends('layout.master')

@section('content')

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        @if($user)
                            Redigera: {{$user->name}}
                        @else
                            Skapa ny användare
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
                    <strong>Användarinfo</strong>

                </div>
                <div class="block-content">
                    @if($user)
                        {{Form::model($user, ['url' => route('users.update', $user->id)] )}}
                    @else
                        {{Form::open()}}
                    @endif

                    <div class="form-group">
                        {{Form::label('name', 'Namn', ['class' => 'col-md-3'])}}
                        {{Form::text('name', null, ['form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('email', 'E-post',['class' => 'col-md-3'])}}
                        {{Form::text('email', null, ['form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('phone', 'Telefonnummer',['class' => 'col-md-3'])}}
                        {{Form::text('phone', null, ['form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('city', 'Ort',['class' => 'col-md-3'])}}
                        {{Form::text('city', null, ['form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('personal_number', 'Personnummer',['class' => 'col-md-3'])}}
                        {{Form::text('personal_number', null, ['form-control'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('password', 'Lösenord', ['class' => 'col-md-3'])}}
                        {{Form::password('password',['form-control'] )}}
                    </div>
                    @if(Auth::user()->can('edit_users'))
                        <div class="form-group">
                            {{Form::label('admin', 'Administratör', ['class' => 'col-md-3'])}}
                            {{Form::checkbox('admin', true)}}
                        </div>
                    @endif
                        <div class="col-md-offset-1 col-md-3"></div>
                        {{Form::submit('Skicka',['class' => 'btn btn-success'])}}

                    {{Form::close()}}
                </div>
            </div>
            <!-- END My Block -->
            @if($user)
                <div class="block">
                    <div class="block-header">
                        <strong>Grupper</strong>
                    </div>
                    <div class="block-content">
                        @foreach($user->groups as $group)
                            <p>{{$group->name}}</p>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

@endsection
