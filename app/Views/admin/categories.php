
    
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
                                <a href="<?php echo site_url('admin/categories/add'); ?>"><button class="btn primary-btn"><i class="lni lni-plus"></i> Add New</button></a>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- ========== title-wrapper end ========== -->

                <!-- ========== kanban-cards start ========== -->
                <div class="kanban-cards-section">
                    <div class="row">
                        <?php if (count($categories) > 0): ?>
                        <?php foreach ($categories as $key => $category): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="kanban-card-wrapper">
                                <div class="kanban-card-list">
                                    <div class="kanban-card-item" draggable="true">
                                        <div class="kanban-card <?php echo $category['status'] == 1 ? 'low' : 'high' ?>">
                                            <button class="bg-transparent border-0 kanban-button" type="button">
                                                <div class="kanban-card-header">
                                                    <span class="priority">
                                                        <?php echo $category['status'] == 1 ? 'Active' : 'Not Active' ?>
                                                    </span>
                                                    <a href="<?php echo site_url('admin/categories/edit/'.$category['id']); ?>">
                                                        <span class="tooltip-icon text-gray" data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <i class="lni lni-pencil-alt"></i>
                                                        </span>
                                                    </a>
                                                </div>
                                                <h4><?php echo $category["name"]; ?></h4>
                                                <div class="d-flex gap-3 kanban-meta">
                                                    <p class="d-flex align-items-center text-sm text-gray">
                                                        <span class="pe-1">
                                                            <i class="lni lni-flag"></i>
                                                        </span>
                                                        <?php
                                                        $country = $this->db->table("country")->where("id", $category["country"])->get()->getRowArray();
                                                        echo $country['name']; ?>
                                                        <span class="ps-2 pe-1">
                                                            <i class="lni lni-alarm-clock"></i>
                                                        </span>
                                                        <?php echo date('d M, Y', $category['createdAt']); ?>
                                                    </p>
                                                </div>
                                            </button>
                                            <div class="kanban-card-footer d-flex align-items-center justify-content-between">
                                                <?php
                                                $author = $this->db->table("users")->where('id', $category["author"])->get()->getRowArray();
                                                ?>
                                                <div class="d-flex align-items-center">
                                                    <div class="image me-2">
                                                        <img src="<?php echo site_url('admin/images/kanban/members/member-1.png'); ?>" alt="<?php echo $author["name"]; ?>" width="25" height="25" class="rounded-circle"/>
                                                    </div>
                                                    <p class="text-sm text-gray"><?php echo $author["name"]; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <div class="col-md-12"><p class="text-center">No categories found</p></div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- ========== kanban-cards end ========== -->

            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->