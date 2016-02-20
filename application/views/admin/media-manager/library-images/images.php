<style type="text/css">
	#kcfinder_iframe { height: 350px; width: 100%; }
</style>
<div class="panel panel-default">
  	<div class="panel-heading">File manager</div>
  	<div class="panel-body">
        <div class="kc-outer">
            <iframe name="kcfinder_iframe" id="kcfinder_iframe" src="<?php echo base_url(); ?>file_manager/browse.php?type=<?php echo $kc_browser_type; ?>" frameborder="0" width="100%" height="100%" marginwidth="0" marginheight="0" scrolling="no"></iframe>
        </div>
    </div>
</div>