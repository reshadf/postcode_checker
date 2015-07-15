@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">

            <h1 class="col-md-offset-3">Postcode check</h1>

            <form class="form-horizontal" role="form" method="POST" action="{{ URL('/postcode/opzoeken') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="col-md-4 control-label">Postcode</label>

                    <div class="col-md-3">
                        <input type="text" class="form-control" name="numbers" value="{{ old('numbers') }}" placeholder="1234">
                    </div>
                    <div class="col-md-1">
                        <input type="text" class="form-control" name="letters" value="{{ old('letters') }}" placeholder="AB">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Huisnummer</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="housenr" value="{{ old('housenr') }}" placeholder="172">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">Opzoeken</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
