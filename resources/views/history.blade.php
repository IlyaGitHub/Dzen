@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">History of changes appeal № {{ $id }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">UserName</th>
                                <th scope="col">AppealId</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appealsChanges as $сhange)
                            <tr>
                                <td scope="col">{{ $сhange->id }}</td>
                                <td scope="col">{{ $сhange->user->name }}</td>
                                <td scope="col">{{ $сhange->appeal->id }}</td>
                                <td scope="col">{{ $сhange->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        <a href="{{ route('home') }}">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
