<?php $__env->startSection('title', 'Tambah Bon'); ?>

<?php $__env->startSection('css'); ?>
<style>
    .content-wrapper {
        min-height: 100vh !important;
        background: #f5f5f9 !important;
    }
    
    .card {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: none;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4" style="min-height: calc(100vh - 120px);">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-plus me-2"></i>Tambah Bon</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('keuangan.bon.store')); ?>" method="POST" id="bonForm">
                        <?php echo csrf_field(); ?>

                        <div class="text-center mb-4">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-money-bill fs-3 text-primary"></i>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">
                                <i class="fas fa-user me-1"></i>Pilih Pegawai
                            </label>
                            <select name="pegawai_id" class="form-control <?php $__errorArgs = ['pegawai_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">-- Pilih Pegawai --</option>
                                <?php $__currentLoopData = $pegawais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pegawai): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($pegawai->id); ?>" <?php echo e(old('pegawai_id') == $pegawai->id ? 'selected' : ''); ?>>
                                        <?php echo e($pegawai->nama_pegawai); ?> - <?php echo e($pegawai->jabatan->nama_jabatan); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['pegawai_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">
                                <i class="fas fa-money-bill-wave me-1"></i>Jumlah Bon
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-primary text-white fw-bold">Rp</span>
                                <input type="number" name="jumlah" class="form-control <?php $__errorArgs = ['jumlah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('jumlah')); ?>" required min="1" step="1000" placeholder="Masukkan jumlah bon">
                            </div>
                            <?php $__errorArgs = ['jumlah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">
                                <i class="fas fa-calendar me-1"></i>Tanggal
                            </label>
                            <input type="date" name="tanggal" class="form-control <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('tanggal', date('Y-m-d'))); ?>" required>
                            <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">
                                <i class="fas fa-comment me-1"></i>Keterangan
                            </label>
                            <textarea name="keterangan" class="form-control <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                      rows="3" required placeholder="Masukkan keterangan bon"><?php echo e(old('keterangan')); ?></textarea>
                            <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="alert alert-info border-0">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Info:</strong> Bon akan otomatis disetujui setelah disimpan.
                        </div>
                    </form>
                </div>
                <div class="card-footer border-0">
                    <div class="d-flex justify-content-between">
                        <a href="<?php echo e(route('keuangan.bon.index')); ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" form="bonForm" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Simpan Bon
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\keuangan\bon_create.blade.php ENDPATH**/ ?>