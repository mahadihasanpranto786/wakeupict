<!-- Modal -->
<div class="modal fade" id="admitted-student-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                <button type="button" class="close closeDetails" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('batchWiseStudent') }}" method="GET">
                    @csrf
                    <input hidden type="text" id="CourseId" name="course_id" value="course_id">
                    <input hidden type="text" id="BatchId" name="batch_id" value="batch_id">
                    <button class="btn btn-info btn-sm flex items-center showStudents float-right m-2">Show Students
                    </button>
                </form>
                <div class="row">
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <div class="row">
                                <div class="col-md-5">
                                    <th scope="col">Course Name</th>
                                </div>
                                <div class="col-md-9">
                                    <th id="courseName"></th>
                                </div>
                            </div>
                        </tr>
                        <tr>
                            <div class="row">
                                <div class="col-md-5">
                                    <th scope="col">Batch Number</th>
                                </div>
                                <div class="col-md-9">
                                    <th id="batchNong"></th>
                                </div>
                            </div>
                        </tr>
                        <tr>
                            <div class="row">
                                <div class="col-md-5">
                                    <th scope="col">Total Student</th>
                                </div>
                                <div class="col-md-9">
                                    <th id="totalStuent"></th>
                                </div>
                            </div>
                        </tr>
                        <tr>
                            <div class="row">
                                <div class="col-md-5">
                                    <th scope="col">Total Amount</th>
                                </div>
                                <div class="col-md-9">
                                    <th id="totalAmount"></th>
                                </div>
                            </div>
                        </tr>
                        <tr>
                            <div class="row">
                                <div class="col-md-5">
                                    <th scope="col">Total Paid Amount</th>
                                </div>
                                <div class="col-md-9">
                                    <th id="totalPaid"></th>
                                </div>
                            </div>
                        </tr>
                        <tr>
                            <div class="row">
                                <div class="col-md-5">
                                    <th scope="col">Total Due Amount</th>
                                </div>
                                <div class="col-md-9">
                                    <th id="totalDue"></th>
                                </div>
                            </div>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeDetails" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
