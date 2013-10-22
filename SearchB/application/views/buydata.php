<style> 
    .bs-example:after{        content: "Buy Data Online" !important;    }</style>
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
                        <input type="text" class="form-control" placeholder="Birth Date" id="datepicker" />   
                    </div>      
                </div>        
                <div class="form-group">      

                    <div class="col-lg-7">     
                        <input id="autocomplete" placeholder="Type and select multiple Categories" type="text" class="form-control">   
                    </div>     
                </div>         
                <div>   
                    <div id="accordion">   
                        <h3>Step 1</h3>   
                        <div>      
                            <p>Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.</p> 
                        </div>            
                        <h3>Step 2</h3>       
                        <div>             
                            <p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna. </p>
                        </div>       
                        <h3>Step 3</h3>     
                        <div>             
                            <p>Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui. </p>      
                            <ul>                      
                                <li>List item one</li>       
                                <li>List item two</li>           
                                <li>List item three</li>           
                            </ul>                  
                        </div>               
                        <h3>Step 4</h3>         
                        <div>                   
                            <p>Cras dictum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia mauris vel est. </p>
                            <p>Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p> 
                        </div>     
                    </div>    
                    <div class="form-group">
                        <div class="col-lg-7">  
                        </div>     
                    </div>         
                    <div class="form-group">  
                        <div class="col-lg-7">            
                            <button type="submit" class="btn btn-default">Submit</button> 
                        </div>                
                    </div>                
                </div>   
            </form> 
        </div>
        <?php $this->load->view('Element/List_by_city'); ?> 
    </div>
</div>
<?php $this->load->view('Element/jsfunction.php') ?>
