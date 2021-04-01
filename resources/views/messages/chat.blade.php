@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Mensajes del Chat</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif
    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>Id</th>
            <th>Chat User1</th>
            <th>Chat User2</th>
            <th>ID User Created Message</th>
            <th>Mensaje</th>
            <th>Sentido</th>
        </tr>
        @foreach ($user_message as $message)
            <tr>
                <td>{{$message->id}}</td>
                <td>{{$message->id_user1}}</td>
                <td>{{$message->id_user2}}</td>
                <td>{{$message->id_user}}</td>  
                <td>{{$message->mensaje}}</td>  
                <td>{{$message->sentido}}</td>  
            </tr>
        @endforeach
    </table>

    

@endsection