<!-- Modal -->
<div class="modal fade" id="newQuestionModal" tabindex="-1" aria-labelledby="newQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newQuestionModalLabel">Start a new discussion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php  echo $_SERVER['REQUEST_URI']; ?>" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Thread Title</label>
                        <input type="text" class="form-control" id="thread_title" name="thread_title" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Please be brief and crisp.</div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Thread description</label>
                        <textarea class="form-control" id="thread_desc" name="thread_desc" rows="3"></textarea>
                    </div>
                    <!-- <input type="hidden" name="user_id" value="<?php  echo $_SESSION['user_id']; ?>"> -->


                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>