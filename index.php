<html>
	<head>
		<title>
			ClientSearch				
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
				<!--<span>Login With Facebook</span>
				<div class="form-group">
					<input type="text" name="email" placeholder="Enter your facebook email..."  
						   class="form-control col-md-6 "required/>	
				</div>
				<div class="form-group">
					<input type="password" name="pass" placeholder="Enter your facebook password..."  
						   class="form-control col-md-6 " required/>	
				</div>-->
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
					<select name="which" class="form-control col-md-2">
						<option value="">---select Choice---</option>
						<option value="th">Top Headlines</option>
						<option value="all">All news</option>
					</select>
					<button type="submit" class="form-control">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>
				</div>
			</form>
		</div>
		</header>
		<?php
			if(!empty($_POST)){		
		?>
		<section>
			<div class="container panel panel-default">
		<?php	
				/*$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, 'https://www.google.co.in');
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_HEADER, 0);
				$result = curl_exec($curl);
				echo $result;*/
				$_POST['keyword'] = preg_replace('/\s+/', '', $_POST['keyword']);
				$curl = curl_init();
				$url = "https://newsapi.org/v2/";
				switch($_POST['which']){
					case 'th':
						$url = $url."top-headlines?country=en&q=".$_POST['keyword']."&apiKey=0c340a4f8bc14e92930eb77a5617e02d";;
						break;
					case 'all':
						$url = $url."everything?q=".$_POST['keyword']."&apiKey=0c340a4f8bc14e92930eb77a5617e02d";;;
						break;
					default :
						$url = $url."everything?&q=".$_POST['keyword']."&apiKey=0c340a4f8bc14e92930eb77a5617e02d";;;
						break;
				}
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_HEADER, false);
				curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 
				(KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36");
				$result = curl_exec($curl);
				$result = json_decode($result,true);
				if($result["status"]== "ok"){
					$articles = $result["articles"];
					foreach( $articles as $key=>$value ){
				?>
					<div class="row">
					<div class="col-md-3">
						<img src="<?php echo $value['urlToImage'];?>" class="img-responsive img-thumbnail"/>
					</div>
					<div class="col-md-9">
						<h3><?php echo $value["title"];?></h3>
						<p><?php echo $value["description"];?></p>
					</div>
					</div>
				<?php							
						}
					}
				else{
					echo "<br>Something Went Wrong.";	
				}
				curl_close($curl)			
		?>
			</div>
		</section>
		<?php
			}
		?>
	</body>	
</html>