<!DOCTYPE html>
<html>
<head>
    <title>Monkey Business - Create Client</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" >Monkey Business</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ URL::to('home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL::to('clients') }}">Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL::to('events') }}">Events</a>
                </li>
            </ul>
        </div>
        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>
<div class="container">
    <br>
    {!! Form::open(array('url' => 'clients'))  !!}

    <div class="form-group @if ($errors->has('firstname')) has-danger @endif">
        {!! Form::label('firstname', 'First Name', array('class' =>'control-label'))  !!}
        @if ($errors->has('firstname')) <div class="form-control-feedback">{{ $errors->first('firstname') }}</div> @endif
        {!! Form::text('firstname', Input::old('firstname'), array('class' => 'form-control form-control-danger')) !!}
    </div>

    <div class="form-group @if ($errors->has('lastname')) has-danger @endif">
        {!! Form::label('lastname', 'Last Name', array('class' =>'control-label'))  !!}
        @if ($errors->has('lastname')) <div class="form-control-feedback">{{ $errors->first('lastname') }}</div> @endif
        {!! Form::text('lastname', Input::old('lastname'), array('class' => 'form-control form-control-danger')) !!}
    </div>

    <div class="form-group @if ($errors->has('email')) has-danger @endif">
        {!! Form::label('email', 'E-mail', array('class' =>'control-label'))  !!}
        @if ($errors->has('email')) <div class="form-control-feedback">{{ $errors->first('email') }}</div> @endif
        {!! Form::email('email', Input::old('email'), array('class' => 'form-control form-control-danger')) !!}
    </div>

    <div class="form-group @if ($errors->has('phone')) has-danger @endif">
        {!! Form::label('phone', 'Phone', array('class' =>'control-label'))  !!}
        @if ($errors->has('phone')) <div class="form-control-feedback">{{ $errors->first('phone') }}</div> @endif
        {!! Form::text('phone', Input::old('phone'), array('class' => 'form-control form-control-danger')) !!}
    </div>

    <div class="form-group @if ($errors->has('city')) has-danger @endif">
        {!! Form::label('city', 'City', array('class' =>'control-label'))  !!}
        @if ($errors->has('city')) <div class="form-control-feedback">{{ $errors->first('city') }}</div> @endif
        {!! Form::text('city', Input::old('city'), array('class' => 'form-control form-control-danger')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('company', 'Company')  !!}
        {!! Form::text('company', Input::old('company'), array('class' => 'form-control')) !!}
    </div>

    {!! Form::submit('Create a client', array('class' => 'btn btn-secondary')) !!}
    {!! Form::close()  !!}
</div>
</body>
</html>