<?php
	class FilterOnResult{
	
		public function setDefaultResult($posts){
			$myResult = array();
			foreach($posts as $key=>$val){
				if($key == "posts"){
					foreach($val as $k1=>$v1){
						$tarr = array();
						$tarr['img_url'] = $v1['thread']['main_image'];
						$tarr['title'] = $v1['thread']["title"];
						$tarr['site_news_url'] = $v1['thread']['site_section'];
						$tarr['description'] = $v1['text'];
						$tarr['fb_likes'] = $v1['thread']['social']['facebook']['likes'];
						$tarr['resource'] = $v1['thread']['site_full'];
						$tarr['resource_title'] = $v1['thread']['section_title'];
						$tarr['by_country'] = $v1['thread']['country'];
						$tarr['site_type'] = $v1['thread']['site_type'];
						$tarr['domain_rank'] = $v1['thread']['domain_rank'];
						$tarr['publised_on'] = $v1['thread']['published'];
						array_push($myResult,$tarr);
					}
				}
			}
			$_SESSION['result'] = $myResult;
		}
		public function printArray($key,$val){
			if(is_array($val)){
				foreach($val as $k=>$v){
					self::printArray($k,$v);	
				}
			}else{
				echo "<br>".$key.":".$val;
			}
		}
		public function getNewsResources($arr){
			$tarr = array();
			foreach($arr as $k=>$v){
				foreach ( $v as $k1=>$v1){
					if($k1== 'resource_title' && $v1!= NULL && !in_array($v1,$tarr)){
						array_push($tarr,$v1);	
					}
				}	
			}
			return $tarr;
		}
		
		public function filterNews($key,$value){
			if(!isset($_SESSION)) { session_start(); }
			if($key!='default'){
				$tarr = array();
				$arr = $_SESSION['result'];
				foreach($arr as $k1=>$val){
					foreach($val as $k=>$v){
						if($k == $key && $v==$value)
							array_push($tarr,$val);
					}
				}
				return $tarr;
			}else{
				return $_SESSION['result'];
			}
		}			
	}	
	
	if(count($_POST)>0){
		$obj = new FilterOnResult;
		$tarr = $obj->filterNews($_POST['key'],$_POST['filter']);
		echo "<h3 class='text-info'>News Filter On:".$_POST['filter']."</h3>"; 
		foreach($tarr as $key=>$val){
?>				
			<div class="row panel-body">
				<div class="col-md-3">
					<img src="<?php echo $val['img_url'];?>" class="img-responsive img-thumbnail"/>
				</div>
				<div class="col-md-9">
					<h3><?php echo $val['title'];?></h3>
					<p style="font-weight: bold;">Published On: 
						<span class="text-danger"><?php echo $val['publised_on'];?></span>
					</p>
					
					<p class="pull-right">From:<span class="text-info"><?php echo $val['resource_title'];?></span></p>
					<div class="">
						<a href="<?php echo $val['site_news_url'];?>" target="_blank" 
					    style="display:block;">
						Go To Source
						</a>
						<span class="text-success">By : <?php echo $val['by_country'];?></span>
						<span class="text-danger pull-right">Facebook  Likes:
						<label class="badge">
							<?php echo $val['fb_likes'];?>
						</label>
						</span>
					</div>
					<p><?php echo $val["description"];?></p>
				</div>
			</div>
		<?php					
			}
		}
	?>