@extends('layout')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('items.store') }}">
        {{ csrf_field() }}
        <input type="hidden" name="box_id" value="{{ $box->id }}">

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name*</label>

            <div class="col-md-6">
                <input name="name" type="text" class="form-control" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label">Description</label>

            <div class="col-md-6">
                <input name="description" type="text" class="form-control" value="{{ old('description') }}">

                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('barcode') ? ' has-error' : '' }}">
            <label for="barcode" class="col-md-4 control-label">Barcode</label>

            <div class="col-md-6">
                <div class="input-group">
                    <input name="barcode" type="text" class="form-control" value="{{ old('barcode') }}" id="barcode-input">

                    <div class="input-group-btn">
                        <button class="btn btn-success" id="scan_button" type="button">Scan</button>
                    </div>
                </div>

                @if ($errors->has('barcode'))
                    <span class="help-block">
                        <strong>{{ $errors->first('barcode') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
            <label for="model" class="col-md-4 control-label">Model Number</label>

            <div class="col-md-6">
                <input name="model" type="text" class="form-control" value="{{ old('model') }}">

                @if ($errors->has('model'))
                    <span class="help-block">
                        <strong>{{ $errors->first('model') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('serial') ? ' has-error' : '' }}">
            <label for="serial" class="col-md-4 control-label">Serial Number</label>

            <div class="col-md-6">
                <input name="serial" type="text" class="form-control" value="{{ old('serial') }}">

                @if ($errors->has('serial'))
                    <span class="help-block">
                        <strong>{{ $errors->first('serial') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </div>
        </div>
    </form>

    <div class="stream_container" id="stream-container">
        <div class="stream" id="stream-playback"></div>
        <button class="btn btn-danger btn-block" onclick="scanner.stop()">Stop Scanning</button>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/scan.js') }}"></script>
    <link href="{{ asset('css/scanner.css') }}" rel="stylesheet" type="text/css">
@endsection
