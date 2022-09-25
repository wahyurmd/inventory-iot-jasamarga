<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Inventory;
use App\Models\Borrow;
use App\Models\Log;
use App\Models\LogDelete;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {

    public function index() {
        $roomCount = Room::where( 'status', '1' )->count( 'room' );
        $inventoryCount = Inventory::where( 'status', '1' )->count( 'inventory_code' );
        $borrowedCount = Borrow::where( 'date_return', NULL )->count( 'id' );
        $room = Room::where( 'status', '1' )->get();
        $inventory = Inventory::join( 'room', 'inventory.room_id', '=', 'room.id' )
        ->join( 'users', 'inventory.user_id', '=', 'users.id' )
        ->where( 'inventory.status', '1' )
        ->where( 'room.status', '1' )
        ->get();
        $logtransfer = Log::join( 'inventory', 'log.inventory_id', '=', 'inventory.id' )
        ->join( 'room', 'log.transfer_room', '=', 'room.id' )
        ->join( 'users', 'log.user_id', '=', 'users.id' )
        ->select( 'log.*', 'room.room', 'inventory.inventory_code', 'inventory.inventory_name', 'room.location', 'users.name' )
        ->where( 'log.status', '1' )
        ->get();
        $logdelete = LogDelete::join( 'inventory', 'log_delete.inventory_id', '=', 'inventory.id' )
        ->join( 'room', 'log_delete.room_id', '=', 'room.id' )
        ->join( 'users', 'log_delete.user_id', '=', 'users.id' )
        ->select( 'log_delete.*', 'inventory.inventory_code', 'inventory.inventory_name', 'room.room', 'users.name' )
        ->get();

        $result = DB::select( DB::raw( 'select count(inventory_name) as inventory_name, room.room from inventory LEFT JOIN room ON room.id = inventory.room_id WHERE inventory.status=1 GROUP BY room.room' ) );

        $data = '';
        foreach ( $result as $key ) {
            $data .= "['".$key->room."', ".$key->inventory_name.'],';
        }

        $chartData = $data;

        return view( 'dashboard', compact( [
            'roomCount',
            'inventoryCount',
            'borrowedCount',
            'room',
            'inventory',
            'logtransfer',
            'logdelete',
            'chartData',
        ] ) );
    }

}