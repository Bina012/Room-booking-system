<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::all();
        return view('admin.room.index',compact('rooms'));
    }

    public function create()
    {
       return view('admin.room.create');
    }


    public function store(RoomRequest $request)
    {
        $data = $request->validated();

        $data['availability'] = $request->filled('availability') ? 1 : 0;
        if($request->hasFile('image')){
            $destination_path = 'public/images/rooms';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path,$image_name);
            $data['image'] = $image_name;
        }
        $rooms = Room::create($data);
        if ($rooms) {
            $request->session()->flash('success', 'Room created successfully');
        } else {
            $request->session()->flash('error', 'Failed to create room');
        }
        return redirect()->route('room.index');
    }


    public function show($id)
    {
        $data = Room::find($id);
        return view('admin.room.show',compact('data'));
    }



    public function edit($id)
    {
        $data = Room::find($id);
        return view('admin.room.edit',compact('data'));
    }


    public function update(Request $request, $id)
    {
        $room = Room::find($id);

        $request->validate([
            'name' => 'required',
            'room_type' => 'required',
            'price' => 'required',
            'description' => 'required|min:10',
            'availability' => 'nullable',
        ]);
        $data = [
            'name' => $request->name,
            'room_type' => $request->room_type,
            'price' => $request->price,
            'description' => $request->description,
            'availability' => $request->filled('availability') ? 1 : 0,
        ];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs('public/images/rooms', $image_name);
            $data['image'] = $image_name;
        }

        $room->update($data);

        return redirect()->route('room.index')->with('success', 'Room updated successfully');
    }


    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('room.index')->with('success', 'Room deleted successfully');

    }
}
