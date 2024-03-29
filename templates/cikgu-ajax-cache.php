<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function(){
		var tn = 'cikgu';

		/* data for selected record, or defaults if none is selected */
		var data = {
			ditambahOleh: <?php echo json_encode(array('id' => $rdata['ditambahOleh'], 'value' => $rdata['ditambahOleh'], 'text' => $jdata['ditambahOleh'])); ?>,
			adminID: <?php echo json_encode(array('id' => $rdata['adminID'], 'value' => $rdata['adminID'], 'text' => $jdata['adminID'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for ditambahOleh */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'ditambahOleh' && d.id == data.ditambahOleh.id)
				return { results: [ data.ditambahOleh ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for adminID */
		cache.addCheck(function(u, d){
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'adminID' && d.id == data.adminID.id)
				return { results: [ data.adminID ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

