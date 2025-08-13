<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Absensi</h4>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><?php echo e(__('Dashboard')); ?></div>
                        <div class="card-body">
                            <form action="<?php echo e(route('laporan.filter')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="mb-4 form-group">
                                    <label for="jenisLaporan">Jenis Laporan</label>
                                    <select name="jenisLaporan" id="jenisLaporan" class="form-control">
                                        <option selected disabled>- Pilih Laporan -</option>
                                        <option value="pegawai">Pegawai</option>
                                        <option value="absensi">Absensi</option>
                                        <option value="penggajian">Penggajian</option>
                                    </select>
                                </div>
                                <div class="mb-4 form-group">
                                    <label for="tanggalAwal">Tanggal Awal</label>
                                    <input type="date" name="tanggalAwal" id="tanggalAwal" class="form-control">
                                </div>
                                <div class="mb-4 form-group">
                                    <label for="tanggalAkhir">Tanggal Akhir</label>
                                    <input type="date" name="tanggalAkhir" id="tanggalAkhir" class="form-control">
                                </div>
                                <div class="mb-4 form-group">
                                    <button type="button" class="btn rounded-pill btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#createModal">
                                        <i class="bi bi-person-fill-add" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="left" data-bs-html="true" title="Cari Filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filter Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                    <?php endif; ?>
                </div>
                <button>Bikin PDF</button>
                <button>Lihat PDF</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\laporan\index.blade.php ENDPATH**/ ?>