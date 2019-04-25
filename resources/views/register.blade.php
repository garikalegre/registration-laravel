@extends('app')
@section('content')
    <div class="container bg-light py-3">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-body">
                    <h3 class="text-center mb-4">Register</h3>
                    @include('alerts.request')
                    @include('alerts.errors')
                    @include('alerts.success')

                    <fieldset>
                        <form action="{{route('registration.store')}}" method="POST">
                            <div class="form-group">
                                <input class="form-control input-lg" id="username" placeholder="Username" name="name"
                                       type="text"
                                       required>
                            </div>
                            <div class="alert alert-info" id="username-info" style="display: none"></div>
                            <button class="btn btn-sm btn-info my-1" id="check-username">Check username</button>
                            <div class="form-group">
                                <input class="form-control input-lg" placeholder="E-mail Address" name="email"
                                       type="email" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control input-lg" placeholder="Password" name="password" value=""
                                       type="password" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control input-lg" placeholder="Confirm Password" name="password"
                                       value="" type="password" required>
                            </div>

                            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-content')
    <script language="JavaScript">
        $(document).ready(function () {
            $('#check-username').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{route('check.username')}}',
                    dataType: 'json',
                    data: {
                        username: $('#username').val()
                    }
                }).done(function (msg) {
                    $('#username-info').show();
                    $('#username-info').text(msg);
                });
            });
        });
    </script>
@endsection
