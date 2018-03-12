@extends('layout.master')

@section('content')

        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        Medlemsavgifter
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
                    <a class="btn btn-success" href="{{route('memberfees.create')}}"><i class="si si-user"></i> Skapa ny</a>

                </div>
                <div class="block-content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>År</th>
                                <th>Avgift, ordinarie</th>
                                <th>Avgift, student</th>
                                <th>Avgift, barn</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($memberfees as $memberfee)
                            <tr>
                                <td>{{$memberfee->year}}</td>
                                <td>{{$memberfee->amount}}</td>
                                <td>{{$memberfee->amount_student}}</td>
                                <td>{{$memberfee->amount_child}}</td>
                                <td>{{$memberfee->number_paid()}} / {{$memberfee->payments->count()}} betalda</td>
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
