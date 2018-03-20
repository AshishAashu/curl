<?php
	class CurlRequest{
		//$url = "http://webhose.io/filterWebContent?token=22b4f61f-58f8-4674-8c7c-7dcb4283e03d&format=json
		//&sort=relevancy&q=india%20vs%20bangladesh";
		const HOST = "http://webhose.io/filterWebContent";
		const TOKEN = "22b4f61f-58f8-4674-8c7c-7dcb4283e03d";
		const FORMAT = "json";
		const SORT = "relevancy";
		
		function makeRequest($query){
			$query = rawurlencode($query);
			$url = self::HOST."?token=".self::TOKEN."&format=".self::FORMAT."&sort=".self::SORT."&q=".$query;
			return $this->callUrl($url);
		}
		function callUrl($url){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HEADER, false);
			$result = curl_exec($curl);
			$result = json_decode($result,true);
			curl_close($curl);
			return $result;
		}
	}
/*$_POST['keyword'] = preg_replace('/\s+/', '', $_POST['keyword']);
				$curl = curl_init();
				$url = "https://newsapi.org/v2/";
				switch($_POST['which']){
					case 'th':
						$url = $url."top-headlines?q=".$_POST['keyword']."&apiKey=0c340a4f8bc14e92930eb77a5617e02d";
						break;
					case 'all':
						$url = $url."everything?q=".$_POST['keyword']."&apiKey=0c340a4f8bc14e92930eb77a5617e02d";
						break;
					default :
						$url = $url."everything?q=".$_POST['keyword']."&apiKey=0c340a4f8bc14e92930eb77a5617e02d";
						break;
				}
				$url = $url.$_POST['keyword'];
				curl_setopt($curl, CURLOPT_URL, $url);
				//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
				//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_HEADER, false);
				//curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 
				//(KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36");
				$result = curl_exec($curl);
				$result = json_decode($result,true);
				/*if($result["posts"]== "ok"){
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
					}*/
?>
