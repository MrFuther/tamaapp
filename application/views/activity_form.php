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
                    <form action="<?= base_url('activity/save_form') ?>" method="POST">
                        <input type="hidden" name="activity_id" value="<?= $activity->id_activity ?>">
                        
                        <div class="mb-3">
                            <label>Perangkat</label>
                            <select name="sub_device_id" class="form-control" required>
                                <option value="">Select Device</option>
                                <?php foreach($sub_devices as $device): ?>
                                    <option value="<?= $device->sub_device_id ?>"><?= $device->sub_device_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label>Lokasi</label>
                            <select name="area_id" class="form-control" required>
                                <option value="">Select Location</option>
                                <?php foreach($areas as $area): ?>
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
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
            
            <!-- Saved Forms Table -->
            <div class="table-responsive mt-4">
                <h6>Saved Forms</h6>
                <table class="table table-bordered">
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
                        <?php foreach($saved_forms as $index => $form): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $form->sub_device_name ?></td>
                                <td><?= $form->area_name ?></td>
                                <td><?= $form->report_type ?></td>
                                <td>
                                    <a href="<?= base_url('activity/delete_form/'.$form->form_id.'/'.$activity->id_activity) ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Are you sure?')">Delete</a>
                                    <a href="#" class="btn btn-info btn-sm">Print</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
</div>