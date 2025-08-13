<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            padding: 0;
        }
        .header p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .late {
            color: red;
            font-weight: bold;
        }
        .on-time {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN ABSENSI PEGAWAI</h2>
        <p>Periode: <?php echo e(date('F Y', strtotime(request('year').'-'.request('month').'-01'))); ?></p>
        <?php if(isset($cabangId) && $cabangId): ?>
            <p>Lokasi: <?php echo e(\App\Models\Cabang::find($cabangId)->nama_cabang); ?></p>
        <?php else: ?>
            <p>Lokasi: Semua Lokasi</p>
        <?php endif; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Lokasi</th>
                <th>Kategori/Golongan</th>
                <th>Morning Check-in</th>
                <th>Evening Check-in</th>
                <th>Late Penalty</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $absensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($item->user->nama_pegawai ?? "Tidak Ada Data"); ?></td>
                    <td><?php echo e($item->user->cabang->nama_cabang ?? "Tidak Ada Data"); ?></td>
                    <td><?php echo e($item->user->jabatan->nama_jabatan ?? "Tidak Ada Data"); ?></td>
                    <td><?php echo e($item->jam_masuk ?? "Tidak Ada Data"); ?></td>
                    <td><?php echo e($item->jam_masuk_sore ?? "Tidak Ada Data"); ?></td>
                    <td>
                        <?php
                            $lateMinutes = 0;
                            if ($item->jam_masuk) {
                                $startTime = \Carbon\Carbon::createFromFormat('H:i', '07:30');
                                $checkInTime = \Carbon\Carbon::parse($item->jam_masuk);

                                if ($checkInTime->gt($startTime)) {
                                    $lateMinutes = $checkInTime->diffInMinutes($startTime);
                                }
                            }
                        ?>

                        <?php if($lateMinutes > 0): ?>
                            <span class="late"><?php echo e($lateMinutes); ?> menit</span>
                        <?php else: ?>
                            <span class="on-time">Tepat Waktu</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Data absensi tidak ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: <?php echo e(date('d-m-Y H:i:s')); ?></p>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\laporan\pdf_absensi.blade.php ENDPATH**/ ?>