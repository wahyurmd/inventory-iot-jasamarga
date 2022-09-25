<!-- Bootstrap core JavaScript-->
<script src="{{ asset('startbootstrap/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('startbootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('startbootstrap/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('startbootstrap/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('startbootstrap/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('startbootstrap/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('startbootstrap/js/demo/chart-pie-demo.js') }}"></script>

<!-- Script sweetalert2  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js"></script>

<!-- Script Font Awesome  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

<!-- Script for Generate Code and Image Preview -->
<script>
    function Generate() {
        var code = Math.floor(Math.random() * 100000) + '/' + Math.floor(Math.random() * 1000000) + '/' + Math.floor(Math.random() * 1000);
        document.getElementById('generate').value = code;
    }

    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

<!-- Script for sweetalert confirmation -->
<script>
    // For Add confirmation
    function addConfirm() {
        Swal.fire({
            icon: 'success',
            title: 'Great...',
            text: 'Added Successfully!',
            showCloseButton: true,
        });
    }

    // For edit confirmation
    function editConfirm(id) {
        Swal.fire({
            icon: 'success',
            title: 'Great...',
            text: 'Updated Successfully!',
            showCloseButton: true,
        });
    }
    
    // For delete confirmation
    function deleteConfirm(id) {
        Swal.fire({
            icon: 'success',
            title: 'Great...',
            text: 'Delete Successfully!',
            showCloseButton: true,
        });
    }
    
    // For transfer confirmation
    function transferConfirm(id) {
        Swal.fire({
            icon: 'success',
            title: 'Great...',
            text: 'Room Transfer Successful!',
            showCloseButton: true,
        });
    }
    
    // For restore inventory
    function restoreConfirm(id) {
        Swal.fire({
            icon: 'success',
            title: 'Update!!!',
            text: 'Inventory Successfully returned',
            showCloseButton: true,
        });
    }
</script>

@include('layouts.datatable')