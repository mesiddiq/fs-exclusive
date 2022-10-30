
    
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
                <div class="tables-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-style mb-30">
                                <div class="table-responsive">
                                    <table id="table" class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><h6>#</h6></th>
                                                <th><h6>Name</h6></th>
                                                <th><h6>Email</h6></th>
                                                <th><h6>Contact</h6></th>
                                                <th><h6>Role</h6></th>
                                                <th><h6>Status</h6></th>
                                                <th class="text-center"><h6>Action</h6></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($users as $key => $user): ?>
                                            <tr>
                                                <td class="text-center align-middle"><p><?php echo $key+1; ?></p></td>
                                                <td class="align-middle"><p><?php echo $user["name"]; ?></p></td>
                                                <td class="align-middle"><p><?php echo $user["email"]; ?></p></td>
                                                <td class="align-middle"><p><?php echo $user["contact"]; ?></p></td>
                                                <?php
                                                $role = $this->db->table("roles")->where("id", $user["role"])->get()->getRowArray();
                                                ?>
                                                <td class="align-middle"><p><?php echo $role["name"]; ?></p></td>
                                                <td class="align-middle">
                                                    <?php if ($user["status"] == 0) { ?>
                                                    <span class="status-btn warning-btn">Pending</span>
                                                    <?php } elseif ($user["status"] == 1) { ?>
                                                    <span class="status-btn success-btn">Verified</span>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="action justify-content-end">
                                                        <a href="<?php echo site_url('admin/users/edit/'.$user['id']); ?>">
                                                            <button class="text-dark link-btn">
                                                                <i class="lni lni-pencil"></i>
                                                            </button>
                                                        </a>
                                                        <a href="javascript:;" onclick="deleteModal('<?php echo site_url('admin/users/delete/'.$user['id']); ?>')">
                                                            <button class="text-dark delete-btn ml-10">
                                                                <i class="lni lni-trash-can"></i>
                                                            </button>
                                                        </a>
                                                        <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="lni lni-more-alt"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                                            <li class="dropdown-item">
                                                                <a href="#0" class="text-gray">Mark as Read</a>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <a href="#0" class="text-gray">Reply</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- ========== tables-wrapper end ========== -->
                
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->