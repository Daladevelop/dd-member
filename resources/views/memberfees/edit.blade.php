@extends('layout.master')

@section('content')


        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        @if($memberfee)
                            Redigera medlemsavgift: {{$memberfee->year}}
                        @else
                            Skapa nytt medlemsavgiftsår
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
                    <strong>Information</strong>

                </div>
                <div class="block-content">
                    @if($memberfee)
                        {{Form::model($memberfee, ['url' => route('memberfees.update', $memberfee->id)] )}}
                    @else
                        {{Form::open()}}
                    @endif

                    <div class="form-group">
                        {{Form::label('year', 'År', ['class' => 'col-md-3'])}}
                        {{Form::text('year', null, ['form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('amount', 'Belopp, ordinarie',['class' => 'col-md-3'])}}
                        {{Form::text('amount', null, ['form-control'])}}
                    </div>
                    <div class="form-group">
                            {{Form::label('amount_student', 'Belopp, student',['class' => 'col-md-3'])}}
                            {{Form::text('amount_student', null, ['form-control'])}}
                        </div>
                        <div class="form-group">
                                {{Form::label('amount_child', 'Belopp, barn',['class' => 'col-md-3'])}}
                                {{Form::text('amount_child', null, ['form-control'])}}
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
        </div>
        <!-- END Page Content -->


@endsection
