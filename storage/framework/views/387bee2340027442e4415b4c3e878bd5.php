<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-bold py-3">Form Tambah Lokasi</h5>
                    <div class="row">
                        <form action="<?php echo e(route('cabang.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="nama_cabang" class="form-label">Nama Lokasi</label>
                                <input type="text" class="form-control" name="nama_cabang" placeholder="Masukkan nama lokasi"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan alamat lokasi"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="kode_cabang" class="form-label">Kode Lokasi</label>
                                <input type="text" class="form-control" name="kode_cabang" placeholder="Masukkan kode lokasi"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                            <a href="<?php echo e(route('cabang.index')); ?>" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\cabang\create.blade.php ENDPATH**/ ?>