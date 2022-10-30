
    
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
                                                <th><h6>Price</h6></th>
                                                <th><h6>Status</h6></th>
                                                <th class="text-center"><h6>Action</h6></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($products as $key => $product): ?>
                                            <tr>
                                                <td class="text-center align-middle"><p><?php echo $key+1; ?></p></td>
                                                <td class="align-middle"><p><?php echo $product["name"]; ?></p></td>
                                                <?php
                                                $category = $this->db->table("category")->where("id", $product["category"])->get()->getRowArray();
                                                ?>
                                                <td class="align-middle"><p><?php echo $category["name"]; ?></p></td>
                                                <?php
                                                $country = $this->db->table("country")->where("id", $product["country"])->get()->getRowArray();
                                                ?>
                                                <td class="align-middle"><p><?php echo $country["name"]; ?></p></td>
                                                <td class="align-middle"><p><?php echo $country["currency"] . $product["price"]; ?></p></td>
                                                <td class="align-middle">
                                                    <?php if ($product["status"] == 0) { ?>
                                                    <span class="status-btn warning-btn">Pending</span>
                                                    <?php } elseif ($product["status"] == 1) { ?>
                                                    <span class="status-btn success-btn">Published</span>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="action justify-content-end">
                                                        <a href="<?php echo site_url('admin/products/edit/'.$product['id']); ?>">
                                                            <button class="text-dark link-btn">
                                                                <i class="lni lni-pencil"></i>
                                                            </button>
                                                        </a>
                                                        <a href="javascript:;" onclick="deleteModal('<?php echo site_url('admin/products/delete/'.$product['id']); ?>')">
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