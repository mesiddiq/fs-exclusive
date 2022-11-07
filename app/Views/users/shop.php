<?php
if (isset($selected_category_id) && ($selected_category_id != "all")) {
    $selected_category_ids = array_column($selected_category_id, 'id');
} else {
    $selected_category_ids = array();
}
?>


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 150px">
            <h1 class="font-weight-semi-bold text-uppercase my-3">Shop</h1>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by category</h5>
                    <form>
                        <?php foreach ($categories as $key => $category): ?>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="category-<?php echo $category['id'];?>" name="category" value="<?php echo $category['slug']; ?>" onclick="filter()" <?php echo in_array($category['id'], $selected_category_ids) ? 'checked' : ''; ?>>
                            <label class="custom-control-label" for="category-<?php echo $category['id'];?>"><?php echo $category["name"]; ?></label>
                            <!-- <span class="badge border font-weight-normal">1000</span> -->
                        </div>
                        <?php endforeach; ?>
                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <?php
                    if (count($products) > 0):
                    foreach ($products as $key => $product): ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <a href="<?php echo site_url(strtolower($sessCountry["code"]) . '/product/' . $product['slug'] . '/' . $product['id']); ?>">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <?php
                                    $featuredimage = $this->db->table("productimages")->where(array("productId" => $product["id"], "featured" => 1))->get()->getResultArray();
                                    if (count($featuredimage) > 0): ?>
                                    <img class="img-fluid w-100" src="<?php echo site_url('uploads/products/' . $featuredimage[0]['name']); ?>" alt="<?php echo $product["name"]; ?>">
                                    <?php else:
                                    $image = $this->db->table("productimages")->where(array("productId" => $product["id"]))->get()->getResultArray();
                                    ?>
                                    <img class="img-fluid w-100" src="<?php echo site_url('uploads/products/' . $image[0]['name']); ?>" alt="<?php echo $product["name"]; ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3"><?php echo $product["name"]; ?></h6>
                                    <div class="d-flex justify-content-center">
                                        <?php if ($product["isDiscount"] == 1): ?>
                                        <h6><?php echo $sessCountry["currency"] . $product["discountedPrice"]; ?></h6><h6 class="text-muted ml-2"><del><?php echo $sessCountry["currency"] . $product["price"]; ?></del></h6>
                                        <?php else: ?>
                                        <h6><?php echo $sessCountry["currency"] . $product["price"]; ?></h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="<?php echo site_url(strtolower($sessCountry["code"]) . '/product/' . $product['slug'] . '/' . $product['id']); ?>" class="btn btn-sm text-dark m-auto"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                    <!-- <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-3">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div> -->
                    <?php else: ?>
                    <div class="col-12 pb-1 text-center">
                        <h2>Sorry..!<br>No products added</h2>
                        <a href="<?php echo site_url(strtolower($sessCountry["code"]) . "/shop"); ?>"><button class="btn btn-primary text-white py-2 px-4" type="button">View more products</button></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

    <script type="text/javascript">
        function filter() {
            let url = get_url();
            window.location.replace(url);
        }

        function get_url() {
            var urlPrefix = "<?php echo site_url(strtolower($sessCountry["code"]) . '/shop'); ?>";
            var urlSuffix = "";
            var categoryArr = [];

            // Get selected category
            $('[name=category]').each(function() {

                if ($(this).is(':checked')) {
                    console.log("array " + categoryArr)
                    categoryArr.push($(this).attr('value'));
                }
            });

            var selectedCategory = categoryArr.join();
            console.log("selectedCate " + selectedCategory)

            urlSuffix = "?category="+selectedCategory;
            var url = urlPrefix+urlSuffix;
            selectedCategory = "";
            return url;
        }
    </script>