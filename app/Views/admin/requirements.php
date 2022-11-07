
    
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
                                                <th><h6>Date</h6></th>
                                                <th><h6>Name</h6></th>
                                                <th><h6>Email</h6></th>
                                                <th><h6>Country</h6></th>
                                                <th class="text-center"><h6>Action</h6></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($requirements as $key => $requirement):
                                            ?>
                                            <tr>
                                                <td class="text-center align-middle"><p><?php echo $key+1; ?></p></td>
                                                <td class="align-middle"><?php echo date("d-M-Y", $requirement["createdAt"]); ?></td>
                                                <td class="align-middle"><?php echo $requirement["name"]; ?></td>
                                                <td class="align-middle"><?php echo $requirement["email"]; ?></td>
                                                <td class="align-middle"><?php echo $requirement["country"]; ?></td>
                                                <td class="text-center align-middle">
                                                    <div class="action">
                                                        <a href="<?php echo site_url('admin/requirements/view/'.$requirement['id']); ?>">
                                                            <button class="text-dark link-btn">
                                                                <i class="lni lni-eye"></i>
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