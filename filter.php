<div>
	<h3>Filter News:</h3>
	<div class="row">
	<span class="col-md-1 text-info">By News:</span>		
	<select class="col-md-3 btn" id="newsfilter">
		<option value="default">--Default Views--</option>
		<?php
			require_once "FilterOnResult.php";
			$obj = new FilterOnResult;
			$fres = $_SESSION['result'];
			$fres = $obj->getNewsResources($fres);
			foreach($fres as $k=>$v){
		?>
		<option><?php echo $v;?></option>
		<?php
			}
		?>
	</select>
	</div>
	
	<script>
		$("document").ready(function(){
			$("#newsfilter").change(function(){
				var x = $(this).val();
				$.ajax({
					url: "FilterOnResult.php",
					type: "post",
					data: {"key":"resource_title","filter": x},
					success: function(res){
							$("#newsdiv").html(res);
						}
				});	
			});
		});
	</script>
</div>	