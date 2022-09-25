<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Carbon\Carbon;

class RoomController extends Controller {

    public function index() {
        //get data from database with status '1' or active
        $data = Room::where( 'status', '1' )
        ->orderBy( 'location', 'asc' )
        ->get();

        return view( 'data_ruangan', compact( 'data' ) );
    }

    public function addRoom( Request $request ) {
        // Validation Form
        $add = $request->validate( [
            'room'      => 'required|max:255',
            'location'  => 'required|max:255',
        ] );

        // Process of adding Room
        Room::create( [
            'room'          => $add[ 'room' ],
            'location'      => $add[ 'location' ],
            'status'        => '1',
            'created_at'    => Carbon::now(),
        ] );

        $request->session();
        return back();
    }

    public function editRoom( Request $request, $id ) {
        // Validation Form
        $edit = $request->validate( [
            'room'      => 'required|max:255',
            'location'  => 'required|max:255',
        ] );

        // PROSES EDIT RUANGAN
        // Pencarian id yang akan di edit
        $editRoom = Room::find( $id );
        $editRoom->room = $request->room;
        $editRoom->location = $request->location;
        $editRoom->updated_at = Carbon::now();

        // Save perubahan
        $editRoom->save();

        return back();
    }

    public function delRoom( $id ) {
        $delRoom = Room::find( $id );
        $delRoom->status = '0';
        $delRoom->save();

        return back();
    }

}