@extends('layouts.master')


@section('content')





<table class="table col-12 m-4">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">email</th>
        <th scope="col">password</th>
        <th scope="col">type</th>
        <th scope="col">allocated doc</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($users as $user )
                
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->password }}</td>
                <td>{{ $user->type == 1 ? 'reviewer' : 'registrar' }}</td>
                <td>@if ($user->type == 0)
                        @if ($user->document)
                          {{ $user->document->body }}
                        @else
                          <a href="{{ route('user.allocate' , $user->id) }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">allocate</a>
                        @endif
                @else
                  {{ '' }}  
                @endif</td>
            </tr>
        @endforeach
        
    </tbody>
  </table>



@endsection