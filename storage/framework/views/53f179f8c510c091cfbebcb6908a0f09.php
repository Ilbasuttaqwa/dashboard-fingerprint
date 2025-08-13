<?php $__env->startSection('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Tambah Role Akses</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Tambah Role</h5>
                    <a href="<?php echo e(route('role.index')); ?>" class="btn btn-secondary">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('role.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="nama_jabatan" class="form-label">Nama Golongan</label>
                            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Masukkan nama golongan" required>
                        </div>
                        <div class="mb-3">
                            <label for="gaji" class="form-label">Gaji Golongan</label>
                            <input type="number" class="form-control" id="gaji" name="gaji" placeholder="Masukkan gaji golongan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hak Akses</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="dashboard" id="dashboard">
                                <label class="form-check-label" for="dashboard">Dashboard</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="golongan" id="golongan">
                                <label class="form-check-label" for="golongan">Golongan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="karyawan" id="karyawan">
                                <label class="form-check-label" for="karyawan">Karyawan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="penggajian" id="penggajian">
                                <label class="form-check-label" for="penggajian">Penggajian</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="absensi" id="absensi">
                                <label class="form-check-label" for="absensi">Absensi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="role" id="role">
                                <label class="form-check-label" for="role">Role Akses</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\role\create.blade.php ENDPATH**/ ?>