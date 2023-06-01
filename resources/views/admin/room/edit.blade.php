<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Room booking system</title>
</head>
<body>
<div class="container-fluid">
    <header class="text-center">
        <h1>Edit room</h1>
    </header>
    <section class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{route('room.update',['id'=>$data->id])}}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{old('name',$data->name)}}">
            </div>
            <div class="form-group">
                <label for="room_type">Room type</label>
                <input type="text" class="form-control" id="room_type" placeholder="Room type must be among deluxe,suite,standard" name="room_type" value="{{old('room_type',$data->room_type)}}">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" value="{{old('price',$data->price)}}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="3" placeholder="Enter description"
                          name="description">{{$data->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" placeholder="Enter image" name="image" value="{{old('image',$data->image)}}">
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" name="availability" {{$data->availability == 1 ? 'checked' : ''}}>
                    <label class="form-check-label" for="gridCheck" >
                        Availability
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>
</div>

</body>
</html>
