@extends('layouts.master')


@section('content')





<table class="table col-12 m-4">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">body</th>
        <th scope="col">finished</th>
        <th scope="col">allocated to</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($documents as $documents )
                
            <tr>
                <th scope="row">{{ $documents->id }}</th>
                <td>{{ $documents->body }}</td>
                <td>{{ $documents->finished == 1 ? 'finished' : 'not finished' }}</td>
                <td>{{ $documents->user ? $documents->user->name : '' }}</td>
            </tr>
        @endforeach
        
    </tbody>
  </table>



@endsection