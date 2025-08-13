<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <h3 class="mb-4">Daftar Izin Sakit</h3>

        <!-- Tampilkan notifikasi jika tidak ada izin sakit -->
        <?php if($izinSakitCount == 0): ?>
            <div class="alert alert-info" role="alert">
                Belum ada izin sakit.
            </div>
        <?php endif; ?>

        <!-- Daftar izin sakit -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0">Data Izin Sakit</h5>
            </div>
            <div class="card-body">
                <?php if($izinSakit->isEmpty()): ?>
                    <p class="text-muted">Tidak ada data izin sakit.</p>
                <?php else: ?>
                    <table class="table table-bordered table-hover text-nowrap text-center">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Surat Sakit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $absensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($data->user->nama_pegawai); ?></td>
                                    <td class="align-items-center">
                                        <!-- Gambar diperbesar -->
                                        <?php if($data->photo): ?>
                                            <!-- Tombol Lihat Selengkapnya di sebelah kanan -->
                                            <button type="button" class="btn btn-outline-primary btn-sm ms-auto align-items-center" data-bs-toggle="modal" data-bs-target="#photoModal<?php echo e($data->id); ?>">
                                                <i class='bx bx-show me-1'></i> Lihat Selengkapnya
                                            </button>
                                            
                                            

                                            <!-- Modal Lihat Selengkapnya -->
                                            <div class="modal fade" id="photoModal<?php echo e($data->id); ?>" tabindex="-1" aria-labelledby="photoModalLabel<?php echo e($data->id); ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="photoModalLabel<?php echo e($data->id); ?>">Surat Sakit</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="<?php echo e(asset('uploads/' . $data->photo)); ?>" alt="Surat Sakit" class="img-fluid rounded">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted">Tidak ada surat sakit</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\user\izin\sakit.blade.php ENDPATH**/ ?>