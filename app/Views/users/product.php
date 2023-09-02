


    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-4 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <?php
                        $productImages = $this->db->table("productimages")->orderBy("featured DESC")->where("productId", $product["id"])->get()->getResultArray();
                        foreach ($productImages as $key => $productImage): ?>
                        <div class="carousel-item <?php echo $key == 0 ? 'active' : ''; ?>">
                            <a href="javascript:;"><img class="w-100 h-100" src="<?php echo site_url('uploads/products/'.$productImage['name']); ?>" alt="<?php echo $product["name"]; ?>"></a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-8 pb-5">
                <h3 class="font-weight-semi-bold"><?php echo $product["name"]; ?></h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <?php
                        $avgRating = $rating[0]["rating"] == NULL ? 0 :number_format($rating[0]["rating"], 1);
                        $result = '';

                        if ($avgRating > 0) {
                            
                            for ($i=1; $i <= (int) $avgRating; $i++) { 
                                $result .= '<small class="fas fa-star mr-1"></small>';
                            }

                            if (strpos($avgRating, ".") == true) {
                                $explodeAvgRating = explode(".", $avgRating);
                                if ($explodeAvgRating[1] != "0") {
                                    $result .= '<small class="fas fa-star-half-alt mr-1"></small>';
                                }
                            }
                            
                            for ($i= 5; $i > ceil($avgRating); $i--) { 
                                $result .= '<small class="far fa-star mr-1"></small>';
                            }

                        } else {
                            for ($i=1; $i <= 5; $i++) { 
                                $result .= '<small class="far fa-star mr-1"></small>';
                            }
                        }
                        echo $result;
                        ?>
                    </div>
                    <small class="pt-1">(<?php echo count($reviews); ?> Reviews)</small>
                </div>
                <?php if ($product["isDiscount"] == 1): ?>
                <h3 class="font-weight-semi-bold mb-4"><?php echo $this->session->get("countryCurrency") . $product["discountedPrice"]; ?><del class="text-muted ml-2"><?php echo $this->session->get("countryCurrency") . $product["price"]; ?></del></h3>
                <?php else: ?>
                <h3 class="font-weight-semi-bold mb-4"><?php echo $this->session->get("countryCurrency") . $product["price"]; ?></h3>
                <?php endif; ?>
                <p class="mb-4"><?php echo $product["shortDescription"]; ?></p>
                <?php if ($product["sizeChart"] == 1): ?>
                <a href="javascript:;" id="sizeChart"><p class="text-decoration-underline font-weight-medium text-black-50">Size Chart</p></a>
                <?php endif; ?>
                <?php if ($product["type"] == 1): ?>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <?php
                    if ($product["isOutOfStock"] == 1 || $product["quantity"] <= 0):
                    ?>
                    <button type="button" class="btn btn-danger text-white px-3"><i class="fa fa-sad-tear mr-1"></i> Out of Stock</button>
                    <?php else: ?>
                    <!-- <div class="input-group quantity mr-3">
                        <div class="input-group-btn">
                            <button class="btn btn-primary text-white btn-minus" >
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center" name="productQty" value="1" readonly>
                        <div class="input-group-btn">
                            <button class="btn btn-primary text-white btn-plus" data-max="<?php echo $product['quantity']; ?>">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div> -->
                    <button type="button" id="addToCart" class="btn btn-primary text-white px-3" data-productid="<?php echo $product["id"]; ?>"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    <?php endif; ?>
                </div>
                <?php if ($product["quantity"] > 0 && $product["quantity"] < 7): ?>
                <p class="text-danger">Low stock</p>
                <?php endif; ?>
                <?php elseif ($product["type"] == 2): ?>
                <?php
                $quantity = 0;
                $productVariants = $this->db->table("productvariants")->where("productId", $product["id"])->get()->getResultArray();

                foreach ($productVariants as $key => $productVariant):
                $quantity += $productVariant["quantity"];
                endforeach;
                if ($quantity == 0): ?>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <button type="button" class="btn btn-danger text-white px-3"><i class="fa fa-sad-tear mr-1"></i> Out of Stock</button>
                </div>
                <?php else: ?>
                <style type="text/css">
                    .productVariant {
                        width: 50px;
                        height: 50px;
                        display: flex;
                        text-align: center;
                        align-items: center;
                        justify-content: center;
                        border: 1px solid #CCC;
                        color: #000;
                        margin-right: 5px;
                        cursor: pointer;
                        font-size: 14px;
                    }
                    .productVariant.selected {
                        border: 2px solid #d2b482;
                    }
                </style>
                <p class="text-decoration-underline text-dark font-weight-medium">Size:</p>
                <div class="d-flex align-items-center mb-4">
                    <?php
                    foreach ($sizes as $key => $size):
                    $sizeInfo = $this->db->table("productattributesvariants")->where("id", $size["size"])->get()->getRowArray();
                    ?>
                    <div class="productVariant productVariantSize" data-id="<?php echo $sizeInfo['id']; ?>"><?php echo $sizeInfo["name"]; ?></div>
                    <?php endforeach; ?>
                </div>
                <p class="text-decoration-underline text-dark font-weight-medium">Color:</p>
                <div class="d-flex align-items-center mb-4" id="productVariantColor">
                    <?php
                    foreach ($colors as $key => $color):
                    $colorInfo = $this->db->table("productattributesvariants")->where("id", $color["color"])->get()->getRowArray();
                    if ($colorInfo["isColor"] == 1):
                    ?>
                    <div class="productVariant productVariantColor" data-id="<?php echo $colorInfo['id']; ?>" style="background-color: <?php echo $colorInfo["colorCode"]; ?>;"></div>
                    <?php else: ?>
                    <div class="productVariant productVariantColor" data-id="<?php echo $colorInfo['id']; ?>"><?php echo $colorInfo["name"]; ?></div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <!-- <div class="input-group quantity mr-3">
                        <div class="input-group-btn">
                            <button class="btn btn-primary text-white btn-minus" >
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center" name="productQty" value="1" readonly>
                        <div class="input-group-btn">
                            <button class="btn btn-primary text-white btn-plus" data-max="<?php echo $product['quantity']; ?>">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div> -->
                    <button type="button" id="addVariableProductToCart" class="btn btn-primary text-white px-3" data-productid="<?php echo $product["id"]; ?>" data-sizeid="0" data-colorid="0"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                </div>
                <?php endif; ?>
                <?php endif; ?>
                <div class="d-flex">
                    <?php
                    if ($this->session->get("logged_in") == true):
                    $checkWishlist = $this->db->table("wishlist")->where(array("userId" => $this->session->get("userId"), "productId" => $product["id"]))->get()->getResultArray();
                    if (count($checkWishlist) > 0): ?>
                    <a href="javascript:;" id="toggleWishlist" data-productid="<?php echo $product['id']; ?>" data-loggedin="<?php echo isset($_SESSION['logged_in']) ? $_SESSION["logged_in"] : '0'; ?>" style="color: #d2b482;"><p class="text-decoration-underline font-weight-medium">Added to Wishlist</p></a>
                    <?php else: ?>
                    <a href="javascript:;" id="toggleWishlist" data-productid="<?php echo $product['id']; ?>" data-loggedin="<?php echo isset($_SESSION['logged_in']) ? $_SESSION["logged_in"] : '0'; ?>"><p class="text-dark text-decoration-underline font-weight-medium">Add to Wishlist</p></a>
                    <?php endif; ?>
                    <?php else: ?>
                    <a href="javascript:;" id="toggleWishlist"><p class="text-dark text-decoration-underline font-weight-medium">Add to Wishlist</p></a>
                    <?php endif; ?>
                </div>
                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo current_url(); ?>" target="_blank" rel="nofollow" title="Share on Facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='<?php echo current_url(); ?> + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;">
                            <i class="fab fa-facebook-square"></i>
                        </a>
                        <a class="text-dark px-2" href="https://twitter.com/home?status=<?php echo current_url(); ?>" target="_blank" rel="nofollow" title="Tweet on Twitter" onclick="window.open('https://twitter.com/intent/tweet?text='<?php echo current_url(); ?> + encodeURIComponent(document.title) + ':%20' + encodeURIComponent(document.URL)); return false;">
                            <i class="fab fa-twitter-square"></i>
                        </a>
                        <a class="text-dark px-2" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo current_url(); ?>" target="_blank" rel="nofollow" title="Share on LinkedIn" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo current_url(); ?> + encodeURIComponent(document.URL)); return false;'">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a class="text-dark px-2" href="https://pinterest.com/pin/create/link/?url=<?php echo current_url(); ?>" target="_blank" rel="nofollow" title="Share on Pinterest" onclick="window.open('https://pinterest.com/pin/create/link/?url='<?php echo current_url(); ?> + encodeURIComponent(document.title) + ':%20' + encodeURIComponent(document.URL)); return false;">
                            <i class="fab fa-pinterest-square"></i>
                        </a>
                        <a class="text-dark px-2" href="https://wa.me/?text=<?php echo current_url(); ?>" target="_blank" rel="nofollow" title="Share on WhatsApp">
                            <i class="fab fa-whatsapp-square"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col-12">
                <h4 class="mb-3">Product Description</h4>
                <?php echo json_decode($product["description"]); ?>
            </div>
        </div>
        <hr />
        <div class="product-reviews">
            <div class="row px-xl-5">
                <div class="col-md-6">
                    <h4 class="mb-4">Reviews</h4>
                    <?php
                    if (count($reviews) > 0):
                    foreach ($reviews as $key => $review):
                    $reviewUser = $this->db->table("users")->where("id", $review["userId"])->get()->getRowArray();
                    if ($review["review"] != NULL):
                    ?>
                    <div class="media mb-4">
                        <img src="<?php echo site_url('assets/img/user.jpg'); ?>" alt="Image" class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px;">
                        <div class="media-body">
                            <h6><?php echo $reviewUser["name"]; ?><small> - <em><?php echo date("M d, Y", $review["createdAt"]); ?></em></small></h6>
                            <div class="text-primary mb-2">
                                <?php
                                $result = '';
                                for ($i=0; $i < $review["rating"]; $i++) {
                                    $result .= '<i class="fas fa-star mr-1"></i>';
                                }
                                for ($i=5; $i > $review["rating"]; $i--) {
                                    $result .= '<i class="far fa-star mr-1"></i>';
                                }
                                echo $result;
                                ?>
                            </div>
                            <p><?php echo $review["review"]; ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p>No reviews added yet</p>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <?php
                    if ($isPurchased == true):
                    ?>
                    <h4 class="mb-4">Leave a review</h4>
                    <form method="POST" action="javascript:;" id="reviewForm">
                        <div class="my-3">
                            <p class="mb-2">Your Rating</p>
                            <div class="text-primary">
                                <div>
                                    <input type="radio" name="rating" value="5" checked>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div>
                                    <input type="radio" name="rating" value="4">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div>
                                    <input type="radio" name="rating" value="3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div>
                                    <input type="radio" name="rating" value="2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div>
                                    <input type="radio" name="rating" value="1">
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Your Review</label>
                            <textarea id="review" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-0">
                            <input type="submit" value="Leave Your Review" class="btn btn-primary text-white px-3">
                            <span id="reviewMsg" style="padding-left: 20px;"></span>
                        </div>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    <script type="text/javascript">
        function copyToClipboard(element) {
            var text = $(this).data("link");
            alert(text);
            $("body").append(text);
            text.val($(element).text()).select();
            document.execCommand("copy");
            text.remove();
        }
    </script>