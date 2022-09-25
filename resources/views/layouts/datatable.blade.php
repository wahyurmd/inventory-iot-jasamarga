<!-- Data Table scripts -->
{{-- <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script> --}}
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

<!-- call datatable for rooms -->
<script>
    $(document).ready(function() {
        $('#roomtable').DataTable( {
            dom: 'Bfrtip',
            order: [[2, 'asc']],
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            buttons: [
                'pageLength',
                {
                    extend: 'excelHtml5',
                    title: "Room Data at Jasamarga IoT Laboratory",
                    exportOptions: {
                        columns: [0, 1, 2]
                    },
                },
                {
                    extend: 'pdfHtml5',
                    title: "Room Data at Jasamarga IoT Laboratory",
                    text: "PDF Export",
                    exportOptions: {
                        columns: [0, 1, 2]
                    },
                },
                {
                    extend: 'print',
                    title: "Room Data at Jasamarga IoT Laboratory",
                    exportOptions: {
                        columns: [0, 1, 2]
                    },
                },
            ]
        } );
    } );
</script>

<!-- call datatable for inventory -->
<script>
    $(document).ready(function() {
        $('#inventorytable').DataTable( {
            responsive: true,
            dom: 'Bfrtip',
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            buttons: [
                'pageLength',
                {
                    extend: 'excelHtml5',
                    title: "Inventory Data at Jasamarga IoT Laboratory",
                    exportOptions: {
                        columns: [0, 1, 3, 4, 5, 6]
                    },
                },
                {
                    extend: 'pdfHtml5',
                    title: "Inventory Data at Jasamarga IoT Laboratory",
                    text: "PDF Export",
                    exportOptions: {
                        columns: [0, 1, 3, 4, 5, 6]
                    },
                },
                {
                    extend: 'print',
                    title: "Inventory Data at Jasamarga IoT Laboratory",
                    exportOptions: {
                        columns: [0, 1, 3, 4, 5, 6]
                    },
                },
            ]
        } );
    } );
</script>

<!-- call datatable for peminjaman -->
<script>
    $(document).ready(function() {
        $('#borrowingtable').DataTable( {
            order: [[4, 'desc']],
            responsive: true,
            dom: 'Bfrtip',
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            buttons: [
                'pageLength',
                {
                    extend: 'excelHtml5',
                    title: "Borrowing Data at Jasamarga IoT Laboratory",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                },
                {
                    extend: 'pdfHtml5',
                    title: "Borrowing Data at Jasamarga IoT Laboratory",
                    text: "PDF Export",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                },
                {
                    extend: 'print',
                    title: "Borrowing Data at Jasamarga IoT Laboratory",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                },
            ]
        } );
    } );
</script>

<!-- call datatable for Dashboard Inventory -->
<script>
    $(document).ready(function() {
        $('#ringkasan').DataTable();
    } );
</script>

<!-- call datatable for Dashboard Room -->
<script>
    $(document).ready(function() {
        $('#ringkasan2').DataTable();
    } );
</script>

<!-- call datatable for Dashboard Log Transfer -->
<script>
    $(document).ready(function() {
        $('#logtransfer').DataTable({
            order: [[5, 'desc']]
        });
    } );
</script>

<!-- call datatable for Dashboard Log Delete-->
<script>
    $(document).ready(function() {
        $('#logdelete').DataTable({
            order: [[4, 'desc']]
        });
    } );
</script>