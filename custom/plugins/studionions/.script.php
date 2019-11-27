<?php
ob_start();
?>
<script type="text/javascript">	

</script>
<style>
	select[size],
	.inputCell select[size] {
		min-height: 2.3076923em;
		height: unset;
	}
</style>
<?php
$script = ob_get_contents();
ob_end_clean();
?>