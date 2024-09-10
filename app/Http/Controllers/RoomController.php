<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Ebooking;
use Illuminate\Http\Request;
use Auth;
use App\Models\Role;
use App\Models\User;
use Laratrust\Models\LaratrustRole;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
     public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRoom()
    {
        return view('/Room/createRoom');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRoom(Request $request)
    {
        Room::create([
            'user_id' => auth()->id(),
            'bilik' => $request['bilik'],
            
        ]);
    
        return redirect()->route('list.Room')->with('alert', ' Nama Bilik Telah diwujudkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function showRoom(Room $room)
    {
        $users = Auth::user();
       
        if ($users->hasRole('admin') )  {
            
            $rooms = Room::orderBy('id', 'asc')
            ->paginate(20);
        
        }
        
        else {
        
        $rooms = Room::orderBy('id', 'asc')
        ->paginate(20);
        }

        return view ('/Room/listRoom', compact('users', 'rooms'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function editRoom($id)
    {
        $data = Room::find($id); 
        return view ('/Room/editRoom', ['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function updateRoom(Request $request, Room $room)
    {
        $data = Room::find($request->id);
        $data->bilik = $request->bilik;
        $data->save();

        return redirect('/Room/listRoom')->with('alert', 'Maklumat bilik telah dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */

    public function statistik(Request $request)
    {
        $user = Auth::user();
        $rooms = Room::all();
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $lokasi = $request->input('lokasiBilik');

        $selectedRoom = Room::where('bilik', $lokasi)->first(); // bilik query dlm room
    
        $tasksQuery = Ebooking::query()
            ->whereBetween('tarikhMula', [$start_date, $end_date])
            ->where('lokasi', $lokasi)
            ->orderBy('tarikhMula', 'asc');
    
        if ($user->hasRole('user')) {
            $tasksQuery->where('user_id', $user->id);
        }
    
        $tasks = $tasksQuery->get();
    
        // Prepare data for the chart
        $chartData = $tasks->groupBy(function($date) {
            return \Carbon\Carbon::parse($date->tarikhMula)->format('Y-m');
        })->map(function($row) {
            return $row->count();
        });
    
        return view('/Room/statistik', compact('user', 'tasks', 'rooms', 'chartData', 'selectedRoom'));
    }

    public function destroyRoom($id)
    {
        $rooms = Room::find($id);
        $rooms != null;
        $rooms->delete();

        return redirect('/Room/listRoom')->with('alert', 'Maklumat bilik telah dipadamkan.');
    }
}
