<script src="<?= base_url('js/jquery-3.7.1.min.js'); ?>"></script>
<div class="modal-body">
            <!-- Activity Details -->
            <div class="row mb-3">
                <h3>Activity Details</h3>
                <div class="col-md-6">
                    <p>Date: <?= date('d M Y', strtotime($activity->tanggal_kegiatan)) ?></p>
                    <p>Shift: <?= $activity->nama_shift ?></p>
                    <p>Time: <?= $activity->jam_mulai ?> - <?= $activity->jam_selesai ?></p>
                    <p>Team: 
                        <?php foreach($users as $user): ?>
                            <?= $user->username ?>, 
                        <?php endforeach; ?>
                    </p>
                </div>
                
                <!-- Form Input -->
                <div class="col-md-6">
                    <form id="activityForm" action="javascript:void(0);">
                        <input type="hidden" name="activity_id" value="<?= $activity_id ?>">

                        <!-- Input fields seperti sub_device, area, report_type, dll. -->
                        <div class="mb-3">
                            <label>Perangkat</label>
                            <select name="sub_device_id" class="form-control" required>
                                <option value="">Pilih Perangkat</option>
                                <?php foreach ($sub_devices as $device): ?>
                                    <option value="<?= $device->sub_device_id ?>"><?= $device->sub_device_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Lokasi</label>
                            <select name="area_id" class="form-control" required>
                                <option value="">Pilih Lokasi</option>
                                <?php foreach ($areas as $area): ?>
                                    <option value="<?= $area->area_id ?>"><?= $area->area_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Kelompok Laporan</label>
                            <div class="form-check">
                                <input type="radio" name="report_type" value="Harian" class="form-check-input" required>
                                <label class="form-check-label">Harian</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="report_type" value="Mingguan" class="form-check-input">
                                <label class="form-check-label">Mingguan</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="report_type" value="Bulanan" class="form-check-input">
                                <label class="form-check-label">Bulanan</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
            
            <!-- Saved Forms Table -->
            <div class="table-responsive mt-4">
                <h6>Saved Forms</h6>
                <table id="savedFormsTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Perangkat</th>
                            <th>Lokasi</th>
                            <th>Kelompok Laporan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan dimuat melalui AJAX setelah form disubmit -->
                    </tbody>
                </table>
            </div>
</div>