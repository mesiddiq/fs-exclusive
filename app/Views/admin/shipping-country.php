
    
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
                                <a href="<?php echo site_url('admin/shipping/country/add'); ?>"><button class="btn primary-btn"><i class="lni lni-plus"></i> Add New</button></a>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- ========== title-wrapper end ========== -->
                
                <!-- ========== tables-wrapper start ========== -->
                <div class="tables-wrapper">
                    <style type="text/css">
                        table.table th, table.table td {
                            padding: 15px 5px;
                        }
                    </style>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-style mb-30">
                                <div class="table-responsive">
                                    <table id="table" class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><h6>#</h6></th>
                                                <th><h6>Country</h6></th>
                                                <th><h6>Location</h6></th>
                                                <th><h6>Status</h6></th>
                                                <th class="text-center"><h6>Action</h6></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($shippingCountry as $key => $shippingCountry): ?>
                                            <tr>
                                                <td class="text-center align-middle"><p><?php echo $key+1; ?></p></td>
                                                <td class="align-middle"><?php echo $shippingCountry["country"]; ?></td>
                                                <td class="align-middle"><?php echo getCountry($shippingCountry["location"]); ?></td>
                                                <td class="align-middle">
                                                    <?php if ($shippingCountry["status"] == 0) { ?>
                                                    <span class="status-btn warning-btn">Pending</span>
                                                    <?php } elseif ($shippingCountry["status"] == 1) { ?>
                                                    <span class="status-btn success-btn">Active</span>
                                                    <?php } ?>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="action justify-content-end">
                                                        <a href="<?php echo site_url('admin/shipping/country/edit/'.$shippingCountry['id']); ?>">
                                                            <button class="text-dark link-btn">
                                                                <i class="lni lni-pencil"></i>
                                                            </button>
                                                        </a>
                                                        <a href="javascript:;" onclick="deleteModal('<?php echo site_url('admin/shipping/country/delete/'.$shippingCountry['id']); ?>')">
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