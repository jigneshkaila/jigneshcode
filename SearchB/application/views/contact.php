<style>
    .bs-example:after{
        content: "Contact Us" !important;
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
                        <input type="text" class="form-control" id="inputEmail1" placeholder="Full Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-7">
                        <input type="email" class="form-control" id="inputEmail1" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-7">
                        <input type="text" class="form-control" id="inputEmail1" placeholder="Subject">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-7">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <?php $this->load->view('Element/List_by_city'); ?>
    </div>
</div>
<?php $this->load->view('Element/jsfunction.php') ?>