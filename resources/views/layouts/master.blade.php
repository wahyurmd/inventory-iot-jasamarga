<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body>

    <!-- Page Wrapper -->
    <div id="wrapper">
        
        @include('layouts.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
             <!-- Main Content -->
            <div id="content">
                
                @include('layouts.topbar')

                @yield('body')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <strong>Jasa Marga IoT Laboratory</strong> 2022. All Right Reserved</span>
                        <br>
                        <span>Developed by PMMB Batch 1 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- End of Scroll to Top Button-->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.script')
    
</body>
</html>