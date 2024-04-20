@extends('layouts.app')

@section('content')
<body class="antialiased">
    <div class="card">
        <div class="card-header">{{ __('Get Started') }}</div>

        <div class="card-body">
            <h3>Log In to Our Site</h3>
            <h4>Continue as</h4>
            <form action="{{ url('customerLogin')}}" method="GET">
                <button name="user" type="submit" value="1" class="btn bg-primary font-weight-bold text-light">
                    Admin
                </button>
                <?$user=1?>
                @csrf
            </form>
            <form action="{{ route('register') }}" method="GET">
                <button name="user" type="submit" value="2" class="btn bg-primary font-weight-bold text-light">
                    driver
                </button>
                <?$user=2?>
                @csrf
            </form>
            <form action="{{  route('register') }}" method="GET">
                <button name="user" type="submit" value="3" class="btn bg-primary font-weight-bold text-light">
                    customer
                </button>
                <?$user=3?>
                @csrf
            </form>
        </div>
    </div>

    </div>
</body>
@endsection

</html>