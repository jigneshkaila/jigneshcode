<style>
    .bs-example:after{
        content: "Register" !important;
    }
</style>
<?php $this->load->view('Element/header') ?>
<?php $this->load->view('Element/menu') ?>
<div class="container">
    <div class="row">
        <?php $this->load->view('Element/List_by_category') ?>
        <div class="col-lg-6">  
            <form class="form-horizontal bs-example" role="form">
                <div class="form-group">
                    <div class="col-lg-7">
                        <input type="text" class="form-control" id="inputText" placeholder="Full Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-7">
                        <input type="email" class="form-control" id="inputEmail1" placeholder="Your Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-7">
                        <input type="email" class="form-control" id="inputEmail1" placeholder="Re-enter Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-7">
                        <input type="password" class="form-control" id="inputPassword1" placeholder="New Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-7">
                        <input type="text" class="form-control" placeholder="Birth Date" id="datepicker" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-7">
                        <div id="radio">
                            <input type="radio" id="Male" name="Gender" /><label for="Male">Male</label>
                            <input type="radio" id="Female" name="Gender" /><label for="Female">Female</label>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>
                <form>
                </form>
        </div>
        <?php $this->load->view('Element/List_by_city'); ?>
    </div>
</div>
<?php $this->load->view('Element/jsfunction.php') ?>

