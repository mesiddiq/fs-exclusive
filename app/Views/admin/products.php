
    
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
                        <div class="col-md-6">
                            <div class="add-task-button float-end">
                                <a href="<?php echo site_url('admin/products/add'); ?>"><button class="btn primary-btn"><i class="lni lni-plus"></i> Add New</button></a>
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
                                                <th><h6>Category</h6></th>
                                                <th><h6>Country</h6></th>
                                                <th class="text-center"><h6>Action</h6></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($products as $key => $product): ?>
                                            <tr>
                                                <td class="text-center"><p><?php echo $key+1; ?></p></td>
                                                <td><p><?php echo $product["name"]; ?></p></td>
                                                <?php
                                                $category = $this->db->table("category")->where("id", $product["category"])->get()->getRowArray();
                                                ?>
                                                <td><p><?php echo $category["name"]; ?></p></td>
                                                <?php
                                                $country = $this->db->table("country")->where("id", $product["country"])->get()->getRowArray();
                                                ?>
                                                <td><p><?php echo $country["name"]; ?></p></td>
                                                <td class="text-center">
                                                    <div class="action d-inline-block">
                                                        <a href="<?php echo site_url('admin/users/edit/'.$product['id']); ?>">
                                                            <button class="text-primary">
                                                                <i class="lni lni-pencil"></i>
                                                            </button>
                                                        </a>
                                                        <a href="">
                                                            <button class="text-danger">
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