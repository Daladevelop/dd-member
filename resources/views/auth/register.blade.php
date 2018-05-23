@extends('auth.layout.master')

@section('content')

    <!-- Register Content -->
    <div class="content overflow-hidden">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                <!-- Register Block -->
                <div class="block block-themed animated fadeIn">
                    <div class="block-header bg-success">
                        <ul class="block-options">
                            <li>
                                <a href="#" data-toggle="modal" data-target="#modal-terms">Villkor och personuppgifter</a>
                            </li>
                            <li>
                                <a href="{{ url('/login') }}" data-toggle="tooltip" data-placement="left"
                                   title="Log In"><i class="si si-login"></i></a>
                            </li>
                        </ul>
                        <h3 class="block-title">Bli medlem</h3>
                    </div>
                    <div class="block-content block-content-full block-content-narrow">
                        <!-- Register Title -->
                        <h1 class="h2 font-w600 push-30-t push-5">{{ env('APP_NAME') }}</h1>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <p>Fyll i nedanstående fält för att bli medlem.</p>
                        <!-- END Register Title -->

                        <!-- Register Form -->
                        <!-- jQuery Validation (.js-validation-register class is initialized in js/pages/base_pages_register.js) -->
                        <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="js-validation-register form-horizontal push-50-t push-50"
                              action="{{ url('/register') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="text" id="name"
                                               name="name" placeholder="Ange ditt namn">
                                        <label for="name">För och efternamn</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="email" id="email"
                                               name="email" placeholder="Ange en epost">
                                        <label for="email">Epost</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="password" id="password"
                                               name="password" placeholder="Välj ett lösenord..">
                                        <label for="password">Lösenord</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="password" id="password_confirmation"
                                               name="password_confirmation" placeholder="..och upprepa det">
                                        <label for="password_confirmation">Upprepa lösenordet</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="text" id="personal_number"
                                               name="personal_number" placeholder="Personnummer, 10 siffror">
                                        <label for="personal_number">Personnummer</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="text" id="phone"
                                               name="phone" placeholder="Telefonnummer">
                                        <label for="phone">Telefonnummer</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="text" id="city"
                                               name="city" placeholder="Ort">
                                        <label for="city">Ort</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <select class="form-control" id="member_type"
                                               name="member_type">
                                            <option>Jag är:</option>
                                            <option value="Ordinarie">Över 20 år</option>
                                            <option value="Student">Mellan 13 och 20</option>
                                            <option value="Barn">Under 13 år</option>
                                        </select>
                                        <label for="personal_number">Medlemstyp</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label class="css-input switch switch-sm switch-success">
                                        <input type="checkbox" id="register-terms" name="register-terms"><span></span> Jag godkänner Daladevelops villkor samt ger mitt samtycke till att Daladevelop använder mina personuppgifter i syfte att föra register över sina medlemmar. Jag godkänner även att Daladevelop använder mina personuppgifter till att skicka epost till mig gällande föreningens verksamheter.
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12 col-sm-6 col-md-5">
                                    <button class="btn btn-block btn-success" type="submit"><i
                                                class="fa fa-plus pull-right"></i> Bli medlem
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- END Register Form -->
                    </div>
                </div>
                <!-- END Register Block -->
            </div>
        </div>
    </div>
    <!-- END Register Content -->
@endsection

@section('scripts')
    <!-- Terms Modal -->
    <div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title">Villkor</h3>
                    </div>
                    <div class="block-content">
                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Stäng</button>
                    <button class="btn btn-sm btn-primary" type="button" data-dismiss="modal"><i class="fa fa-check"></i> Jag godkänner</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Terms Modal -->
@endsection