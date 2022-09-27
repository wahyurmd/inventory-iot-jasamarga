@extends('layouts.master')

@section('body')

<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- Page Heading -->
    <h1 class="h3 text-gray-800">Rooms Data</h1>
    <p class="mb-4">List of rooms in Jasamarga IoT Laboratory.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="d-sm-flex card-header py-3 justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Rooms Data Table</h6>
            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addRoomModal"><i class="fas fa-fw fa-plus"></i> Add Room</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display nowrap" id="roomtable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Room Name</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php
                        $no = 1;
                    @endphp
                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->room }}</td>
                            <td>{{ $row->location }}</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editRoomModal{{ $row->id }}"><i class="fas fa-fw fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteRoomModal{{ $row->id }}"><i class="fas fa-fw fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Room Modal-->
    <div class="modal fade" id="addRoomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Room</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('room') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <label class="control-label">Room Name</label>
                            <input type="text" class="form-control form-control-user" name="room" autocomplete="off" required>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <label class="control-label">Location Room</label>
                            <select name="location" class="form-control form-control-user selectpicker" title="Choose Location"required>
                                <option value="Lantai 1">Lantai 1</option>
                                <option value="Lantai 2">Lantai 2</option>
                            </select>
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
    
    <!-- Update Room Modal-->
    @foreach ($data as $row)
    <div class="modal fade" id="editRoomModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="room/edit/{{ $row->id }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <label class="control-label">Room Name</label>
                            <input type="text" class="form-control form-control-user" name="room" autocomplete="off" value="{{ $row->room }}" required>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <label class="control-label">Location Room</label>
                            <select name="location" class="form-control form-control-user selectpicker" title="Choose Location" required>
                                <option value="Lantai 1" @if ($row->location == 'Lantai 1') selected @endif>Lantai 1</option>
                                <option value="Lantai 2" @if ($row->location == 'Lantai 2') selected @endif>Lantai 2</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="{{ $row->id }}">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" onclick="editConfirm({{ $row->id }})">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Delete Room Modal-->
    @foreach ($data as $row)
    <div class="modal fade" id="deleteRoomModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="room/delete/{{ $row->id }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        Select "Delete" below if you are sure.
                        <input type="text" name="id" value="{{ $row->id }}">
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

</div>
<!-- /.container-fluid -->

@endsection