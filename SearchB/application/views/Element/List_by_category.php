<div class="col-sm-3">
    <div class="list-group">
        <a class="list-group-item active" href="#">
            Place Listing by Category
        </a>
        <?php
        $newdb = $this->load->database('default', TRUE);
        $q = $newdb->query("SELECT * FROM `category` LIMIT 0 , 10");
        //$query = $this->db->query('SELECT * FROM wp_posts');
        $datavalhtml = null;
        foreach ($q->result() as $key => $row) {
            $datavalhtml .="<a class='list-group-item' href=''><span class='badge pull-right'>777158</span>" . $row->name . "</a>";
        }
        echo $datavalhtml;
        ?>      
    </div>
</div><!-- /.col-sm-4 -->