@extends('layout')

@section('content')
    <h4 class="text-center">{{ $title }}</h4>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Item</th>
                <th>Description</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($box->items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>
                        <a class="btn btn-success btn-block" href="{{ route('items.show', ['item' => $item]) }}">View</a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3">
                    <a class="btn btn-success btn-block" href="{{ route('items.create', ['box' => $box]) }}">Create Items</a>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
