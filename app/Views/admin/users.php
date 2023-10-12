
    
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
                                                <th><h6>Country</h6></th>
                                                <th><h6>Status</h6></th>
                                                <th class="text-center"><h6>Action</h6></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($users as $key => $user):
                                            $country = "";
                                            $role = $this->db->table("roles")->where("id", $user["role"])->get()->getRowArray();
                                            $address = $this->db->table("address")->select("location")->where("userId", $user["id"])->orderBy("id", "DESC")->limit(1)->get()->getResultArray();
                                            if (count($address) > 0) {
                                                $builder = $this->db->table("country")->select("name")->where("id", $address[0]["location"])->get()->getResultArray();
                                                if (count($builder) > 0) {
                                                    $country = $builder[0]["name"];
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td class="text-center align-middle"><p><?php echo $key+1; ?></p></td>
                                                <td class="align-middle"><p><?php echo $user["name"]; ?></p></td>
                                                <td class="align-middle"><p><?php echo $user["email"]; ?></p></td>
                                                <td class="align-middle"><p><?php echo $user["contact"]; ?></p></td>
                                                <td class="align-middle"><p><?php echo $role["name"]; ?></p></td>
                                                <td class="align-middle"><p><?php echo $country; ?></p></td>
                                                <td class="align-middle">
                                                    <?php if ($user["status"] == 0) { ?>
                                                    <span class="status-btn warning-btn">Pending</span>
                                                    <?php } elseif ($user["status"] == 1) { ?>
                                                    <span class="status-btn success-btn">Verified</span>
                                                    <?php } ?>
                                                </td>
                                                <td class="float-end align-middle">
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