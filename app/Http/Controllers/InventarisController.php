<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Inventory;
use App\Models\Log;
use App\Models\LogDelete;
use Carbon\Carbon;

class InventarisController extends Controller {

    public function index() {
        $room = Room::where( 'status', '1' )
        ->orderBy( 'location', 'asc' )
        ->get();
        $inventory = Inventory::join( 'room', 'inventory.room_id', '=', 'room.id' )
        ->join( 'users', 'inventory.user_id', '=', 'users.id' )
        ->select( 'inventory.*', 'users.id as id_user', 'users.name', 'room.room', 'room.location' )
        ->where( 'inventory.status', '1' )
        ->where( 'room.status', '1' )
        ->get();

        return view( 'data_inventaris', compact( [
            'room',
            'inventory',
        ] ) );
    }

    public function addInventory( Request $request ) {
        // Validation Form
        $add = $request->validate( [
            'inventory_code'    => 'required|max:255',
            'inventory_name'    => 'required|max:255',
            'inventory_picture' => 'required|image|mimes:png,jpg,jpeg',
            'room_id'           => 'required',
            'user_id'           => 'required',
            'description'       => 'required|max:255',
            'stock_status'      => 'required|max:255',
        ] );

        // Create Unique Filename
        $nameImage = $add[ 'inventory_picture' ]->hashName();

        // Save Process to local 'storage/app/public' folder with folder name '/iamges'
        $request->inventory_picture->store( 'images', 'public' );

        // Process of adding Inventory
        Inventory::create( [
            'inventory_code'    => $add[ 'inventory_code' ],
            'inventory_name'    => $add[ 'inventory_name' ],
            'inventory_picture' => $nameImage,
            'room_id'           => $add[ 'room_id' ],
            'user_id'           => $add[ 'user_id' ],
            'description'       => $add[ 'description' ],
            'stock_status'      => $add[ 'stock_status' ],
            'status'            => '1',
            'created_at'        => Carbon::now(),
        ] );

        return back();
    }

    public function editInventory( Request $request, $id ) {
        // Validation Form
        $edit = $request->validate( [
            'inventory_code'    => 'required|max:255',
            'description'       => 'required|max:255',
        ] );

        // PROSES EDIT Inventory
        $editInventory = Inventory::find( $id );
        $editInventory->inventory_code = $request->inventory_code;
        $editInventory->description = $request->description;
        $editInventory->updated_at = Carbon::now();

        // Save perubahan
        $editInventory->save();

        return back();
    }

    public function delInventory( Request $request, $id ) {
        $delInventory = Inventory::find( $id );
        $delInventory->status = '0';
        $delInventory->save();

        LogDelete::create( [
            'inventory_id'  => $id,
            'room_id'       => $request->room_id,
            'user_id'       => $request->user_id,
            'deleted_at'    => Carbon::now(),
        ] );

        return back();
    }

    public function transferInventory( Request $request, $id ) {
        // PROSES TRANSFER RUANGAN
        Log::create( [
            'inventory_id'  => $request->inventory_id,
            'previous_room' => $request->previous_room,
            'transfer_room' => $request->transfer_room_id,
            'user_id'       => $request->user_id,
            'status'        => '1',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ] );

        // Pencarian id yang akan di edit dan proses edit ruangan di tabel inventory
        $transferRoom = Inventory::find( $id );
        $transferRoom->room_id = $request->transfer_room_id;
        $transferRoom->updated_at = Carbon::now();

        // Save perubahan
        $transferRoom->save();

        return back();
    }

}