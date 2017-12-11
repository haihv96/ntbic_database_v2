@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('sso.login') }}">
                            {{ csrf_field() }}
                            <input hidden name="return_url"
                                   value="{{ url()->current() }}"/>
                            <div class="form-group{{ isset($errors->email) ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" class="form-control" name="email"
                                           value="{{ isset($email) ? $email : '' }}" autofocus>

                                    @if (isset($errors->email))
                                        <span class="help-block">
                                        <strong>{{ $errors->email['0'] }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ isset($errors->password) ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if (isset($errors->password))
                                        <span class="help-block">
                                        <strong>{{ $errors->password['0'] }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
