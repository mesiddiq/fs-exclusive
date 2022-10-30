
    
        <style type="text/css">
            .profile-image {
                position: absolute;
                width: 30px;
                top: -5px;
                left: 50px;
                border-radius: 50%;
            }
        </style>
        <!-- ========== section start ========== -->
        <section class="section">
            <div class="container-fluid">

                <!-- ========== title-wrapper start ========== -->
                <div class="title-wrapper pt-30 pb-30">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="title">
                                <h2><?php echo $page_title; ?></h2>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- ========== title-wrapper end ========== -->
                
                <!-- ========== tables-wrapper start ========== -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style settings-card-2 mb-30">
                            <form method="POST" action="<?php echo site_url('admin/users/update/'.$user['id']); ?>" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Name</label>
                                            <input type="text" class="bg-transparent" name="name" placeholder="Name" value="<?php echo $user['name']; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Email</label>
                                            <input type="email" class="bg-transparent" name="email" placeholder="Email" value="<?php echo $user['email']; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Contact</label>
                                            <input type="text" class="bg-transparent" name="contact" placeholder="Contact" value="<?php echo $user['contact']; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="select-style-1">
                                            <label>Role</label>
                                            <div class="select-position">
                                                <select name="role">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $roles = $this->db->table("roles")->get()->getResultArray();
                                                    foreach ($roles as $key => $role):
                                                    ?>
                                                    <option value="<?php echo $role['id']; ?>" <?php echo $role["id"] == $user["role"] ? 'selected' : ''; ?>><?php echo $role["name"]; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Profile</label>
                                            <?php if ($user["image"] != NULL) { ?>
                                            <img class="profile-image" src="<?php echo site_url('uploads/users/'.$user["image"]); ?>">
                                            <?php } ?>
                                            <input type="file" class="bg-transparent" name="image" />
                                            <input type="hidden" name="imageName" value="<?php echo $user["image"]; ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label style="font-size: 14px; font-weight: 500; color: #262d3f; display: block; margin-bottom: 10px;">Status</label>
                                        <div class="form-check form-check-inline radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="0" name="status" <?php echo $user["status"] == 0 ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="status">Pending</label>
                                        </div>
                                        <div class="form-check form-check-inline radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="1" name="status" <?php echo $user["status"] == 1 ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="status">Verified</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>About Me</label>
                                            <textarea class="bg-transparent" placeholder="Type here" rows="6" name="about"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="main-btn primary-btn btn-hover">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
                <!-- ========== tables-wrapper end ========== -->
                
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->