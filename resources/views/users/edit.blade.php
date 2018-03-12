@extends('layout.master')

@section('content')


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
            <div class="row">

                <div class="col-md-6">
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
                            @if(Auth::user()->can('edit_users'))
                                <div class="form-group">
                                    {{Form::label('member_type', 'Medlemstyp',['class' => 'col-md-3'])}}
                                    {{Form::select('member_type', ['Ordinarie'=>'Ordinarie','Student'=>'Student','Barn'=>'Barn'])}}
                                </div>
                            @endif
                            <div class="form-group">
                                {{Form::label('password', 'Lösenord', ['class' => 'col-md-3'])}}
                                {{Form::password('password',['form-control'] )}}
                            </div>
                            @if(Auth::user()->can('edit_users'))
                                <div class="form-group">
                                    {{Form::label('admin', 'Administratör', ['class' => 'col-md-3'])}}
                                    @if($user && Bouncer::is($user)->a('admin'))
                                        {{Form::checkbox('admin', null, ['checked'])}}
                                    @else
                                        {{Form::checkbox('admin', null)}}
                                    @endif
                                </div>
                            @endif
                            <div class="col-md-offset-1 col-md-3"></div>
                            {{Form::submit('Skicka',['class' => 'btn btn-success'])}}

                            {{Form::close()}}
                        </div>
                    </div>
                    <!-- END My Block -->
                </div>
                <div class="col-md-6">
                    @if(Auth::user()->can('edit_users'))
                        <div class="block">
                            <div class="block-header">
                                <strong>Metadata</strong>

                            </div>
                            <div class="block-content">
                                @if($user)
                                    <p><strong>Grupper: </strong>

                                   @foreach($user->groups as $group)
                                        <a class="label label-success" href="{{route('groups.edit',$group->id)}}"><i class="si si-users"></i> {{$group->name}}</a>
                                   @endforeach

                                    <p>
                                        <strong>Betalat för {{date('Y')}}: </strong>{{$user->hasPaidThisYearsMemberFee() ? 'Ja' : 'Nej'}}
                                        <!-- TODO: Länka till knapp för att sätta betalningsdatum -->
                                    </p>
                                @endif
                                </p>
                            </div>

                        </div>
                    @endif
                </div>
            </div>


        </div>
        <!-- END Page Content -->

@endsection
