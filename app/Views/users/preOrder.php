


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 150px">
            <h1 class="font-weight-semi-bold text-uppercase my-3">Pre-Order</h1>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 mb-5">
                <form method="POST" action="<?php echo site_url('customProduct'); ?>" id="customProductForm" novalidate="novalidate" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6 form-group">
                            <label class="text-dark">Name</label>
                            <input class="form-control" type="text" name="name" id="customProductName" oninput="this.className='form-control'" placeholder="John">
                        </div>
                        <div class="col-6 form-group">
                            <label class="text-dark">Email</label>
                            <input class="form-control" type="email" name="email" id="customProductEmail" oninput="this.className='form-control'" placeholder="example@email.com">
                        </div>
                        <div class="col-6 form-group">
                            <label class="text-dark">Mobile</label>
                            <input class="form-control" type="text" name="contact" id="customProductContact" oninput="this.className='form-control'" placeholder="+123 456 789">
                        </div>
                        <div class="col-6 form-group">
                            <label class="text-dark">Alternate Mobile (Optional)</label>
                            <input class="form-control" type="text" name="contact2" id="customProductContact2" oninput="this.className='form-control'" placeholder="+123 456 789">
                        </div>
                        <div class="col-6 form-group">
                            <label class="text-dark">Address Line 1</label>
                            <input class="form-control" type="text" name="address" id="customProductAddress" oninput="this.className='form-control'" placeholder="House No., Building Name">
                        </div>
                        <div class="col-6 form-group">
                            <label class="text-dark">Address Line 2 (Optional)</label>
                            <input class="form-control" type="text" name="address2" id="customProductAddress2" placeholder="Road Name, Area, Colony">
                        </div>
                        <div class="col-6 form-group">
                            <label class="text-dark">City</label>
                            <input class="form-control" type="text" name="city" id="customProductCity" oninput="this.className='form-control'" placeholder="Albany">
                        </div>
                        <div class="col-6 form-group">
                            <label class="text-dark">State</label>
                            <input class="form-control" type="text" name="state" id="customProductState" oninput="this.className='form-control'" placeholder="New York">
                        </div>
                        <div class="col-6 form-group">
                            <label class="text-dark">Country</label>
                            <input class="form-control" type="text" name="country" id="customProductCountry" oninput="this.className='form-control'" placeholder="United States">
                        </div>
                        <div class="col-6 form-group">
                            <label class="text-dark">ZIP Code</label>
                            <input class="form-control" type="text" name="zipcode" id="customProductZipcode" oninput="this.className='form-control'" placeholder="12345">
                        </div>
                        <div class="col-6 form-group">
                            <label class="text-dark">Upload <small>(Only JPG/PNG images)</small></label>
                            <input class="form-control" type="file" name="images[]" id="customProductImage"  oninput="this.className='form-control'" accept="image/jpg, image/jpeg, image/png" multiple>
                        </div>
                    </div>
                    <div class="my-4">
                        <button id="customProductFormBtn" class="btn btn-primary text-white py-2 px-4" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <style type="text/css">
        .form-control.required {
            border: 1px solid #ff0000;
        }
    </style>