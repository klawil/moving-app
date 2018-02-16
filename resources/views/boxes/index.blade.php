@extends('layout')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Label</th>
                <th>Description</th>
                <th>Items</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($boxes as $box)
                <tr>
                    <td>{{ $box->room->name . ' ' . $box->room_box_number }}</td>
                    <td>{{ $box->description }}</td>
                    <td>{{ $box->items->count() }}</td>
                    <td>
                        <a class="btn btn-success btn-block" href="{{ route('boxes.show', ['box' => $box]) }}">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
