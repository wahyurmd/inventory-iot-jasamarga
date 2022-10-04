@extends('layouts.master')

@section('body')

<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Inventory Data</h1>
    <p class="mb-4">Inventory list at Jasamarga IoT Laboratory.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="d-sm-flex card-header py-3 justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Inventory Data Table</h6>
            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addInventoryModal"><i class="fas fa-fw fa-plus"></i> Add Inventory</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display nowrap" id="inventorytable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Inventory Code</th>
                            <th>Inventory Picture</th>
                            <th>Inventory Name</th>
                            <th>Room</th>
                            <th>Added By</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($inventory as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->inventory_code }}</td>
                            <td>
                                <img class="img-fluid" src="{{ asset('storage/images/' . $row->inventory_picture) }}" alt="{{ $row->inventory_name }}">
                            </td>
                            <td>{{ $row->inventory_name }}</td>
                            <td>{{ $row->room }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>
                                <div class="row justify-content-center">
                                    <a href="#" class="btn btn-primary btn-sm mr-1" data-toggle="modal" data-target="#detailInventoryModal{{ $row->id }}"><i class="fas fa-fw fa-eye"></i></a>
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#transferInventoryModal{{ $row->id }}"><i class="fa-solid fa-arrow-right-arrow-left"></i></a>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    <a href="#" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#editInventoryModal{{ $row->id }}"><i class="fas fa-fw fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteInventoryModal{{ $row->id }}"><i class="fas fa-fw fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Inventory Modal -->
    <div class="modal fade" id="addInventoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Inventory</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="inventory" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="col-sm-12 mb-3">
                            <label class="control-label">Inventory Code</label>
                            <p style="font-size: 12px; margin-top: -10px; color: rgb(255, 0, 0)"><i>If there is no Inventory Code, Click Generate!</i></p>
                            <div class="row" style="margin-top: -10px">
                                <div class="col-md-10 col-sm-10 mb-2">
                                    <input type="text" class="form-control form-control-user" name="inventory_code" id="generate" autocomplete="off" required>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <a class="btn btn-primary" onclick="Generate()">Generate</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label class="control-label">Inventory Name</label>
                            <input type="text" class="form-control form-control-user" name="inventory_name" autocomplete="off" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label class="control-label">Inventory Picture</label>
                            <img class="img-fluid img-preview mb-3 col-sm-3">
                            <input type="file" class="form-control" name="inventory_picture" id="image" onchange="previewImage()" required>
                            <p style="font-size: 12px; color: rgb(78, 78, 78)"><i>Note: can only format .png, .jpg, and .jpeg</i></p>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label class="control-label">Select Room</label>
                            <select name="room_id" class="form-control form-control-user" required>
                                <option value="" disabled>Choose Room</option>
                                @foreach ($room as $row)
                                    <option value="{{ $row->id }}">{{ $row->room }} | {{ $row->location }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label class="control-label">Description</label>
                            <input type="text" class="form-control form-control-user" name="description" autocomplete="off" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <input type="hidden" class="form-control form-control-user" name="user_id" id="formFile" value="{{ Auth::user()->id }}" required>
                            <input type="hidden" class="form-control form-control-user" name="stock_status" id="formFile" value="Available" required>
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
    <!-- END: Add Inventory Modal -->

    <!-- Update Inventory Modal -->
    @foreach ($inventory as $row)
    <div class="modal fade" id="editInventoryModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Inventory</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="inventory/edit/{{ $row->id }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-sm-12 mb-3">
                            <label class="control-label">Inventory Code</label>
                            <input type="text" class="form-control form-control-user" name="inventory_code" id="generate" value="{{ $row->inventory_code }}" autocomplete="off" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label class="control-label">Inventory Name</label>
                            <input type="text" class="form-control form-control-user" name="inventory_name" autocomplete="off" value="{{ $row->inventory_name }}" readonly>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label class="control-label">Inventory Picture</label>
                            <br>
                            @if ($row->inventory_picture)
                                <img src="{{ asset('storage/images/' . $row->inventory_picture) }}" alt="{{ $row->inventory_name }}" class="img-fluid col-sm-3 mb-3">
                            @endif
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label class="control-label">Room Location</label>
                            <input type="text" class="form-control form-control-user" name="room_id" autocomplete="off" value="{{ $row->room }} | {{ $row->location }}" readonly>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label class="control-label">Description</label>
                            <input type="text" class="form-control form-control-user" name="description" autocomplete="off" value="{{ $row->description }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" onclick="editConfirm({{ $row->id }})">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    <!-- END: Update Inventory Modal -->

    <!-- Detail Inventory Modal-->
    @foreach ($inventory as $row)
    <div class="modal fade" id="detailInventoryModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Inventory</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 mb-3 row">
                        <div class="col-sm-3">
                            <label>Inventory Code</label>
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
                            <label>Inventory Name</label>
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
                            <label>Inventory Picture</label>
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
                            <label>Room</label>
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
                            <label>Description</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-8">
                            <label>{{ $row->description }}</label>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3 row">
                        <div class="col-sm-3">
                            <label>Added By</label>
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
                            <label>Status</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-8">
                            @if ($row->stock_status == 'Available')    
                                <span class="btn btn-success disabled" style="min-width: 150px">{{ $row->stock_status }}</span>
                            @endif
                            @if ($row->stock_status == 'Not Available')    
                                <span class="btn btn-danger disabled" style="min-width: 150px">{{ $row->stock_status }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3 row">
                        <div class="col-sm-3">
                            <label>Created At</label>
                        </div>
                        <div class="col-sm-1">
                            <label>:</label>
                        </div>
                        <div class="col-sm-8">
                            <label>{{ $row->created_at }}</label>
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
    <!-- END: Detail Inventory Modal -->

    <!-- Delete Inventory Modal -->
    @foreach ($inventory as $row)
    <div class="modal fade" id="deleteInventoryModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="inventory/delete/{{ $row->id }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        Select "Delete" below if you are sure.
                        <input type="hidden" name="id" value="{{ $row->id }}">
                        <input type="hidden" name="room_id" value="{{ $row->room_id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" onclick="deleteConfirm({{ $row->id }})">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    <!-- END: Delete Inventory Modal -->

    <!-- Transfer Room Inventory Modal -->
    @foreach ($inventory as $row)
    <div class="modal fade" id="transferInventoryModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transfer Room</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="inventory/transfer/{{ $row->id }}" method="POST">
                    @csrf
                    <div class="col-sm-12 mb-3">
                            <label class="control-label">Previous Room</label>
                            <input type="text" class="form-control form-control-user" name="previous_room" autocomplete="off" value="{{ $row->room }}" readonly>
                        </div>
                    <div class="col-sm-12 mb-3">
                        <label class="control-label">Transfer to</label>
                        <select name="transfer_room_id" class="form-control form-control-user" required>
                            <option disabled>Choose Room</option>
                            @foreach ($room as $data)
                                <option value="{{ $data->id }}">{{ $data->room }} | {{ $data->location }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <input type="hidden" class="form-control form-control-user" name="inventory_id" id="formFile" value="{{ $row->id }}">
                        <input type="hidden" class="form-control form-control-user" name="user_id" id="formFile" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" onclick="transferConfirm({{ $row->id }})">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    <!-- END: Transfer Room Inventory Modal -->

</div>
<!-- /.container-fluid -->

@endsection