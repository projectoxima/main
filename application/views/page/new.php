<div class="content">
    <div class="page-header">
        <h1>Write Post</h1>
    </div>
    <!-- start -->
    <form method="post" id="validate" action="<?php echo base_url(); ?>/page/save">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="block">
                    <div class="data-fluid">                                
                        <div class="row-form">
                            <div class="col-md-3">Page Title:</div>
                            <div class="col-md-9"><input type="text" class="validate[required]" name="judul_post" placeholder="page title"/></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end -->
        <div class="row">
            <div class="col-md-12">   
                <div class="block">
                    <div class="data-fluid">
                        <textarea name="editor1" id="editor1" rows="10" cols="80">
                            This is my textarea to be replaced with CKEditor.
                        </textarea>
                    </div>
                </div>
            </div>
        </div>  
    </form>                     
</div>

<script src="<?php echo base_url(); ?>assets/js/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor1' );
</script> 