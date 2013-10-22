<style>
    .bs-example:after {
        content: "Search Box" !important;
    }
</style>
<?php $this->load->view('Element/header') ?>
<?php $this->load->view('Element/menu') ?>
<div class="container">
    <?php $this->load->view('SearchForm') ?>
    <div class="row">
        <div class="col-lg-12">  
            <head><?php echo $map['js']; ?></head>
<body><?php echo $map['html']; ?></body>
        </div>
    </div>
</div>
<?php $this->load->view('Element/jsfunction.php') ?>