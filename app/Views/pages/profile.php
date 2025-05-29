<?= $this->extend('layouth/admin_layout') ?>
<?= $this->section('content') ?>

<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Profile</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= url_to('admin') ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Profile
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="card-box height-100-p overflow-hidden">
                    <div class="profile-tab height-100-p">
                        <div class="tab height-100-p">
                            <div class="profile-setting">
                                <form id="profileForm" method="POST">
                                    <ul class="profile-edit-list row">
                                        <li class="weight-500 col-md-12">
                                            <h4 class="text-blue h5 mb-20">Edit Profile</h4>

                                            <div class="form-group">
                                                <label>Nama Instansi</label>
                                                <input class="form-control form-control-lg" type="text" name="instansi" id="instansi" />
                                            </div>

                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control form-control-lg" type="email" name="email" id="email" />
                                            </div>

                                            <div class="form-group">
                                                <label>Handphone</label>
                                                <input class="form-control form-control-lg" type="number" name="handphone" id="handphone" />
                                            </div>

                                            <div class="form-group">
                                                <label>Role</label>
                                                <select class="selectpicker form-control form-control-lg" name="role" id="role" data-style="btn-outline-secondary btn-lg" title="Pilih Role">
                                                    <option value="admin">Admin</option>
                                                    <option value="user">Users</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Is Aktif</label>
                                                <select class="selectpicker form-control form-control-lg" name="is_aktif" id="is_aktif" data-style="btn-outline-secondary btn-lg" title="is Aktif">
                                                    <option value="1">Aktif</option>
                                                    <option value="0">Tidak Aktif</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control form-control-lg" type="password" name="password" id="password" />
                                            </div>

                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input class="form-control form-control-lg" type="password" name="confirm_password" id="confirm_password" />
                                            </div>

                                            <div class="form-group mb-0">
                                                <input type="submit" class="btn btn-primary" value="Update Information" />
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const id = localStorage.getItem('id');

            if (!id) {
                console.error('User ID not found in localStorage');
            } else {
                $.ajax({
                    url: '/api/v1/user/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        const data = response.data;
                        $('#instansi').val(data.name || '');
                        $('#email').val(data.email || '');
                        $('#handphone').val(data.handphone || '');
                        $('#role').selectpicker('val', data.role?.toLowerCase() || '');
                        $('#is_aktif').selectpicker('val', data.is_aktif ? '1' : '0');
                    },
                    error: function (xhr) {
                        console.error('Error fetching user data:', xhr.responseText);
                    }
                });
            }

            $('#profileForm').on('submit', function (e) {
                e.preventDefault();


                const formData = {
                    name: $('#instansi').val(),
                    email: $('#email').val(),
                    handphone: $('#handphone').val(),
                    role: $('#role').val(),
                    is_aktif: $('#is_aktif').val(),
					confirm_password: $('#confirm_password').val(),
					password: $('#password').val()	
                };


                $.ajax({
                    url: '/api/v1/user/' + id,
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                    success: function (response) {
                        alert('Profile updated successfully');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error updating profile:', xhr.responseText);
                        alert('Failed to update profile');
                    }
                });
            });
        </script>
    </div>
</div>

<?= $this->endSection() ?>
