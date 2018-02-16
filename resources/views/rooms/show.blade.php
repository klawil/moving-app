@extends('layout')

@section('content')
    <h4 class="text-center">{{ $title }}</h4>

    <form method="POST" action="{{ route('boxes.store') }}">
        {{ csrf_field() }}
        <input type="hidden" name="room_id" value="{{ $room->id }}">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Box</th>
                    <th>Items</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($room->boxes as $box)
                    <tr>
                        <td>{{ $box->room_box_number }}</td>
                        <td>{{ $box->description }}</td>
                        <td>{{ $box->items->count() }}</td>
                        <td>
                            <a class="btn btn-success btn-block" href="{{ route('boxes.show', ['box' => $box]) }}">View</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td colspan="2">
                        <input type="text" class="form-control" name="description">
                    </td>
                    <td>
                        <input type="submit" class="btn btn-success btn-block" value="Create">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
@endsection
