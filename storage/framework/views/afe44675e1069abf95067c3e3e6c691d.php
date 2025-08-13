<!-- Modal Pindah Golongan -->
<div class="modal fade" id="pindahGolonganModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="bi bi-arrow-left-right me-2"></i>Pindah Golongan Karyawan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Informasi:</strong> Pilih golongan dan lokasi tujuan untuk memindahkan karyawan dari golongan <strong><?php echo e($jabatan->nama_jabatan); ?></strong>.
                </div>

                <div class="table-responsive">
                    <table class="table table-hover" id="pindahGolonganTable">
                        <thead>
                            <tr>
                                <th>Nama Karyawan</th>
                                <th>Cabang</th>
                                <th>Email</th>
                                <th>Golongan Tujuan</th>
                                <th>Lokasi Tujuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $pegawai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $karyawan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-2">
                                            <div class="avatar-initial bg-primary rounded-circle">
                                                <?php echo e(substr($karyawan->nama_pegawai, 0, 1)); ?>

                                            </div>
                                        </div>
                                        <div>
                                            <strong><?php echo e($karyawan->nama_pegawai); ?></strong>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo e($karyawan->cabang->nama_cabang ?? '-'); ?></td>
                                <td><?php echo e($karyawan->email); ?></td>
                                <td>
                                    <select class="form-select form-select-sm golongan-tujuan"
                                            name="golongan_tujuan_<?php echo e($karyawan->id); ?>">
                                        <option value="">Pilih Golongan</option>
                                        <?php $__currentLoopData = $allJabatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jabatan_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($jabatan_option->id); ?>"><?php echo e($jabatan_option->nama_jabatan); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select form-select-sm cabang-tujuan"
                                            name="cabang_tujuan_<?php echo e($karyawan->id); ?>">
                                        <option value="">Pilih Lokasi</option>
                                        <?php $__currentLoopData = $cabangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cabang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cabang->id); ?>"><?php echo e($cabang->nama_cabang); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary pindah-individual"
                                            data-karyawan-id="<?php echo e($karyawan->id); ?>"
                                            data-karyawan-nama="<?php echo e($karyawan->nama_pegawai); ?>">
                                        <i class="bi bi-arrow-right"></i> Pindah
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#pindahGolonganTable').DataTable({
        language: {
            search: "Cari Karyawan:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        pageLength: 5
    });

    // Individual transfer
    $(document).on('click', '.pindah-individual', function() {
        const karyawanId = $(this).data('karyawan-id');
        const karyawanNama = $(this).data('karyawan-nama');
        const golonganTujuan = $(`select[name="golongan_tujuan_${karyawanId}"]`).val();
        const golonganNama = $(`select[name="golongan_tujuan_${karyawanId}"] option:selected`).text();
        const cabangTujuan = $(`select[name="cabang_tujuan_${karyawanId}"]`).val();
        const cabangNama = $(`select[name="cabang_tujuan_${karyawanId}"] option:selected`).text();

        if (!golonganTujuan) {
            alert('Pilih golongan tujuan terlebih dahulu!');
            return;
        }

        if (!cabangTujuan) {
            alert('Pilih lokasi tujuan terlebih dahulu!');
            return;
        }

        if (confirm(`Pindahkan ${karyawanNama} ke golongan ${golonganNama} di lokasi ${cabangNama}?`)) {
            pindahKaryawan([karyawanId], golonganTujuan, cabangTujuan);
        }
    });



    function pindahKaryawan(karyawanIds, golonganTujuan, cabangTujuan) {
        console.log('Starting pindahKaryawan with data:', {
            karyawan_ids: karyawanIds,
            golongan_tujuan: golonganTujuan,
            cabang_tujuan: cabangTujuan,
            golongan_asal: <?php echo e($jabatan->id); ?>

        });
        
        $.ajax({
            url: '<?php echo e(route("jabatan.pindah-karyawan")); ?>',
            method: 'POST',
            dataType: 'json',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                karyawan_ids: karyawanIds,
                golongan_tujuan: golonganTujuan,
                cabang_tujuan: cabangTujuan,
                golongan_asal: <?php echo e($jabatan->id); ?>

            },
            beforeSend: function() {
                console.log('Sending AJAX request...');
            },
            success: function(response) {
                console.log('Response received:', response);
                if (response.success) {
                    alert('Karyawan berhasil dipindahkan!');
                    location.reload();
                } else {
                    alert('Terjadi kesalahan: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error Details:');
                console.log('XHR:', xhr);
                console.log('Status:', status);
                console.log('Error:', error);
                console.log('Response Text:', xhr.responseText);
                console.log('Status Code:', xhr.status);
                
                let errorMessage = 'Terjadi kesalahan saat memindahkan karyawan!';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.status === 419) {
                    errorMessage = 'CSRF Token expired. Silakan refresh halaman.';
                } else if (xhr.status === 422) {
                    errorMessage = 'Data tidak valid. Periksa kembali input Anda.';
                }
                alert(errorMessage);
            }
        });
    }
});
</script>
<?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\jabatan\modals\pindah-golongan.blade.php ENDPATH**/ ?>