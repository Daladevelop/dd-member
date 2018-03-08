@extends('layout.master')

@section('content')


        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">

                        Medlemsförteckning
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
                    <a class="btn btn-success" href="{{route('users.create')}}"><i class="si si-user"></i> Skapa ny</a>

                </div>
                <div class="block-content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Namn</th>
                                <th>Ort</th>
                                <th>Epost</th>
                                <th>Telefonnummer</th>
                                <th>Verktyg</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->city}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{route('users.edit', $user->id)}}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-success" href="{{route('mail.create')}}?type=to-user&id={{$user->id}}" alt="Skicka mail"><i class="si si-envelope"></i></a>
                                </td>
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
