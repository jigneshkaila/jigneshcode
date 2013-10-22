<div class="col-sm-3">
    <div class="list-group">
        <a class="list-group-item active" href="#">
            Place Listing by State
        </a>
        <?php
        $this->load->helper('location_helper');
	$query = "SELECT * FROM `india_state`";
	$data = SeekLocationData($query);
        $datavalhtml = null;
        foreach ($data as $key => $row) {
            $datavalhtml .="<a class='list-group-item' href=''>" . $row->name . "</a>";
        }
        echo $datavalhtml;
        ?>      
    </div>
</div><!-- /.col-sm-4 -->