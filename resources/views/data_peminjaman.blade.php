@extends('layouts.master')

@section('body')

<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Borrowing Data</h1>
    <p class="mb-4">List of goods borrowing at Jasamarga IoT Laboratory.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="d-sm-flex card-header py-3 justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">History of Borrowing Data Table</h6>
            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addBorrowingModal"><i class="fas fa-fw fa-plus"></i> Add Borrowing</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display nowrap" id="borrowingtable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Borrowing Name</th>
                            <th>Borrowing Unit</th>
                            <th>Inventory Code</th>
                            <th>Inventory Name</th>
                            <th>Borrow Date</th>
                            <th>Return Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrow as $row)
                        <tr>
                            <td>{{ $row->borrower_name }}</td>
                            <td>{{ $row->borrower_unit }}</td>
                            <td>{{ $row->inventory_code }}</td>
                            <td>{{ $row->inventory_name }}</td>
                            <td>{{ $row->borrow_date }}</td>
                            <td>
                                @if ($row->date_return == NULL)
                                    --:--
                                @elseif ($row->date_return != NULL)
                                    {{ $row->date_return }}
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#detailBorrowingModal{{ $row->id }}"><i class="fas fa-fw fa-eye"></i></a>
                                <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#returnBorrowingModal{{ $row->id }}"><i class="fa-solid fa-arrow-right-arrow-left"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Borrowing Modal -->
    <div class="modal fade" id="addBorrowingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Borrowing Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('borrowing') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label class="control-label">Borrower Name</label>
                                <input type="text" class="form-control form-control-user" name="borrower_name" id="generate" autocomplete="off" required>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label class="control-label">Borrower Unit</label>
                                <input type="text" class="form-control form-control-user" name="borrower_unit" id="generate" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label class="control-label">Borrower Phone Number</label>
                                <input type="number" class="form-control form-control-user" name="borrower_number" id="generate" autocomplete="off" required>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label class="control-label">Select Inventory</label>
                                <select name="inventory_id" class="form-control form-control-user selectpicker" title="Choose Inventory from the List" data-live-search="true" required>
                                    @foreach ($inventory as $row)
                                        <option value="{{ $row->id }}" title="{{ $row->inventory_name }} | {{ $row->room }}">{{ $row->inventory_name }} | {{ $row->room }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <input type="hidden" class="form-control form-control-user" name="user_id" id="formFile" value="{{ Auth::user()->id }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" onclick="addConfirm()">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END: Add Borrowing Modal -->

    <!-- Detail Borrowing Modal -->
    @foreach ($borrow as $row)
    <div class="modal fade" id="detailBorrowingModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Detail Borrowing</strong></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 mb-3 row">
                        <div class="col-sm-3">
                            <label><strong>Borrower Name</strong></label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-8">
                            <label>{{ $row->borrower_name }}</label>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3 row">
                        <div class="col-sm-3">
                            <label><strong>Borrower Unit</strong></label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-8">
                            <label>{{ $row->borrower_unit }}</label>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3 row">
                        <div class="col-sm-3">
                            <label><strong> Number Phone</strong></label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-8">
                            <label>{{ $row->borrower_number }}</label>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3 row">
                        <div class="col-sm-3">
                            <label><strong>Borrowed Inventory Code</strong></label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-8">
                            <label>{{ $row->inventory_code }}</label>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3 row">
                        <div class="col-sm-3">
                            <label><strong>Borrowed Inventory</strong></label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-8">
                            <label>{{ $row->inventory_name }}</label>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3 row">
                        <div class="col-sm-3">
                            <label><strong>Borrowed Inventory Pictures</strong></label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-8">
                            <img src="{{ asset('storage/images/' . $row->inventory_picture) }}" alt="{{ $row->inventory_name }}" class="img-fluid col-sm-3">
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3 row">
                        <div class="col-sm-3">
                            <label><strong>Room</strong></label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-8">
                            <label>{{ $row->room }} | {{ $row->location }}</label>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3 row">
                        <div class="col-sm-3">
                            <label><strong>Admin</strong></label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-8">
                            <label>{{ $row->name }}</label>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3 row">
                        <div class="col-sm-3">
                            <label><strong>Borrow Date</strong></label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-8">
                            <label>{{ $row->borrow_date }}</label>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3 row">
                        <div class="col-sm-3">
                            <label><strong>Return Date</strong></label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-8">
                            <label>
                                @if ($row->date_return == NULL)
                                    --:--
                                @elseif ($row->date_return != NULL)
                                    {{ $row->date_return }}
                                @endif
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- END: Detail Borrowing Modal -->

    <!-- Return Inventory Modal -->
    @foreach ($borrow as $row)
    <div class="modal fade" id="returnBorrowingModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Restore Inventory</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="borrowing/restore/{{ $row->id }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        Select "Restore" to restore inventory.
                        <input type="hidden" name="id" value="{{ $row->id }}">
                        <input type="hidden" name="inventory_id" value="{{ $row->inventory_id }}">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" onclick="restoreConfirm({{ $row->id }})">Restore</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    <!-- END: Return Inventory Modal -->

</div>
<!-- /.container-fluid -->

@endsection