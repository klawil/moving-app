@extends('layout')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Box</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->box->room->name . ' ' . $item->box->room_box_number }}</td>
                    <td>
                        <a class="btn btn-success btn-block" href="{{ route('items.show', ['item' => $item]) }}">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
