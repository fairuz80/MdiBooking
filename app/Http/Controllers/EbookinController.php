<?php

namespace App\Http\Controllers;

use App\Models\Ebooking;
use Illuminate\Http\Request;
use Auth;
use App\Models\Role;
use App\Models\User;
use App\Models\Room;
use Laratrust\Models\LaratrustRole;
use Carbon\Carbon;
use PDF;
use App\Mail\BookingCreated;
use App\Mail\BookingEdited;
use App\Mail\BookingAproval;
use App\Mail\BookingChangeDate;
use Illuminate\Support\Facades\Mail;

class EbookinController extends Controller
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
        $tasks = Ebooking::all();
        return view('/Booking/indexBooking', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::all();
        return view('/Booking/createBooking', ['rooms' => $rooms]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $startDate = Carbon::parse($request['tarikhMula']); // Parse to Carbon instance

        
    
        // Check if any existing booking overlaps with the requested date range, location, and session
        $error = Ebooking::where(function ($query) use ($startDate, $request) {
            $query->whereDate('tarikhMula', '=', $startDate->toDateString())
                  ->where('lokasi', '=', $request->lokasi)
                  ->where(function ($query) use ($request) {
                      if ($request->ext2 === 'Pagi Dan Petang') {
                          $query->whereIn('ext2', ['Pagi', 'Petang', 'Pagi Dan Petang']);
                      } else {
                          $query->where('ext2', '=', 'Pagi Dan Petang')
                                ->orWhere('ext2', '=', $request->ext2);
                      }
                  });
        })->exists();
    
        if ($error) {
            return redirect()->back()->with('alert', ' RALAT !! Tiada kekosongan untuk pilihan tarikh waktu atau lokasi');
        }
    
        $lampiranName = null;
        if ($request->hasFile('lampiran1')) {
            $file = $request->file('lampiran1');
            $maxSize = 200 * 1024; // 50KB in bytes

            if ($file->getSize() > $maxSize) {
                return redirect()->back()->with('alert', 'Fail dimuatnaik melebihi had 200KB');
            }
            $lampiranName = $request->lampiran1->getClientOriginalName();
            $request->lampiran1->move(public_path('lampiran/'), $lampiranName);
            
        }

        
        // Create new booking
        $ebooking = Ebooking::create([
            'user_id' => auth()->id(),
            'mesyuarat' => $request['mesyuarat'],
            'tarikhMula' => $startDate->toDateString(), 
            'lokasi' => $request['lokasi'],
            'ext2' => $request['ext2'],
            'pengerusi' => $request['pengerusi'],
            'makanan' => $request['makanan'],
            'minuman' => $request['minuman'],
            'bil_ahli' => $request['bil_ahli'],
            'nama_pemohon' => auth()->user()->name,
            'bahagian_pemohon' => auth()->user()->bahagian,
            'jawatan_pemohon' => auth()->user()->jawatan,
            'email_pemohon' => auth()->user()->email,
            'ext_pemohon' => auth()->user()->ext,
            'pengesahan_pemohon' => $request['pengesahan_pemohon'],
            'tarikh_pemohon' => $request['tarikh_pemohon'],
            'lampiran1' => $lampiranName,
            'sn' => random_int(1000, 9999),
            /* 'pengesahan_bkp' => $request['pengesahan_bkp'],
            'nama_bkp' => $request['nama_bkp'],
            'tarikh_bkp' => $request['tarikh_bkp'],
            'catatan_bkp' => $request['catatan_bkp'], */
        ]);

        $adminEmail = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->value('email');
    
        // Send email to the pemohon with cc to admin
        Mail::to($ebooking->email_pemohon)
            ->cc($adminEmail)
            ->send(new BookingCreated($ebooking));
    
        return redirect()->route('list.booking')->with('alert', ' Bilik telah berjaya ditempah');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ebooking  $ebooking
     * @return \Illuminate\Http\Response
     */
    public function show(Ebooking $ebooking)
    {
        $user = Auth::user();
        $rooms = Room::all();
        
        switch ($user )  {

        case $user->hasrole ('admin') :
        
        $ebookings = Ebooking::orderBy('id', 'desc')->paginate(10);
        //$posts = Post::all();

        break;

        case $user->hasrole ('user') :
        
            $ebookings = Ebooking::where('user_id', $user->id)->
            orderBy('id', 'desc')->paginate(10);
            //$posts = Post::all();

        break;

        default :

        break;

        }
        
        return view ('/Booking/listBooking', compact('user', 'ebookings', 'rooms'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ebooking  $ebooking
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ebookings = Ebooking::find($id);
        $rooms = Room::all(); 
        return view ('/Booking/editBooking', ['ebookings'=>$ebookings, 'rooms' => $rooms]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ebooking  $ebooking
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, Ebooking $ebooking)
    {
        $user = Auth::user();
        $startDate = Carbon::parse($request['tarikhMula']); // Parse to Carbon instance

        // Check if any existing booking overlaps with the requested date range, location, and session
        $error = Ebooking::where(function ($query) use ($startDate, $request) {
            $query->whereDate('tarikhMula', '=', $startDate->toDateString())
                  ->where('lokasi', '=', $request->lokasi)
                  ->where(function ($query) use ($request) {
                      if ($request->ext2 === 'Pagi Dan Petang') {
                          $query->whereIn('ext2', ['Pagi', 'Petang', 'Pagi Dan Petang']);
                      } else {
                          $query->where('ext2', '=', 'Pagi Dan Petang')
                                ->orWhere('ext2', '=', $request->ext2);
                      }
                  });
        })->exists();

        if ($error) {
            return redirect()->back()->with('alert', ' RALAT !! Tarikh, lokasi atau waktu yang dipilih telah ditempah || Tempahan telah mendapat kelulusan BKP');
        }

        
        // Find the existing booking record
        $ebooking = Ebooking::findOrFail($request->id);

        $path = public_path('lampiran/');
        $lampiranName = null;

        if ($request->hasFile('lampiran1')) {
            $file = $request->file('lampiran1');
            $maxSize = 200 * 1024; // 200KB in bytes

            if ($file->getSize() > $maxSize) {
                return redirect()->back()->with('alert', 'Fail dimuatnaik melebihi had 200KB');
            }

                // Delete the old file if it exists
                if($ebooking->lampiran1 != '' && $ebooking->lampiran1 != null){
                    $file_old = $path.$ebooking->lampiran1;
                    unlink($file_old);
                }

            $lampiranName = $file->getClientOriginalName();
            $file->move(public_path('lampiran/'), $lampiranName);
        }

        // Update the booking details
        $ebooking->update([
            'mesyuarat' => $request->mesyuarat,
            'tarikhMula' => $startDate->toDateString(),
            'lokasi' => $request->lokasi,
            'ext2' => $request->ext2,
            'pengerusi' => $request->pengerusi,
            'makanan' => $request->makanan,
            'minuman' => $request->minuman,
            'bil_ahli' => $request->bil_ahli,
            'nama_pemohon' => $request->nama_pemohon,
            'bahagian_pemohon' => $request->bahagian_pemohon,
            'jawatan_pemohon' => $request->jawatan_pemohon,
            'email_pemohon' => $request->email_pemohon,
            'ext_pemohon' => $request->ext_pemohon,
            'pengesahan_pemohon' => $request->pengesahan_pemohon,
            'tarikh_pemohon' => $request->tarikh_pemohon,
            'lampiran1' => $lampiranName,
            'sah_tukar' => $request->sah_tukar,            
            
        ]);

    // Retrieve the email address of the admin
    $adminEmail = User::whereHas('roles', function ($query) {
        $query->where('name', 'admin');
    })->value('email');

    // Send email to the pemohon with cc to admin
    Mail::to($ebooking->email_pemohon)
        ->cc($adminEmail)
        ->send(new BookingEdited($ebooking));

        return redirect()->route('list.booking')->with('alert', ' Tempahan bilik telah dikemaskini');
    }
    

    public function pengesahanBKP($id)
    {
        $ebookings = Ebooking::find($id); 
        return view ('/Booking/pengesahanBKP', ['ebookings'=>$ebookings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ebooking  $ebooking
     * @return \Illuminate\Http\Response
     */
    public function pengesahanBKP2(Request $request, Ebooking $ebooking)
    {
        $user = Auth::user();
        $startDate = Carbon::parse($request['tarikhMula']); // Parse to Carbon instance
        

        // Retrieve the existing booking record
        $ebooking = Ebooking::findOrFail($request->id);

        
            $ebooking->update([
                
                'mesyuarat' => $request->mesyuarat,
                'tarikhMula' => $startDate,
                'lokasi' => $request->lokasi,
                'ext2' => $request->ext2,
                'pengerusi' => $request->pengerusi,
                'makanan' => $request->makanan,
                'minuman' => $request->minuman,
                'bil_ahli' => $request->bil_ahli,
                'tarikh_pemohon' => $request->tarikh_pemohon,
                'pengesahan_bkp' => $request->pengesahan_bkp,
                'nama_bkp' => auth()->user()->name,
                'tarikh_bkp' => $request->tarikh_bkp,
                'catatan_bkp' => $request->catatan_bkp,
                'catatan_tukar' => $request->catatan_tukar,
                'lampiran1' => $request->lampiran1,
                'sah_tukar' => $request->sah_tukar,
            ]);
        

            $adminEmail = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->value('email');
        
            // Send email to the pemohon with cc to admin
            Mail::to($ebooking->email_pemohon)
                ->cc($adminEmail)
                ->send(new BookingAproval($ebooking));

        return redirect()->route('list.booking')->with('alert', ' Tempahan bilik telah disahkan');
    }

    public function changeEdit($id)
    {
        $ebookings = Ebooking::find($id);
        $rooms = Room::all(); 
        return view ('/Booking/changeBooking', ['ebookings'=>$ebookings, 'rooms' => $rooms]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ebooking  $ebooking
     * @return \Illuminate\Http\Response
     */
    
    public function changeUpdate(Request $request, Ebooking $ebooking)
    {
        $user = Auth::user();

        $startDate = Carbon::parse($request['tarikhMula']); // Parse to Carbon instance
        // Find the existing booking record
        $ebooking = Ebooking::findOrFail($request->id);

        
        // Update the booking details
        $ebooking->update([
            
            'mesyuarat' => $request->mesyuarat,
            'tarikhMula' => $startDate,
            'lokasi' => $request->lokasi,
            'ext2' => $request->ext2,
            'pengerusi' => $request->pengerusi,
            'makanan' => $request->makanan,
            'minuman' => $request->minuman,
            'bil_ahli' => $request->bil_ahli,
            'tarikh_pemohon' => $request->tarikh_pemohon,
            'mohon_tukar' => $request->mohon_tukar,
            'catatan_tukar' => $request->catatan_tukar,
            'lampiran1' => $request->lampiran1,
            'sah_tukar' => $request->sah_tukar,
        ]);

        $adminEmail = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->value('email');
    
        // Send email to the pemohon with cc to admin
        Mail::to($ebooking->email_pemohon)
            ->cc($adminEmail)
            ->send(new BookingChangeDate($ebooking));

        return redirect()->route('list.booking')->with('alert', ' Permohonan penukaran tarikh / bilik');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ebooking  $ebooking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ebookings = Ebooking::findOrFail($id);
        $ebookings->delete();
        if(\File::exists(public_path('lampiran/'.$ebookings->lampiran1))){
            \File::delete(public_path('lampiran/'.$ebookings->lampiran1));
            }
          
        return redirect()->back()->with('alert', 'Maklumat tempahan bilik telah dihapuskan');
    }

    public function reportBooking(Request $request, User $user)
    {
        $user = Auth::user();
        $start_dateA = $request->input('start_dateA'); // Format: 'YYYY-MM-DD'
        $end_dateB = $request->input('end_dateB'); // Format: 'YYYY-MM-DD'

        switch ($user) {
            case $user->hasRole( 'admin') :
                $tasks = Ebooking::query()
                ->where(function ($query) use ($start_dateA, $end_dateB) {
                    // Check if "tarikhMula" falls within the date range
                    $query->where('tarikhMula', '>=', $start_dateA)
                          ->where('tarikhMula', '<=', $end_dateB);
                })->orderBy('tarikhMula', 'desc')->get();
            break;

            case $user->hasRole( 'user') :
                $tasks = Ebooking::query()->where('user_id', $user->id)
                ->where(function ($query) use ($start_dateA, $end_dateB) {
                    // Check if "tarikhMula" falls within the date range
                    $query->where('tarikhMula', '>=', $start_dateA)
                          ->where('tarikhMula', '<=', $end_dateB);
                })->orderBy('tarikhMula', 'desc')->get();
            break;
                        
            default :
    
            break;
    
            }
            
            return view('/Booking/indexBooking', compact('user', 'tasks'));
    }

    public function searchIDBooking(Request $request, User $user)
    {
        $user = Auth::user();
        $search = $request->input('no_id');

        switch ($user) {
            case $user->hasRole( 'admin') :
                $tasks = Ebooking::query()
                ->where('sn', 'LIKE', "%{$search}%")
                ->orWhere('mesyuarat', 'LIKE', "%{$search}%")
                ->orderBy('id', 'desc')->get();
            break;

            case $user->hasRole( 'user') :
                $tasks = Ebooking::query()->where('user_id', $user->id)
                ->where('sn', 'LIKE', "%{$search}%")
                ->orWhere('mesyuarat', 'LIKE', "%{$search}%")
                ->orderBy('id', 'desc')->get();
            break;
                        
            default :
    
            break;
    
            }
            
            return view('/Booking/searchIDBooking', compact('user', 'tasks'));
    }

    public function calenderEvent(Request $request)
    {
        $user = Auth::user();
        $data = [];

        if ($request->ajax()) {
            switch (true) {
                case $user->hasRole('admin'):
                case $user->hasRole('user'):
                    $data = Ebooking::select('id', 'mesyuarat', 'tarikhMula', 'ext2')->orderBy('tarikhMula', 'desc')->get();
            return response()->json($data);
            }
        }

        return view('Booking.calenderEvent', compact('user'));
    }

    public function pdfbooking($id)
    {
        
        
        $data = Ebooking::find($id); 
        $pdf = PDF::loadView('/Booking/pdfBooking', ['data'=>$data])->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'chroot' => public_path()]);
        
        return $pdf->download('BookingMdi.pdf'); 
     
    }
}
