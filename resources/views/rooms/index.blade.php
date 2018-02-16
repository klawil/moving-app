@extends('layout')

@section('content')
    <form method="POST" action="{{ route('rooms.store') }}">
        {{ csrf_field() }}

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Room Name</th>
                    <th>Boxes</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                    <tr>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->boxes->count() }}</td>
                        <td>
                            <a class="btn btn-success btn-block" href="{{ route('rooms.show', ['room' => $room]) }}">View</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                        <input type="text" class="form-control" name="name">
                    </td>
                    <td>
                        <input type="submit" class="btn btn-success btn-block" value="Create">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
@endsection
