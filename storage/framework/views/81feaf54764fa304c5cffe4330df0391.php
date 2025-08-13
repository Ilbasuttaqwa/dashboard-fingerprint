<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management Karyawan /</span> <span
                class="text-muted fw-light">Pegawai /</span> Edit</h4>

        <!-- Display Success/Error Messages -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bx bx-check-circle me-2"></i>
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bx bx-error-circle me-2"></i>
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bx bx-error-circle me-2"></i>
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Edit pegawai</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('pegawai.update', $pegawai->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control <?php $__errorArgs = ['nama_pegawai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="basic-icon-default-fullname"
                                    placeholder="Masukan Nama Lengkap" name="nama_pegawai"
                                    value="<?php echo e(old('nama_pegawai', $pegawai->nama_pegawai)); ?>" />
                            </div>
                            <?php $__errorArgs = ['nama_pegawai'];
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
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Golongan</label>
                        <div class="col-sm-10">
                            <select name="id_jabatan" class="form-control <?php $__errorArgs = ['id_jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="" disabled <?php echo e(!$pegawai->id_jabatan ? 'selected' : ''); ?>>-- Pilih Golongan --</option>
                                <?php $__currentLoopData = $jabatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($data->id); ?>"
                                        <?php echo e($data->id == old('id_jabatan', $pegawai->id_jabatan) ? 'selected' : ''); ?>>
                                        <?php echo e($data->nama_jabatan); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['id_jabatan'];
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
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Lokasi</label>
                        <div class="col-sm-10">
                            <select name="id_cabang" class="form-control <?php $__errorArgs = ['id_cabang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="" disabled <?php echo e(!$pegawai->id_cabang ? 'selected' : ''); ?>>-- Pilih Lokasi --</option>
                                <?php $__currentLoopData = $cabang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($data->id); ?>"
                                    <?php echo e($data->id == old('id_cabang', $pegawai->id_cabang) ? 'selected' : ''); ?>>
                                    <?php echo e($data->nama_cabang); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['id_cabang'];
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
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select name="jenis_kelamin" class="form-control <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="" disabled <?php echo e(!$pegawai->jenis_kelamin ? 'selected' : ''); ?>>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-Laki" <?php echo e(old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Laki-Laki' ? 'selected' : ''); ?>>
                                    Laki-Laki</option>
                                <option value="Perempuan" <?php echo e(old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Perempuan' ? 'selected' : ''); ?>>
                                    Perempuan</option>
                            </select>
                            <?php $__errorArgs = ['jenis_kelamin'];
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
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Alamat</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <textarea type="text" class="form-control <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="basic-icon-default-fullname" placeholder="Masukan Alamat Anda"
                                    name="alamat"><?php echo e(old('alamat', $pegawai->alamat)); ?></textarea>
                            </div>
                            <?php $__errorArgs = ['alamat'];
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
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Email</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="basic-icon-default-fullname"
                                    placeholder="Masukan Email Anda" name="email"
                                    value="<?php echo e(old('email', $pegawai->email)); ?>" />
                            </div>
                            <?php $__errorArgs = ['email'];
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
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="device_user_id">ID Device Fingerprint</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="device_user_id"
                                    placeholder="Masukan ID User di Device Fingerprint (opsional)" name="device_user_id"
                                    value="<?php echo e(old('device_user_id', $pegawai->device_user_id)); ?>" />
                            </div>
                            <small class="form-text text-muted">ID unik karyawan di mesin fingerprint untuk integrasi absensi otomatis</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="gaji">Gaji</label>
                        <div class="col-sm-10">
                            <?php
                                $gajiJabatan = $pegawai->jabatan ? $pegawai->jabatan->gaji_pokok : 0;
                                $gajiPegawai = $pegawai->gaji ?? 0;
                                $isGajiEdited = $gajiPegawai != $gajiJabatan;
                            ?>
                            
                            <div class="input-group">
                                <input type="number" class="form-control <?php $__errorArgs = ['gaji'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="gaji"
                                    placeholder="Masukan Gaji" name="gaji"
                                    value="<?php echo e(old('gaji', $pegawai->gaji)); ?>" />
                                <?php if($gajiJabatan > 0): ?>
                                    <button type="button" class="btn btn-outline-secondary" id="resetGaji" 
                                            onclick="resetToStandardSalary(<?php echo e($gajiJabatan); ?>)"
                                            title="Reset ke gaji pokok jabatan">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                            
                            <?php if($gajiJabatan > 0): ?>
                                <div class="mt-2">
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Gaji pokok untuk jabatan <strong><?php echo e($pegawai->jabatan->nama_jabatan); ?></strong>: 
                                        <span class="fw-bold text-primary">Rp <?php echo e(number_format($gajiJabatan, 0, ',', '.')); ?></span>
                                    </small>
                                    <?php if($isGajiEdited): ?>
                                        <br>
                                        <small class="text-warning">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            Gaji saat ini berbeda dari standar jabatan (sudah diedit manual)
                                        </small>
                                    <?php else: ?>
                                        <br>
                                        <small class="text-success">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Gaji sesuai dengan standar jabatan
                                        </small>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php $__errorArgs = ['gaji'];
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
                    </div>


                    <!-- Save Button -->
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="<?php echo e(route('pegawai.index')); ?>" class="btn btn-primary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Function to reset salary to standard jabatan salary
        function resetToStandardSalary(standardSalary) {
            document.getElementById('gaji').value = standardSalary;
        }

        // Update salary when jabatan changes
        document.querySelector('select[name="id_jabatan"]').addEventListener('change', function() {
            const jabatanId = this.value;
            
            if (jabatanId) {
                // Get jabatan data (you might want to make an AJAX call here for dynamic data)
                // For now, we'll use the data already available in the page
                const jabatanOptions = <?php echo json_encode($jabatan->keyBy('id'), 15, 512) ?>;
                
                if (jabatanOptions[jabatanId] && jabatanOptions[jabatanId].gaji_pokok) {
                    const gajiPokok = jabatanOptions[jabatanId].gaji_pokok;
                    
                    // Ask user if they want to update salary to match jabatan
                    if (confirm('Apakah Anda ingin mengupdate gaji sesuai dengan gaji pokok jabatan yang dipilih (Rp ' + 
                               new Intl.NumberFormat('id-ID').format(gajiPokok) + ')?')) {
                        document.getElementById('gaji').value = gajiPokok;
                    }
                }
            }
        });
    </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\pegawai\edit.blade.php ENDPATH**/ ?>