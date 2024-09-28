@extends('layouts.app')
@section('title', 'Trang chủ')

@section('content')
    <div class="container">
        <h1>Manufacturers List</h1>
        <a href="{{ route('manufacturers.create') }}" class="btn btn-primary mb-3">Add New Manufacturer</a>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($manufacturers as $manufacturer)
                    <tr>
                        <td>{{ $manufacturer->id }}</td>
                        <td>{{ $manufacturer->name }}</td>
                        <td>
                            <a href="{{ route('manufacturers.edit', $manufacturer->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('manufacturers.destroy', $manufacturer->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
