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
        <div class="col-lg-6">  
            <?php
            $Html = "";
          if(is_array($results) && !empty($results)) {
            foreach ($results as $data) {
                //print_r($data);
                echo "<div class='panel panel-default'>";
                echo "<div class='panel-heading'>" . $data->business_name . "</div>";
                echo "<div class='panel-body'>";
                echo "<div class='col-sm-5'>";
                if (isset($data->address) && !empty($data->address)) {
                    echo $data->address . "<br/><br/>";
                }
                if (isset($data->phone_number) && !empty($data->phone_number)) {
                    echo $data->phone_number . "<br/><br/>";
                }
                if (isset($data->fax) && !empty($data->fax)) {
                    echo $data->fax . "<br/><br/>";
                }
                if (isset($data->website) && !empty($data->website)) {
                    echo $data->website . "<br/><br/>";
                }
                if (isset($data->email_id) && !empty($data->email_id)) {
                    echo $data->email_id . "<br/><br/>";
                }
                if (isset($data->g_review_count) && !empty($data->g_review_count)) {
                    echo "Total Reviws: " . $data->g_review_count . "<br/><br/>";
                }
                if (isset($data->rating_count) && !empty($data->rating_count)) {
                    echo "Rating: " . $data->rating_count . "<br/><br/>";
                }
                echo "</div>";
                echo "<div class='col-sm-2'>";
                if (isset($data->image_name) && !empty($data->image_name)) {
                    $image_url = "http://alljob.org/search_bussiness/image/" . $data->image_name;
                    echo "<a class=''><img src='" . $image_url . "' height='100' width='100'><br/></a>";
                } else {
                    $image_url = "http://alljob.org/search_bussiness/image/NoImageAvailableLarge.jpg";
                    echo "<a class=''><img src='" . $image_url . "' height='100' width='100'><br/></a>";
                }
                echo "</div>";
                echo "</div></div>";
            }
          }else{
          	echo "Result is not found..!";
          }
           // echo $links;
            ?>
        </div>
        <?php $this->load->view('Element/List_by_category') ?>
        <?php $this->load->view('Element/List_by_city'); ?>
    </div>
</div>
<?php $this->load->view('Element/jsfunction.php') ?>