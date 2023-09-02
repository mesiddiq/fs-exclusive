

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        <!-- ========== header start ========== -->
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-6">
                        <!-- <div class="header-left d-flex align-items-center">
                            <div class="menu-toggle-btn mr-20">
                                <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                                    <i class="lni lni-chevron-left me-2"></i> Menu
                                </button>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">
                            <a href="<?php echo site_url(); ?>" target="_blank">
                                <button type="button">
                                    <i class="lni lni-code-alt"></i>
                                </button>
                            </a>
                            <!-- profile start -->
                            <div class="profile-box ml-15">
                                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="profile-info">
                                    <div class="info">
                                        <h6><?php echo $this->session->get("userName"); ?></h6>
                                        <div class="image">
                                            <?php if ($this->session->get("userImage") != NULL): ?>
                                            <img src="<?php echo site_url('uploads/users/'.$this->session->get("userImage")); ?>" alt="<?php echo $this->session->get("userName"); ?>" />
                                            <?php else: ?>
                                            <img src="<?php echo site_url('uploads/users/user-image.png'); ?>" alt="<?php echo $this->session->get("userName"); ?>" />
                                            <?php endif; ?>
                                            <span class="status"></span>
                                        </div>
                                    </div>
                                </div>
                                <i class="lni lni-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                    <li>
                                        <a href="<?php echo site_url('admin/users/edit/'.$this->session->get('userId')); ?>">
                                            <i class="lni lni-user"></i> View Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('admin/logo'); ?>"> <i class="lni lni-cog"></i> Settings </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('logout'); ?>"> <i class="lni lni-exit"></i> Sign Out </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- profile end -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== header end ========== -->