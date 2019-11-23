@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">Appeals list</div>

                <div class="card-body">
                    @if (session()->has('messageSuccess'))
                        <div class="container text-center">
                            <span class="text-success">
                                <strong>{{ session()->get('messageSuccess') }}</strong>
                            </span>
                        </div>
                    @endif
                    <a href="/">Create</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Mail</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Message</th>
                                <th scope="col">Status</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete</th>
                                <th scope="col">History</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appeals as $appeal)
                            <tr>
                                <td scope="col">{{ $appeal->id }}</td>
                                <td scope="col">{{ $appeal->name }}</td>
                                <td scope="col">{{ $appeal->email }}</td>
                                <td scope="col">{{ $appeal->phone }}</td>
                                <td scope="col" class="word-break">{{ $appeal->message }}</td>
                                <td scope="col">{{ $appeal->status }}</td>
                                <td scope="col"><a href="{{ route('update', [$appeal->id]) }}">Update</a></td>
                                <td scope="col"><a href="{{ route('delete', [$appeal->id]) }}">Delete</a></td>
                                <td scope="col"><a href="{{ route('history', [$appeal->id]) }}">History</a></td>
                                <td scope="col"><a href="{{ route('changeStatus', [$appeal->id]) }}">Change</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
