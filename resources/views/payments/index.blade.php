@extends('layout.master')

@section('content')


        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        Betalningar
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
                    <h3>Betalningar</h3>
                    @if(Bouncer::can('edit_payments'))
                        @if(Request::segment(2) == 'myPayments')
                        <p><a href="{{route('payments.index')}}">Visa alla betalningar</a></p>
                        @else
                        <p><a href="{{route('payments.myPayments')}}">Visa mina betalningar</a></p>
                        @endif
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Skapad</th>
                                <th>Medlem</th>
                                <th>Belopp</th>
                                <th>Typ</th>
                                <th>OCR</th>
                                <th>Betald?</th>
                                <th>Betald datum</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{$payment->created_at}}</td>
                                <td>{{$payment->user->name}}</td>
                                <td>{{$payment->amount}} kr</td>
                                <td>{{substr($payment->payable_type,4)}}</td>
                                <td>{{$payment->ocr}}</td>
                                <td>{{($payment->payment_date != null) ? 'Ja' : 'Nej' }}</td>
                                <td>{{$payment->payment_date}}</td>
                                
                                <td>
                                    @if(Bouncer::can('edit_payments'))
                                    <a href="#"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @if($payment->payment_date == null && Request::segment(2) == 'myPayments')
                                    <a href="{{ route('payments.pay', $payment->id) }}">Betala</a>
                                    @endif
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
