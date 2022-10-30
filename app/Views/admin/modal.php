

        <script type="text/javascript">
            function deleteModal(deleteURL) {
                jQuery('#deleteModal').modal('show', {backdrop: 'static'});
                document.getElementById('deleteLink').setAttribute('href' , deleteURL);
            }
        </script>

        <!-- Delete Modal Start -->
        <div class="warning-modal">
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content card-style warning-card text-center">
                        <div class="modal-body">
                            <div class="icon text-danger mb-20">
                                <i class="lni lni-warning"></i>
                            </div>
                            <div class="content mb-30">
                                <h2 class="mb-15">Do you want to delete?</h2>
                            </div>
                            <div class="action d-flex flex-wrap justify-content-center">
                                <a href="javascript:;" id="deleteLink" class="main-btn danger-btn rounded-full btn-hover m-1">Delete</a>
                                <button data-bs-dismiss="modal" class="main-btn primary-btn rounded-full btn-hover m-1">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Modal End -->