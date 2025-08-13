<?php $__env->startSection('content'); ?>
    
    <?php if(session('error')): ?>
        <div class="bs-toast toast toast-placement-ex m-2 bg-danger top-0 end-0 fade show toast-custom" role="alert"
            aria-live="assertive" aria-atomic="true" id="toastError">
            <div class="toast-header">
                <i class="bx bx-error me-2"></i>
                <div class="me-auto fw-semibold">Error</div>
                <small>Just Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?php echo e(session('error')); ?>

            </div>
        </div>
    <?php endif; ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Laporan /</span> Laporan Pegawai</h4>
        <div class="card">
            <div class="card-header">
                <form action="<?php echo e(route('laporan.pegawai')); ?>" method="GET">
                    <div class="row">
                        <div class="col-4">
                            <input type="date" class="form-control" name="tanggal_awal"
                                value="<?php echo e(request('tanggal_awal')); ?>">
                        </div>
                        <div class="col-4">
                            <input type="date" class="form-control" name="tanggal_akhir"
                                value="<?php echo e(request('tanggal_akhir')); ?>">
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary form-control" type="submit">Filter</button>
                        </div>
                        <div class="col-2">
                            <a href="<?php echo e(route('laporan.pegawai')); ?>" class="btn btn-danger form-control"
                                type="submit">Reset</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-9">
                            <select id="jabatan" name="jabatan" class="form-control">
                                <option class="text-center" value="" disabled
                                    <?php echo e(request('jabatan') ? '' : 'selected'); ?>>
                                    -- Pilih Jabatan--
                                </option>
                                <?php $__currentLoopData = $jabatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($data->id); ?>"
                                        <?php echo e(request('jabatan') == $data->id ? 'selected' : ''); ?>>
                                        <?php echo e($data->nama_jabatan); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-3">
                            <a href="<?php echo e(route('laporan.pegawai')); ?>" class="btn btn-danger form-control"
                                type="submit">Reset Filter Jabatan</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <select id="provinsi" name="provinsi" class="form-control">
                                <option value="" selected disabled>-- Pilih Provinsi --</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select id="kota" name="kota" class="form-control">
                                <option value="" selected disabled>-- Pilih Kota --</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select id="kecamatan" name="kecamatan" class="form-control">
                                <option value="" selected disabled>-- Pilih Kecamatan --</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select id="kelurahan" name="kelurahan" class="form-control">
                                <option value="" selected disabled>-- Pilih Kelurahan --</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="row mt-3">
                    <?php if(!$pegawai->isEmpty()): ?>
                        <div class="col-4">
                            <button id="lihatPdfButton" class="btn btn-secondary form-control" data-bs-toggle="modal"
                                data-bs-target="#pdfModal">Lihat PDF</button>
                        </div>
                        <div class="col-4">
                            <a href="<?php echo e(route('laporan.pegawai', ['download_pdf' => true, 'tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir'), 'jabatan' => request('jabatan')])); ?>"
                                class="btn btn-info form-control">Buat PDF</a>
                        </div>
                        <div class="col-4">
                            <a href="<?php echo e(route('laporan.pegawai', ['download_excel' => true, 'tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir'), 'jabatan' => request('jabatan')])); ?>"
                                class="btn btn-success form-control" type="submit">Buat EXCEL</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <?php if($pegawai->isEmpty()): ?>
                    <div class="alert alert-warning" role="alert">
                        Tidak ada data pegawai ditemukan untuk tanggal yang dipilih atau jabatan yang dipilih.
                    </div>
                <?php else: ?>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pegawai</th>
                                    <th>Jabatan</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Umur</th>
                                    <th>Email</th>
                                    <th>Gaji</th>
                                    <!-- <th>Di Tempatkan</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                ?>
                                <?php $__currentLoopData = $pegawai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($item->is_admin == 0): ?>
                                        <tr>
                                            <td><?php echo e($no++); ?></td>
                                            <td><?php echo e($item->nama_pegawai); ?></td>
                                            <td><?php echo e($item->jabatan ? $item->jabatan->nama_jabatan : 'Tidak ada jabatan'); ?>

                                            </td>
                                            <td><?php echo e(\Carbon\Carbon::parse($item->tanggal_masuk)->translatedFormat('d F Y')); ?>

                                            </td>
                                            <td><?php echo e($item->umur); ?></td>
                                            <td><?php echo e($item->email); ?></td>
                                            <td><?php echo e('Rp ' . number_format($item->gaji, 0, ',', '.')); ?></td>
                                            
                                            <!-- <td> -->
                                                <!-- <?php echo e($item->nama_provinsi . ', ' . $item->nama_kota . ', ' . $item->nama_kecamatan . ', ' . $item->nama_kelurahan); ?> -->
                                                <!-- <?php echo e($item->nama_provinsi ?? 'Provinsi tidak diketahui'); ?>, -->
                                                <!-- <?php echo e($item->nama_kota ?? 'Kota tidak diketahui'); ?>, -->
                                                <!-- <?php echo e($item->nama_kecamatan ?? 'Kecamatan tidak diketahui'); ?>, -->
                                                <!-- <?php echo e($item->nama_kelurahan ?? 'Kelurahan tidak diketahui'); ?> -->
                                            <!-- </td> -->

                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal untuk melihat PDF -->
    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Lihat PDF - Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfFrame" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.getElementById('lihatPdfButton').addEventListener('click', function() {
            // Ambil tanggal awal dan tanggal akhir dari request
            var tanggalAwal = '<?php echo e(request('tanggal_awal')); ?>';
            var tanggalAkhir = '<?php echo e(request('tanggal_akhir')); ?>';
            var jabatan = '<?php echo e(request('jabatan')); ?>';

            // Buat URL untuk iframe
            var url = "<?php echo e(route('laporan.pegawai', ['view_pdf' => true])); ?>" +
                "&tanggal_awal=" + tanggalAwal +
                "&tanggal_akhir=" + tanggalAkhir +
                "&jabatan=" + jabatan;

            // Set URL ke iframe
            document.getElementById('pdfFrame').src = url;
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\laporan\pegawai.blade.php ENDPATH**/ ?>