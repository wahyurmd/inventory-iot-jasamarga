<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Inventory;
use Carbon\Carbon;

class BorrowController extends Controller {

    public function index() {
        $inventory = Inventory::join( 'room', 'room.id', '=', 'inventory.room_id' )
        ->select( 'inventory.*', 'room.room', 'room.location' )
        ->where( 'inventory.status', '1' )
        ->where( 'inventory.stock_status', 'Available' )
        ->get();
        $borrow = Borrow::join( 'users', 'users.id', '=', 'borrow.user_id' )
        ->join( 'inventory', 'borrow.inventory_id', '=', 'inventory.id' )
        ->join( 'room', 'room.id', '=', 'inventory.room_id' )
        ->select( 'borrow.*', 'inventory.inventory_code', 'inventory.inventory_name', 'inventory.inventory_picture', 'room.room', 'room.location', 'users.name' )
        ->where( 'borrow.status', '1' )
        ->get();

        return view( 'data_peminjaman', compact( [
            'inventory',
            'borrow',
        ] ) );
    }

    public function addBorrowing( Request $request ) {
        // Validation Form
        $add = $request->validate( [
            'borrower_name'     => 'required|max:255',
            'borrower_unit'     => 'required|max:255',
            'borrower_number'   => 'required',
            'inventory_id'      => 'required',
            'user_id'           => 'required',
        ] );

        // Process of adding Borrowing
        Borrow::create( [
            'borrower_name'     => $add[ 'borrower_name' ],
            'borrower_unit'     => $add[ 'borrower_unit' ],
            'borrower_number'   => $add[ 'borrower_number' ],
            'inventory_id'      => $add[ 'inventory_id' ],
            'user_id'           => $add[ 'user_id' ],
            'inventory_id'      => $add[ 'inventory_id' ],
            'status'            => '1',
            'borrow_date'       => Carbon::now(),
        ] );

        // Update stock status
        $updateStockInventory = Inventory::find( $add[ 'inventory_id' ] );
        $updateStockInventory->stock_status = 'Not Available';
        $updateStockInventory->updated_at = Carbon::now();

        // Save update stock status
        $updateStockInventory->save();

        return back();
    }

    public function restoreBorrowing( Request $request, $id ) {
        // Update stock status on table inventory
        $updateStockInventory = Inventory::find( $request->inventory_id );
        $updateStockInventory->stock_status = 'Available';
        $updateStockInventory->save();

        // Update return date on table Borrow
        $updateReturnDate = Borrow::find( $id );
        $updateReturnDate->date_return = Carbon::now();
        $updateReturnDate->save();

        return back();
    }

}