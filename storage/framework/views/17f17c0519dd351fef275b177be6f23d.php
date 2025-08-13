<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-bold py-3">Detail Lokasi</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">Nama Lokasi</th>
                                    <td>: <?php echo e($cabang->nama_cabang); ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>: <?php echo e($cabang->alamat ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <th>Kode Lokasi</th>
                                    <td>: <?php echo e($cabang->kode_cabang); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h5 class="fw-bold">Daftar Karyawan</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Golongan</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($loop->index + 1); ?></td>
                                            <td><?php echo e($user->nama_pegawai); ?></td>
                                            <td><?php echo e($user->email); ?></td>
                                            <td><?php echo e($user->jabatan ? $user->jabatan->nama_jabatan : 'Tidak ada golongan'); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada karyawan di lokasi ini</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="<?php echo e(route('cabang.index')); ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        new DataTable('#example', {
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                zeroRecords: "Tidak ada data yang ditemukan",
                emptyTable: "Tidak ada data tersedia",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\cabang\show.blade.php ENDPATH**/ ?>