<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Absensi</h4>
        <div class="card">
            <?php if(isset($data) && count($data) > 0): ?>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <?php if($request->jenisLaporan == 'pegawai'): ?>
                                    <th>ID</th>
                                    <th>Nama Pegawai</th>
                                    <th>Jabatan</th>
                                <?php elseif($request->jenisLaporan == 'absensi'): ?>
                                    <th>ID</th>
                                    <th>Nama Pegawai</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                <?php elseif($request->jenisLaporan == 'penggajian'): ?>
                                    <th>ID</th>
                                    <th>Nama Pegawai</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah Gaji</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if($request->jenisLaporan == 'pegawai'): ?>
                                        <td><?php echo e($item->id); ?></td>
                                        <td><?php echo e($item->nama_pegawai); ?></td>
                                        <td><?php echo e($item->jabatan); ?></td>
                                    <?php elseif($request->jenisLaporan == 'absensi'): ?>
                                        <td><?php echo e($item->id); ?></td>
                                        <td><?php echo e($item->pegawai->nama_pegawai); ?></td>
                                        <!-- Asumsi ada relasi ke model Pegawai -->
                                        <td><?php echo e($item->tanggal_absen); ?></td>
                                        <td><?php echo e($item->status); ?></td>
                                    <?php elseif($request->jenisLaporan == 'penggajian'): ?>
                                        <td><?php echo e($item->id); ?></td>
                                        <td><?php echo e($item->pegawai->nama_pegawai); ?></td>
                                        <td><?php echo e($item->tanggal_gaji); ?></td>
                                        <td><?php echo e($item->jumlah_gaji); ?></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
        </div>
        <p>Tidak ada data yang ditemukan.</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\laporan\show.blade.php ENDPATH**/ ?>