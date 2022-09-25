@extends('layouts.master')

@section('body')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Room -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Room</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $roomCount }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Inventory -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Inventory</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $inventoryCount }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Inventory -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Borrowed Inventory</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $borrowedCount }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Log Transfer -->
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Log Transfer Room</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" id="logtransfer" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Inventory Code</th>
                                    <th>Inventory Name</th>
                                    <th>Previous Room</th>
                                    <th>Transfer Room</th>
                                    <th>Admin</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logtransfer as $log)
                                <tr>
                                    <td>{{ $log->inventory_code }}</td>
                                    <td>{{ $log->inventory_name }}</td>
                                    <td>{{ $log->previous_room }}</td>
                                    <td>{{ $log->room }}</td>
                                    <td>{{ $log->name }}</td>
                                    <td>{{ $log->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Log Delete Inventory -->
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Log Delete Inventory</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" id="logdelete" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Inventory Code</th>
                                    <th>Inventory Name</th>
                                    <th>Room</th>
                                    <th>Deleted By</th>
                                    <th>Deleted At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logdelete as $log)
                                <tr>
                                    <td>{{ $log->inventory_code }}</td>
                                    <td>{{ $log->inventory_name }}</td>
                                    <td>{{ $log->room }}</td>
                                    <td>{{ $log->name }}</td>
                                    <td>{{ $log->deleted_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Inventory Summary -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Inventory Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" id="ringkasan" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Inventory Code</th>
                                    <th>Inventory Name</th>
                                    <th>Room</th>
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
                                    <td>{{ $row->inventory_name }}</td>
                                    <td>{{ $row->room }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Room Summary -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Room Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" id="ringkasan2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Room Name</th>
                                    <th>Location</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($room as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->room }}</td>
                                    <td>{{ $row->location }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
    </div>

    <div class="row row-chart">
        <!-- Pie Chart -->
        <div class="col-xl-12 col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Total Inventory Chart of Each Room</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="piechart" class="chart-pie chart"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('startbootstrap/vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Room Name', 'Inventory Count'],
                <?php
                    echo $chartData;
                ?>
            ]);

            var options = {
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }

        $(window).resize(function(){
            drawChart();
        });
    </script>

</div>
<!-- /.container-fluid -->

@endsection