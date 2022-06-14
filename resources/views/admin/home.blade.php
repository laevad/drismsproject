






<!-- main content -->
<div class="main-content">
    <div class="page-header">
        <button type="button" class="btn btn-primary btn-icon pull-right ml-5" data-toggle="modal" data-target="#create"><i class=" mdi mdi-account-plus-outline"></i> Add Student </button>
        <button type="button" class="btn btn-success btn-icon pull-right toggle-search"><i class=" mdi mdi-filter-outline"></i> Filter & Search </button>
        <h3>Students</h3>
    </div> 
    <!-- page content -->
 

    <div class="row"> 
        <!-- search & Filter -->
        <div class="col-md-12 search-filter" style="display: none;">
            <div class="card">
                <form class="row" action="" method="GET">
                    <div class="col-md-4">
                            <div class="form-group">
                            <label>Search Name, Email or Phone</label>
                            <input type="text" class="form-control" placeholder="Search Name, Email or Phone" name="search">
                            </div>
                    </div>
                    <div class="col-md-2">
                            <div class="form-group">
                                <label for="email">Progress</label>
                                <select class="form-control" name="status">
                                    <option value="0">Select Progress*</option>
                                    <option value="All">All</option>
                                    <option value="Complete">Complete</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="New">New</option>
                                </select>
                            </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="email">Fees</label>
                            <select class="form-control" name="istatus"> 
                                <option value="0">Select Fee Category*</option>
                                <option value="All">All</option>
                                <option value="Paid">Paid</option>
                                <option value="Partially">Partially</option>
                                <option value="Updaid">Unpaid</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                            <div class="form-group">
                            <label for="email">Gender</label>
                            <select class="form-control" name="gender">
                                <option value="">Select Gender*</option>
                                <option value="">All</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-icon btn-block" type="submit"><i class=" mdi mdi-filter-outline"></i> Search</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</div>
