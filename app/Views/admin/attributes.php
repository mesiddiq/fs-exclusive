
    
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
                        <div class="col-lg-5">
                            <div class="card-style mb-30">
                                <div class="row d-flex align-items-center mb-3">
                                    <div class="col">
                                        <h6>Categories </h6>
                                    </div>
                                    <!-- <div class="col text-end">
                                        <a href="<?php echo site_url('admin/attributes/category/add'); ?>"><button class="btn primary-btn"><i class="lni lni-plus"></i> Add New</button></a>
                                    </div> -->
                                </div>
                                <div class="table-responsive">
                                    <style type="text/css">
                                        table.table th, table.table td {
                                            padding: 15px 5px;
                                        }
                                    </style>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><h6>#</h6></th>
                                                <th><h6>Name</h6></th>
                                                <th><h6>Status</h6></th>
                                                <!-- <th class="text-center"><h6>Action</h6></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($attributes) > 0): ?>
                                            <?php foreach ($attributes as $key => $attribute): ?>
                                            <tr>
                                                <td class="text-center align-middle"><p><?php echo $key+1; ?></p></td>
                                                <td class="align-middle"><p><?php echo $attribute["name"]; ?></p></td>
                                                <td class="align-middle">
                                                    <?php if ($attribute["status"] == 0) { ?>
                                                    <span class="status-btn warning-btn">Pending</span>
                                                    <?php } elseif ($attribute["status"] == 1) { ?>
                                                    <span class="status-btn success-btn">Published</span>
                                                    <?php } ?>
                                                </td>
                                                <!-- <td class="text-center align-middle">
                                                    <div class="action justify-content-end">
                                                        <a href="<?php echo site_url('admin/attributes/category/edit/'.$attribute['id']); ?>">
                                                            <button class="text-dark link-btn">
                                                                <i class="lni lni-pencil"></i>
                                                            </button>
                                                        </a>
                                                        <a href="javascript:;" onclick="deleteModal('<?php echo site_url('admin/attributes/category/delete/'.$attribute['id']); ?>')">
                                                            <button class="text-dark delete-btn ml-10">
                                                                <i class="lni lni-trash-can"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td> -->
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php else: ?>
                                            <tr>
                                                <td class="text-center" colspan="4">No data found</td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                        <div class="col-lg-7">
                            <div class="card-style mb-30">
                                <div class="row d-flex align-items-center mb-3">
                                    <div class="col">
                                        <h6>Variants </h6>
                                    </div>
                                    <div class="col text-end">
                                        <a href="<?php echo site_url('admin/attributes/variants/add'); ?>"><button class="btn primary-btn"><i class="lni lni-plus"></i> Add New</button></a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <style type="text/css">
                                        table.table th, table.table td {
                                            padding: 15px 5px;
                                        }
                                    </style>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><h6>#</h6></th>
                                                <th><h6>Name</h6></th>
                                                <th><h6>Category</h6></th>
                                                <th><h6>Status</h6></th>
                                                <th class="text-center"><h6>Action</h6></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($variants) > 0): ?>
                                            <?php foreach ($variants as $key => $variant): ?>
                                            <tr>
                                                <td class="text-center align-middle"><p><?php echo $key+1; ?></p></td>
                                                <td class="align-middle"><p><?php echo $variant["name"]; ?></p></td>
                                                <td class="align-middle">
                                                    <?php
                                                    $categoryName = $this->db->table("productattributescategory")->where("id", $variant["category"])->get()->getrow()->name;
                                                    ?>
                                                    <p><?php echo $categoryName; ?></p>
                                                </td>
                                                <td class="align-middle">
                                                    <?php if ($variant["status"] == 0) { ?>
                                                    <span class="status-btn warning-btn">Pending</span>
                                                    <?php } elseif ($variant["status"] == 1) { ?>
                                                    <span class="status-btn success-btn">Published</span>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="action justify-content-end">
                                                        <a href="<?php echo site_url('admin/attributes/variants/edit/'.$variant['id']); ?>">
                                                            <button class="text-dark link-btn">
                                                                <i class="lni lni-pencil"></i>
                                                            </button>
                                                        </a>
                                                        <a href="javascript:;" onclick="deleteModal('<?php echo site_url('admin/attributes/variants/delete/'.$variant['id']); ?>')">
                                                            <button class="text-dark delete-btn ml-10">
                                                                <i class="lni lni-trash-can"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php else: ?>
                                            <tr>
                                                <td class="text-center" colspan="5">No data found</td>
                                            </tr>
                                            <?php endif; ?>
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