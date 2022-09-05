		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		</div>
		<footer class="footer footer-black  footer-white ">
		    <div class="container-fluid">
		        <div class="row">
		            <nav class="footer-nav">
		            </nav>
		            <div class="credits ml-auto">
		                <span class="copyright">
		                    Development By <a href="#">TIM Research Final Project Student of Informatics USK </a> © Copyright
		                    <script>
		                        document.write(new Date().getFullYear())
		                    </script>
		                </span>
		            </div>
		        </div>
		    </div>
		</footer>
		<script src="<?php echo base_url('assets/js/app.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/theme/default.min.js'); ?>"></script>
		<!-- ================== END BASE JS ================== -->
		<!-- ================== BEGIN PAGE LEVEL JS ================== -->
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
		<script src="<?php echo base_url('assets/plugins/pdfmake/build/pdfmake.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/plugins/pdfmake/build/vfs_fonts.js'); ?>"></script>
		<script src="<?php echo base_url('assets/plugins/jszip/dist/jszip.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/demo/table-manage-buttons.demo.js'); ?>"></script>

		<!-- v1 -->
		<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.js'); ?>"></script>
		<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.time.js'); ?>"></script>
		<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.resize.js'); ?>"></script>
		<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.pie.js'); ?>"></script>
		<script src="<?php echo base_url('assets/plugins/jquery-sparkline/jquery.sparkline.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/plugins/jvectormap-next/jquery-jvectormap.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js'); ?>"></script>
		<script src="<?php echo base_url('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/demo/dashboard.js'); ?>"></script>
		<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->

		<!-- icons  -->
		<script src="<?php echo base_url('assets/plugins/highlight.js/highlight.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/demo/render.highlight.js'); ?>"></script>

		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>
		    let el_confirm_delete = document.querySelectorAll(".confirm-delete")
		    if (el_confirm_delete.length > 0) {
		        el_confirm_delete.forEach(el => {
		            el.addEventListener("submit", (e) => {
		                e.preventDefault()

		                Swal.fire({
		                    title: 'Apakah anda yakin?',
		                    text: "Data yang dihapus tak dapat kembali",
		                    icon: 'warning',
		                    showCancelButton: true,
		                    confirmButtonColor: '#3085d6',
		                    cancelButtonColor: '#d33',
		                    confirmButtonText: 'Ya, hapus!',
		                    cancelButtonText: 'Tidak',
		                }).then((result) => {
		                    if (result.isConfirmed) {
		                        Swal.fire(
		                            'Terhapus!',
		                            'Data berhasil dihapus',
		                            'success'
		                        )

		                        setTimeout(() => {
		                            el.submit()
		                        }, 1000)
		                    }
		                })
		            })
		        })
		    }

		    on(`[role="tablist"] [role="tab"]`, "click", (e, _this) => {
		        e.preventDefault()
		        _this.closest(`[role="tablist"]`).querySelectorAll(`[role="tab"].active`).forEach(el => {
		            el.classList.remove("active")
		        });
		        _this.classList.add("active")
		        _this.getAttribute("href")

		        document.querySelector(_this.closest(`[role="tablist"]`).getAttribute("data-content")).querySelectorAll(`[role="tabpanel"].show`).forEach(el => {
		            el.classList.remove("active")
		            el.classList.remove("show")
		        })

		        document.querySelector(_this.getAttribute("href")).classList.add("active", "show")
		    })
		</script>

		<?php
        $this->session->set_flashdata('notif', '');
        ?>
		</body>

		</html>
