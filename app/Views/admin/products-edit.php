
    
        <style type="text/css">
            /* your CSS goes here*/
            input.invalid {
                border: 1px solid #dc3545;
            }
            .select-style-1 .select-position select.invalid {
                border: 1px solid #dc3545;
            }
            .tab {
                display: none
            }
            #prevBtn {
                background-color: #bbbbbb
            }
            .step {
                height: 15px;
                width: 15px;
                margin: 0 2px;
                background-color: #bbbbbb;
                border: none;
                border-radius: 50%;
                display: inline-block;
                opacity: 0.5
            }
            .step.active {
                background-color: #4a6cf7;
                opacity: 1;
            }
            .step.finish {
                background-color: #219653;
                opacity: 0.75;
            }
            .all-steps {
                text-align: center;
                margin-top: 30px;
                margin-bottom: 30px
            }
            .thanks-message {
                display: none
            }
            .container {
                display: block;
                position: relative;
                padding-left: 35px;
                margin-bottom: 12px;
                cursor: pointer;
                font-size: 22px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            /* Hide the browser's default radio button */
            .container input[type="radio"] {
                position: absolute;
                opacity: 0;
                cursor: pointer;
            }

            /* Create a custom radio button */
            .checkmark {
                position: absolute;
                top: 0;
                left: 0;
                height: 25px;
                width: 25px;
                background-color: #eee;
                border-radius: 50%;
            }

            /* On mouse-over, add a grey background color */
            .container:hover input~.checkmark {
                background-color: #ccc;
            }

            /* When the radio button is checked, add a blue background */
            .container input:checked~.checkmark {
                background-color: #2196F3;
            }

            /* Create the indicator (the dot/circle - hidden when not checked) */
            .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }

            /* Show the indicator (dot/circle) when checked */
            .container input:checked~.checkmark:after {
                display: block;
            }

            /* Style the indicator (dot/circle) */
            .container .checkmark:after {
                top: 9px;
                left: 9px;
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: white;
            }
            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Firefox */
            input[type=number] {
                -moz-appearance: textfield;
            }
        </style>
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
                            <form method="POST" id="regForm" action="<?php echo site_url('admin/products/update/'.$product['id']); ?>" enctype="multipart/form-data">
                                <div class="tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="mb-4">Product Info</h3>
                                            <div class="input-style-1">
                                                <label>Name</label>
                                                <input type="text" class="bg-transparent form-required" oninput="this.className = 'bg-transparent form-required'" name="name" placeholder="Name" value="<?php echo $product["name"]; ?>" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="select-style-1">
                                                <label>Type</label>
                                                <div class="select-position">
                                                    <select name="type" class="form-required" onchange="this.className = 'form-required'">
                                                        <option value="1" <?php echo $product["type"] == "1" ? 'selected' : ''; ?>>Simple</option>
                                                        <option value="2" <?php echo $product["type"] == "2" ? 'selected' : ''; ?>>Variable</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="select-style-1">
                                                <label>Category</label>
                                                <div class="select-position">
                                                    <select name="category" class="form-required" onchange="this.className = 'form-required'">
                                                        <?php
                                                        $categories = $this->db->table("category")->where(array("status" => 1, "parent" => NULL, "country" => $product["country"]))->get()->getResultArray();
                                                        foreach ($categories as $key => $category):
                                                        ?>
                                                        <option value="<?php echo $category['id']; ?>" <?php echo $category["id"] == $product["category"] ? 'selected' : ''; ?>><?php echo $category["name"]; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="select-style-1">
                                                <label>Size Chart</label>
                                                <div class="select-position">
                                                    <select name="sizeChart" class="form-required" onchange="this.className = 'form-required'">
                                                        <option value="1" <?php echo $product["sizeChart"] == "1" ? 'selected' : ''; ?>>Yes</option>
                                                        <option value="0" <?php echo $product["sizeChart"] == "0" ? 'selected' : ''; ?>>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-style-1">
                                                <label>Weight (grams)</label>
                                                <input type="number" class="bg-transparent form-required" oninput="this.className = 'bg-transparent form-required'" name="weight" placeholder="Weight" value="<?php echo $product["weight"]; ?>" min="1" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-style-1">
                                                <label>Short Description</label>
                                                <textarea class="bg-transparent" placeholder="Short Description" name="shortDescription" rows="5"><?php echo $product["shortDescription"]; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-style-1">
                                                <label>Description</label>
                                                <!-- <div class="form-editor-wrapper">
                                                    <div id="quill-toolbar">
                                                        <span class="ql-formats">
                                                            <select class="ql-font"></select>
                                                            <select class="ql-size"></select>
                                                        </span>
                                                        <span class="ql-formats">
                                                            <button class="ql-bold"></button>
                                                            <button class="ql-italic"></button>
                                                            <button class="ql-underline"></button>
                                                            <button class="ql-strike"></button>
                                                        </span>
                                                        <span class="ql-formats">
                                                            <select class="ql-color"></select>
                                                            <select class="ql-background"></select>
                                                        </span>
                                                        <span class="ql-formats">
                                                            <button class="ql-script" value="sub"></button>
                                                            <button class="ql-script" value="super"></button>
                                                        </span>
                                                        <span class="ql-formats">
                                                            <button class="ql-header" value="1"></button>
                                                            <button class="ql-header" value="2"></button>
                                                            <button class="ql-blockquote"></button>
                                                            <button class="ql-code-block"></button>
                                                        </span>
                                                        <span class="ql-formats">
                                                            <button class="ql-list" value="ordered"></button>
                                                            <button class="ql-list" value="bullet"></button>
                                                            <button class="ql-indent" value="-1"></button>
                                                            <button class="ql-indent" value="+1"></button>
                                                        </span>
                                                        <span class="ql-formats">
                                                            <button class="ql-direction" value="rtl"></button>
                                                            <select class="ql-align"></select>
                                                        </span>
                                                        <span class="ql-formats">
                                                            <button class="ql-link"></button>
                                                            <button class="ql-image"></button>
                                                            <button class="ql-video"></button>
                                                        </span>
                                                        <span class="ql-formats">
                                                            <button class="ql-clean"></button>
                                                        </span>
                                                    </div>
                                                    <div id="quill-editor"></div>
                                                </div> -->
                                                <style type="text/css">
                                                    .ck.ck-editor__main .ck.ck-content {
                                                        padding-left: 30px !important;
                                                        height: 200px;
                                                        overflow-y: auto;
                                                    }
                                                </style>
                                                <textarea class="bg-transparent" placeholder="Description" name="description" id="description" rows="5"><?php echo json_decode($product["description"]); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check checkbox-style mb-20">
                                                <input class="form-check-input" type="checkbox" value="1" name="isTopProduct" id="isTopProduct" <?php echo $product["isTopProduct"] == 1 ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="isTopProduct">Check if Top Product</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <?php if ($product["type"] == "1"): ?>
                                    <div class="row" id="simple-product-info">
                                        <div class="col-12">
                                            <h3 class="mb-4">Inventory Info</h3>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-style-1">
                                                <input type="number" class="bg-transparent" oninput="this.className = 'bg-transparent'" name="quantity" placeholder="Quantity" value="<?php echo $product["quantity"]; ?>" min="1" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check checkbox-style mb-20">
                                                <input class="form-check-input" type="checkbox" value="1" name="isOutOfStock" id="isOutOfStock" <?php echo $product["isOutOfStock"] == 1 ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="isOutOfStock">Check if product is out of stock</label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php elseif ($product["type"] == "2"): ?>
                                    <div class="row" id="variable-product-info">
                                        <div class="col-12">
                                            <h3 class="mb-4">Inventory Info</h3>
                                        </div>
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="select-style-1">
                                                        <label>Size</label>
                                                        <div class="select-position">
                                                            <select name="size" id="size">
                                                                <option value="">Select</option>
                                                                <?php
                                                                $sizes = $this->db->table("productattributesvariants")->where(array("status" => 1, "category" => 1))->get()->getResultArray();
                                                                foreach ($sizes as $key => $size):
                                                                ?>
                                                                <option value="<?php echo $size['id']; ?>"><?php echo $size["name"]; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="select-style-1">
                                                        <label>Color</label>
                                                        <div class="select-position">
                                                            <select name="color" id="color">
                                                                <option value="">Select</option>
                                                                <?php
                                                                $colors = $this->db->table("productattributesvariants")->where(array("status" => 1, "category" => 2))->get()->getResultArray();
                                                                foreach ($colors as $key => $color):
                                                                ?>
                                                                <option value="<?php echo $color['id']; ?>"><?php echo $color["name"]; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-5">
                                                    <button type="button" class="btn primary-btn" id="addAttributeBtn">Add Attribute</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <?php
                                            $variants = $this->db->table("productvariants")->where("productId", $product["id"])->get()->getResultArray();
                                            ?>
                                            <div class="input-style-1 mb-0">
                                                <label>Variants (<span id="variantsCount"><?php echo count($variants); ?></span>)</label>
                                            </div>
                                            <div class="accordion" id="accordionExample">
                                                <?php
                                                $editProductVariant = array();
                                                foreach ($variants as $key => $variant):
                                                $size = $this->db->table("productattributesvariants")->where("id", $variant["size"])->get()->getRow()->name;
                                                $color = $this->db->table("productattributesvariants")->where("id", $variant["color"])->get()->getRow()->name;
                                                array_push($editProductVariant, $variant["tempId"]);
                                                ?>
                                                <div class="accordion-item mb-3" style="border: 1px solid rgba(0, 0, 0, .125);">
                                                    <h2 class="accordion-header" id="heading<?php echo $variant['id']; ?>">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $variant['id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $variant['id']; ?>">
                                                        <?php echo $size . "/" . $color; ?>
                                                        </button>
                                                    </h2>
                                                    <div id="collapse<?php echo $variant['id']; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <input type="hidden" name="id" value="<?php echo $variant['id']; ?>" />
                                                            <input type="hidden" name="productId" value="<?php echo $variant['productId']; ?>" />
                                                            <div class="col-6">
                                                                <div class="input-style-1">
                                                                    <label>Quantity</label>
                                                                    <input type="number" class="bg-transparent" name="quantity" id="quantity<?php echo $variant['id']; ?>" placeholder="Quantity" value="<?php echo $variant['quantity']; ?>" min="0" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <button type="button" class="btn primary-btn" id="productVariantUpdateBtn" data-id="<?php echo $variant['id']; ?>">Update</button>
                                                                <button type="button" class="btn danger-btn" id="productVariantDeleteBtn" data-id="<?php echo $variant['id']; ?>">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>
                                                <?php $this->session->set("productVariants", $editProductVariant); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="mb-4">Price Info</h3>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-style-1">
                                                <label>Price</label>
                                                <input type="number" class="bg-transparent form-required" oninput="this.className = 'bg-transparent form-required'" name="price" placeholder="Price" value="<?php echo $product["price"]; ?>" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <?php if ($product["isDiscount"] == 1): ?>
                                            <div class="input-style-1 special-price" style="display: block;">
                                            <?php else: ?>
                                            <div class="input-style-1 special-price" style="display: none;">
                                            <?php endif; ?>
                                                <label>Special Price</label>
                                                <input type="number" class="bg-transparent" oninput="this.className = 'bg-transparent form-required'" name="discountedPrice" placeholder="Special Price" value="<?php echo $product["discountedPrice"]; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-check checkbox-style mb-20">
                                                <input class="form-check-input" type="checkbox" value="1" name="isDiscount" id="isDiscount" <?php echo $product["isDiscount"] == 1 ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="isDiscount">Check if special price is applicable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="mb-4">Media</h3>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-style-1">
                                                <label>Product Image</label>
                                                <input type="file" class="bg-transparent" oninput="this.className = 'bg-transparent'" name="image[]" placeholder="Price" multiple />
                                            </div>
                                        </div>
                                        <?php
                                        $images = $this->db->table("productimages")->where("productId", $product["id"])->get()->getResultArray();
                                        if (count($images) > 0):
                                        foreach ($images as $key => $image): ?>
                                        <div class="col-3 mb-4 text-center" id="image<?php echo $image['id']; ?>">
                                            <img src="<?php echo site_url("uploads/products/".$image['name']) ?>" class="img-fluid px-2 py-2 border">
                                            <div class="row">
                                                <div class="col-4">
                                                    <a href="javascript:;" class="deleteProductImage" data-imageid="<?php echo $image["id"]; ?>"><button type="button" class="btn danger-btn mt-2"><small>Delete</small></button></a>
                                                </div>
                                                <div class="col-8 text-end">
                                                    <?php if ($image["featured"] == 1): ?>
                                                    <a href="javascript:;"><button type="button" class="btn success-btn mt-2"><small><i class="lni lni-checkmark"></i> Featured</small></button></a>
                                                    <?php else: ?>
                                                    <a href="javascript:;" class="setImageFeatured" data-imageid="<?php echo $image["id"]; ?>" data-productid="<?php echo $image["productId"]; ?>"><button type="button" class="btn primary-btn mt-2"><small>Set Featured</small></button></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="mb-4">Status</h3>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check radio-style mb-20">
                                                <input class="form-check-input" type="radio" value="0" name="status" id="status0" <?php echo $product["status"] == 0 ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="status0">Pending</label>
                                            </div>
                                            <div class="form-check radio-style mb-20">
                                                <input class="form-check-input" type="radio" value="1" name="status" id="status1" <?php echo $product["status"] == 1 ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="status1">Publish</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab"></div>
                                <div style="overflow:auto;" id="nextprevious">
                                    <div style="float:right;"> <button type="button" id="prevBtn" class="main-btn primary-btn btn-hover" onclick="nextPrev(-1)">Previous</button> <button type="button" class="main-btn primary-btn btn-hover" id="nextBtn" onclick="nextPrev(1)">Next</button> </div>
                                </div>
                                <div class="all-steps" id="all-steps"> <span class="step"></span> <span class="step"></span> <span class="step"></span> <span class="step"></span> <span class="step"></span> </div>
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

        <script type="text/javascript">
            // your javascript goes here
            // var description = "<?php echo json_decode($product['description']); ?>";
            document.addEventListener("DOMContentLoaded", function () {
                const editor = new Quill("#quill-editor", {
                    modules: {
                        toolbar: "#quill-toolbar",
                    },
                    placeholder: "Type something",
                    theme: "snow",
                });
                editor.container.firstChild.innerHTML = description;
                editor.on('text-change', function(delta, oldDelta, source) {
                    if (source == 'api') {
                        console.log("An API call triggered this change.");
                    } else if (source == 'user') {
                        var text = editor.root.innerHTML;
                        document.getElementById('description').innerHTML = text;
                    }
                });
            });


            var currentTab = 0;
            document.addEventListener("DOMContentLoaded", function(event) {
                showTab(currentTab);
            });

            function showTab(n) {
                console.log(n);
                var x = document.getElementsByClassName("tab");
                x[n].style.display = "block";

                if (n == 0) {
                    document.getElementById("prevBtn").style.display = "none";
                } else {
                    document.getElementById("prevBtn").style.display = "inline";
                }

                if (n == 5) {
                    document.getElementById("nextBtn").innerHTML = "Submit";
                    document.getElementById("nextBtn").setAttribute("type", "submit");
                } else {
                    document.getElementById("nextBtn").innerHTML = "Next";
                    document.getElementById("nextBtn").setAttribute("type", "button");
                }
                fixStepIndicator(n)
            }

            function nextPrev(n) {
                var x = document.getElementsByClassName("tab");
                if (n == 1 && !validateForm()) return false;
                x[currentTab].style.display = "none";
                currentTab = currentTab + n;
                if (currentTab >= x.length) {
                    document.getElementById("nextprevious").style.display = "none";
                    document.getElementById("all-steps").style.display = "none";
                    document.getElementById("register").style.display = "none";
                    document.getElementById("text-message").style.display = "block";
                }
                showTab(currentTab);
            }

            function validateForm() {
                var x, y, i, valid = true;
                x = document.getElementsByClassName("tab");
                y = x[currentTab].getElementsByClassName("form-required");
                for (i = 0; i < y.length; i++) {
                    if (y[i].value == "") {
                        y[i].className += " invalid";
                        valid = false;
                    }
                }

                if (valid) {
                    document.getElementsByClassName("step")[currentTab].className += " finish";
                }

                return valid;
            }

            function fixStepIndicator(n) {
                var i, x = document.getElementsByClassName("step");
                for (i = 0; i < x.length; i++) { x[i].className = x[i].className.replace(" active", ""); }
                x[n].className += " active";
            }
        </script>