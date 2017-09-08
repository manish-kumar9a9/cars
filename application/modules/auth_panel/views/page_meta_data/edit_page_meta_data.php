<section class="panel">
<header class="panel-heading">
<?php echo $this->session->flashdata('success'); ?>
     Edit Meta Data
</header>
        <div class="panel-body">
            <form role="form" action="" method="post" autocomplete="off">
                <div class="form-group">
                    <label for="page_name">Page Name</label>
                    <select class="form-control m-bot15" id="page_name" name="page_name">
                    <option value="ALL_REQUESTS">Select page name</option>
            
                    <?php foreach($page_name as $name){ ?>
                    <option value="<?php echo $name['page_name']; ?>" id="page_name" name="page_name"><?php echo $name['page_name']; ?></option>
                    <?php } ?> 
                    </select>
                </div>
                <div class="form-group">
                    <label for="page_meta_data">Meta Data</label>
                    <textarea class="form-control" name="page_meta_data" id="page_meta_data" cols="50"></textarea>
                </div>
                <button type="submit" class="btn btn-info">Submit</button>
            </form>

        </div>
        </section>

        <?php
$adminurl = AUTH_PANEL_URL;
$custum_js = <<<EOD
               <script type="text/javascript" language="javascript" >
               $('#page_name').change(function(){
                var page_name = $('#page_name').val();
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    data: {'page_name':page_name},
                    url:"$adminurl"+"page_meta_data/get_page_meta_data",
                    success: function(data){
                        if(data.isSuccess){
                            $('textarea#page_meta_data').val(data.result);
                        }
                    }
                });
               });
               </script>

EOD;

    echo modules::run('auth_panel/template/add_custum_js',$custum_js );
?>