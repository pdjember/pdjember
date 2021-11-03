 <!-- Footer -->
 <footer class="sticky-footer bg-white" id="page-bottom">
   <div class="container my-auto">
     <div class="copyright text-center my-auto">
       <span>Copyright &copy; Perisai Diri SMK Negeri 2 Jember <?= date('Y'); ?></span>
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
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">Anda akan meninggalkan halaman ini setelah klik tombol "Logout"</div>
       <div class="modal-footer">
         <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
         <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
       </div>
     </div>
   </div>
 </div>

 <!-- Bootstrap core JavaScript-->
 <script src="<?= base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>
 <script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="<?= base_url('assets'); ?> /js/multiple-select.min.js"></script>

 <!-- Map plugin JavaScript-->
 <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initialize" async defer></script>

 <!-- Core plugin JavaScript-->
 <script src="<?= base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>


 <!-- Tabel plugins -->
 <script src="<?= base_url('assets'); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
 <script src="<?= base_url('assets'); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
 <script src="<?= base_url('assets'); ?>/js/demo/datatables-demo.js"></script>

 <!-- Chart plugins -->
 <script src="<?= base_url('assets'); ?>/js/Chart.js"></script>
 <script src="<?= base_url('assets'); ?>/js/Chart.bundle.js"></script>
 <script src="<?= base_url('assets'); ?>/js/Chart.bundle.min.js"></script>
 <script src="<?= base_url('assets'); ?>/js/Chart.min.js"></script>

 <!-- Calendar plugins -->
 <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.js'></script>

 <!-- Script role access -->
 <script>
   $('.custom-file-input').on('change', function() {
     let fileName = $(this).val().split('\\').pop();
     $(this).next('.custom-file-label').addClass("selected").html(fileName);
   });

   $('.form-check-input').on('click', function() {
     const menuId = $(this).data('menu');
     const roleId = $(this).data('role');

     $.ajax({
       url: "<?= base_url('admin/ubahAccess'); ?>",
       type: 'post',
       data: {
         menuId: menuId,
         roleId: roleId
       },
       success: function() {
         document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
       }
     });
   });
 </script>

 <!-- Script Calendar -->
 <script>
   document.addEventListener('DOMContentLoaded', function() {
     var calendarEl = document.getElementById('calendar');
     var calendar = new FullCalendar.Calendar(calendarEl, {
       initialView: 'dayGridMonth',
       events: [
         <?php foreach ($jadwal as $data) { ?> {
             title: '<?= $data['kegiatan']; ?>',
             start: '<?= $data['mulai']; ?>',
             end: '<?= $data['selesai']; ?>'
           },
         <?php } ?>

       ],
       selectOverlap: function(event) {
         return event.rendering === 'background';
       }
     });

     calendar.render();
   });
 </script>

 </body>

 </html>