


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 150px">
            <h1 class="font-weight-semi-bold text-uppercase my-3">Wishlist</h1>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">

            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-12">
                <div class="row pb-3">
                    <?php
                    if (count($wishlists) > 0):
                    foreach ($wishlists as $key => $wishlist):
                    $product = $this->db->table("products")->where("id", $wishlist["productId"])->get()->getRowArray();
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                        <a href="<?php echo site_url(strtolower('product/' . $product['slug'] . '/' . $product['id'])); ?>">
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
                                    <?php
                                    if ($product["type"] == 1):
                                    if ($product["isOutOfStock"] == 1 || $product["quantity"] <= 0):
                                    ?>
                                    <div style="position: absolute; bottom: 5px; width: 100%; background-color: rgba(255, 255, 255, .9); color: #ff0000; text-align: center; padding: 5px 0; font-weight: 700;">OUT OF STOCK</div>
                                    <?php endif; ?>
                                    <?php elseif ($product["type"] == 2): ?>
                                    <?php
                                    $quantity = 0;
                                    $productVariants = $this->db->table("productvariants")->where("productId", $product["id"])->get()->getResultArray();

                                    foreach ($productVariants as $key => $productVariant):
                                    $quantity += $productVariant["quantity"];
                                    endforeach;
                                    if ($quantity == 0): ?>
                                    <div style="position: absolute; bottom: 5px; width: 100%; background-color: rgba(255, 255, 255, .9); color: #ff0000; text-align: center; padding: 5px 0; font-weight: 700;">OUT OF STOCK</div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3"><?php echo $product["name"]; ?></h6>
                                    <div class="d-flex justify-content-center">
                                        <?php if ($product["isDiscount"] == 1): ?>
                                        <h6><?php echo $this->session->get("countryCurrency") . $product["discountedPrice"]; ?></h6><h6 class="text-muted ml-2"><del><?php echo $this->session->get("countryCurrency") . $product["price"]; ?></del></h6>
                                        <?php else: ?>
                                        <h6><?php echo $this->session->get("countryCurrency") . $product["price"]; ?></h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="javascript:;" data-productid="<?php echo $product['id']; ?>" data-loggedin="<?php echo isset($_SESSION['logged_in']) ? $_SESSION["logged_in"] : '0'; ?>" class="btn btn-sm text-dark toggleWishlist m-auto">Remove from Wishlist</a>
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
                        <h2>Sorry..!<br>No products found</h2>
                        <a href="<?php echo site_url(strtolower("shop")); ?>"><button class="btn btn-primary text-white py-2 px-4" type="button">View more products</button></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->