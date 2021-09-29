</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Tracking Mail App {{ date('Y') }}</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Anda yakin ingin logout?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="{{ url('logout') }}">Logout</a>
            </div>
        </div>
    </div>
</div>

{{-- Data User --}}
<div class="data-user d-none">
    <div class="id-user">{{ session('user-data')->id }}</div>
    <div class="nama-user">{{ session('user-data')->nama }}</div>
    <div class="role-user">{{ session('user-data')->role }}</div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailleModalLabel">Detail Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm text-justify" style="width: 100%">
                    <tr>
                        <td>Pengirim</td>
                        <td class="text-center">:</td>
                        <td class="detail-pengirim">Pengirim</td>
                    </tr>
                    <tr>
                        <td>Penerima</td>
                        <td class="text-center">:</td>
                        <td class="detail-penerima">Penerima</td>
                    </tr>
                    <tr>
                        <td>Subjek</td>
                        <td class="text-center">:</td>
                        <td class="detail-subjek">Subjek</td>
                    </tr>
                    <tr>
                        <td>Pesan</td>
                        <td class="text-center">:</td>
                        <td class="detail-pesan" style="white-space: pre">Pesan</td>
                    </tr>
                    <tr>
                        <td>File</td>
                        <td class="text-center">:</td>
                        <td class="detail-file">File</td>
                    </tr>
                    <tr>
                        <td>Dibaca</td>
                        <td class="text-center">:</td>
                        <td class="detail-dibaca">Dibaca</td>
                    </tr>
                    <tr>
                        <td>Dikirim pada</td>
                        <td class="text-center">:</td>
                        <td class="detail-dikirim-pada">Pesan</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>

@include('layouts.flashdata')

<!-- Bootstrap core JavaScript-->
<script src="{{ url('') }}/vendor/jquery/jquery.min.js"></script>
<script src="{{ url('') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{ url('') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugins -->
<script src="{{ url('') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{ url('') }}/js/sb-admin-2.min.js"></script>
<script src="{{ url('') }}/js/sweetalert2@11.js"></script>
<script src="{{ url('') }}/js/iziToast.min.js"></script>
<script src="{{ url('') }}/js/myscript.js"></script>

</body>

</html>
