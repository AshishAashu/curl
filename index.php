<?php
	session_start();
	ini_set('display_errors',0);
?>
<html>
	<head>
		<title>
			ClientSearch tag				
		</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/b>
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<header class="container">
		<div class="row" style="margin-top: 0.5%;">
			<form class="form-inline col-sm-offset-2" method="post">
				<div class="form-group">
					<input type="text" name="keyword" placeholder="What you want to search...."  
						   class="form-control col-md-6 " 
						   <?php
						   	if(!empty($_POST))
								echo 'value ="'.$_POST["keyword"].'"';
							?>
						   required/>	
				</div>
				<div class="form-group">
					<!--<select name="which" class="form-control col-md-2">
						<option value="">---select Choice---</option>
						<option value="th">Top Headlines</option>
						<option value="all">All news</option>
					</select>-->
					<button type="submit" class="form-control">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>
				</div>
			</form>
			<?php
			if(!empty($_SESSION['result'])){
				?>
			<div style="display: block;">
				<a href="?key=sessionout" ><button class="btn btn-success">Clear Search</button></a>
			</div>
			<?php
			}
			?>
		</div>
		</header>
		<?php
		include "FilterOnResult.php";
		if(empty($_SESSION['result'])){
			if(!empty($_POST)){		
				include "curlrequest.php";
				$creq = new CurlRequest;
				$_SESSION['result']=$creq->makeRequest($_POST['keyword']);
				$for = new FilterOnResult;
				echo $for->setDefaultResult($_SESSION['result']);
			}
		}else{
			//var_dump( $_SESSION['result']);
			if(!empty($_GET) && $_GET['key'] == 'sessionout'){
				echo "Session Destroy";
				session_destroy();
				header("Location: http://localhost/Pra/");
			}
		}
		if(!empty($_SESSION['result'])){
			$res = $_SESSION['result'];
			//var_dump($_SESSION['result']);
		?>		
		<div class="container">
			<?php
				include "filter.php";
			?>
		</div>
		<section>
			<div id="newsdiv" class="container panel panel-default">
				<?php
			//var_dump($res);
				foreach($res as $key=>$val){
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
				?>
			</div>
		</section>
		<?php
			}
		?>
	</body>	
</html>
