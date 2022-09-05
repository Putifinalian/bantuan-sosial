      <?php if ($this->session->flashdata('success')) : ?>
          <script>
              Swal.fire({
                  title: 'Notifikasi!',
                  text: '<?php echo $this->session->flashdata('success') ?>',
                  imageUrl: '<?= base_url('assets/img/svg/files-sent-animate.svg') ?>',
                  imageWidth: 400,
                  imageHeight: 250,
                  imageAlt: 'Custom image',
              });
          </script>
      <?php endif; ?>
