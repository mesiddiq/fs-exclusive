
    
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
                            <form method="POST" action="javascript:;">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Name</label>
                                            <input type="text" class="bg-transparent" placeholder="Name" value="<?php echo $requirement["name"]; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Email</label>
                                            <input type="text" class="bg-transparent" placeholder="Email" value="<?php echo $requirement["email"]; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Mobile</label>
                                            <input type="text" class="bg-transparent" placeholder="+123 456 789" value="<?php echo $requirement["contact"]; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Alternate Mobile</label>
                                            <input type="text" class="bg-transparent" placeholder="+123 456 789" value="<?php echo $requirement["contact2"]; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Address Line 1</label>
                                            <input type="text" class="bg-transparent" placeholder="+123 456 789" value="<?php echo $requirement["address"]; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Address Line 2</label>
                                            <input type="text" class="bg-transparent" placeholder="Road Name, Area, Colony" value="<?php echo $requirement["address2"]; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>City</label>
                                            <input type="text" class="bg-transparent" placeholder="Road Name, Area, Colony" value="<?php echo $requirement["city"]; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>State</label>
                                            <input type="text" class="bg-transparent" value="<?php echo $requirement["state"]; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Country</label>
                                            <input type="text" class="bg-transparent" value="<?php echo $requirement["country"]; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Zipcode</label>
                                            <input type="text" class="bg-transparent" value="<?php echo $requirement["zipcode"]; ?>" />
                                        </div>
                                    </div>
                                    <?php if (json_decode($requirement["images"]) != NULL): ?>
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Images</label>
                                        </div>
                                    </div>
                                    <?php foreach (json_decode($requirement["images"]) as $key => $image): ?>
                                    <div class="col-3 mb-4">
                                        <img class="img-fluid" src="<?php echo site_url('uploads/custom/' . $image); ?>" alt="<?php echo $image; ?>" />
                                    </div>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
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