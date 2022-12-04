
    
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
                        <div class="card-style mb-30">
                            <form method="POST" action="<?php echo site_url('admin/refund-policy/update'); ?>" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-style-1">
                                                <div class="form-editor-wrapper">
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
                                                            <select class="ql-align"></select>
                                                        </span>
                                                        <span class="ql-formats">
                                                            <button class="ql-link"></button>
                                                        </span>
                                                        <span class="ql-formats">
                                                            <button class="ql-clean"></button>
                                                        </span>
                                                    </div>
                                                    <div id="quill-editor"></div>
                                                </div>
                                                <textarea class="d-none" name="refundPolicy" id="refundPolicy" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="main-btn primary-btn btn-hover">Submit</button>
                                        </div>
                                    </div>
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

        <script type="text/javascript">
            // your javascript goes here
            var refundPolicy = "<?php echo json_decode(getSettings("refundPolicy")); ?>";
            document.addEventListener("DOMContentLoaded", function () {
                const editor = new Quill("#quill-editor", {
                    modules: {
                        toolbar: "#quill-toolbar",
                    },
                    placeholder: "Type something",
                    theme: "snow",
                });
                editor.container.firstChild.innerHTML = refundPolicy;
                editor.on("text-change", function(delta, oldDelta, source) {
                    if (source == "api") {
                        console.log("An API call triggered this change.");
                    } else if (source == "user") {
                        var text = editor.root.innerHTML;
                        document.getElementById("refundPolicy").innerHTML = text;
                        console.log(editor.root.innerHTML);
                    }
                });
            });
        </script>