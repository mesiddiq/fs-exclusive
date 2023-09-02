


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 150px">
            <h1 class="font-weight-semi-bold text-uppercase my-3">Contact</h1>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Have any questions or concerns?</span></h2>
            <p class="pt-2">We’re always ready to help!</p>
            <h5 class="font-weight-semi-bold mb-3">WhatsApp</h5>
            <p class="mb-1"><strong>UK: </strong><a href="https://wa.me/+4474243785566" target="_blank" style="color: #6F6F6F;">+44 - 74243785566</a></p>
            <p><strong>Malaysia: </strong><a href="https://wa.me/+60124706810" target="_blank" style="color: #6F6F6F;">+60 - 124706810</a></p>
            <h5 class="font-weight-semi-bold mb-3">Email</h5>
            <p><a href="mailto:info@fsexclusive.com" style="color: #6F6F6F;">info@fsexclusive.com</a></p>
            <h5 class="font-weight-semi-bold mb-3">or</h5>
            <p>Please fill out the contact form below</p>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="row">
                            <div class="col-12">
                                <div class="control-group">
                                    <input type="text" class="form-control" id="contactName" oninput="this.className = 'form-control'" placeholder="Name"
                                        required="required" data-validation-required-message="Please enter your name" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="control-group">
                                    <input type="email" class="form-control" id="contactEmail" oninput="this.className = 'form-control'" placeholder="Email"
                                        required="required" data-validation-required-message="Please enter your email" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="control-group">
                                    <input type="text" class="form-control" id="contactPhone" oninput="this.className = 'form-control'" placeholder="Phone Number"
                                        required="required" data-validation-required-message="Please enter your phone number" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="control-group">
                                    <input type="text" class="form-control" id="contactSubject" oninput="this.className = 'form-control'" placeholder="Subject"
                                        required="required" data-validation-required-message="Please enter a subject" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="control-group">
                                    <textarea class="form-control" rows="6" id="contactMessage" oninput="this.className = 'form-control'" placeholder="Message"
                                        required="required"
                                        data-validation-required-message="Please enter your message"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary text-white py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <style type="text/css">
        .form-control.required {
            border: 1px solid #ff0000;
        }
    </style>