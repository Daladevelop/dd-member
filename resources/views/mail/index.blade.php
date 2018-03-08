@extends('layout.master')

@section('content')


        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        Grupper
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
                    <a class="btn btn-success" href="{{route('groups.create')}}"><i class="si si-user"></i> Skapa ny</a>

                </div>
                <div class="block-content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Namn</th>
                                <th>Beskrivning</th>
                                <th>Antal medlemmar</th>
                                <th>Verktyg</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $group)
                            <tr>
                                <td>{{$group->name}}</td>
                                <td>{{$group->description}}</td>
                                <td>{{$group->member_count}}</td>
                                <td><a class="btn btn-warning" href="{{route('groups.edit', $group->id)}}"><i class="fa fa-edit"></i></a></td>
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
