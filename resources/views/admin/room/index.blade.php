<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Room Booking System</title>
</head>
<body>
<div class="container-fluid">
    <header class="text-center">
        <h1>List of Rooms</h1>
    </header>
    <br><br>
    <div class="card-body">
        <a class="btn btn-primary" href="{{ route('room.create') }}"> Create Room</a>
    </div>

    <section class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <tr>
                <th>S.N</th>
                <th>Name</th>
                <th>Availability</th>
                <th>Type</th>
                <th>Image</th>
                <th>Description</th>
                <th width="280px">Action</th>
            </tr>
            @if($rooms->isEmpty())
                <tr>
                    <td colspan="4">No Room found</td>
                </tr>
            @else
                @foreach ($rooms as $room)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->availability == 1 ? 'yes' : 'no' }}</td>
                        <td>{{$room->room_type}}</td>
                        <td><img src = "{{asset('storage/images/rooms/'. $room->image)}}" alt="Room" height="50px"/></td>
                        <td>{{ $room->description }}</td>
                        <td>
                            <form action="{{ route('room.destroy',$room->id) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('room.show',$room->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('room.edit',$room->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </section>
</div>
</body>
</html>
