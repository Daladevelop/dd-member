@extends('layout.master')

@section('content')


        @include('partials.message')
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        Betala för {{$payment->payable->name}}
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
                    
                </div>
                <div class="block-content">
                    <p><b>Belopp att betala: {{$payment->amount}} kr</b></p>
                    <p>
                        Alternativ 1) Swisha medlemsavgiften till nummer 123 521 70 62.
                        <br/>
                        Alternativ 2) Betala medlemsavgiften till bankgiro 714-2243.
                    </p>
                    <p>
                        Märk din betalning med <b>"Betalning {{$payment->id}}"</b>
                    </p>
                    <h3>Bekräfta din betalning:</h3><br/>
                    {{Form::open()}}
                    Jag bekräftar att jag har betalt in eller omgående betalar in <b>{{ $payment->amount }} kr</b><br/>
                    {{Form::submit('Bekräfta',['class' => 'btn btn-success'])}}
                    {{Form::close()}}
                    <br/>
                </div>
                <div class="block-footer">
                    &nbsp;
                </div>
            </div>
            <!-- END My Block -->

        </div>
        <!-- END Page Content -->


@endsection
