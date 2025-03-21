<?php 
	
	if(!defined('WAY')){
		define('WAY', '../../accounts/');
	}

	class Parameters
	{
		public $name;
		public $password;
		public $email;
		public $phone;
		public $videoCreated;
		public $videoLiked;
		public $videoDisliked;
	}

	function addUser($password, $name, $email, $phone)
	{
		$param = new Parameters();
		$param->password = $password;
		$param->name = $name;
		$param->email = $email;
		$param->phone = $phone;

		if(!file_exists(WAY . $password . ".conf")){
			$file = fopen(WAY . $password . ".conf", "w");
			$fw = fwrite($file, json_encode($param));
			$fc = fclose($file);
			return true;
		}
		return false;
	}

	function getUser($password, $name, $email, $phone)
	{
		if(file_exists(WAY . $password . ".conf")){
			$dt = json_decode(file_get_contents(WAY . $password . ".conf"));
			var_dump($name);
			var_dump($dt->name);
			if ($dt->name == $name || $dt->email == $email || $dt->phone == $phone) {
				return $dt;
			}
			return false;
		}
		return false;
	}

	function writeUserParam($password, $param, $type)
	{
		if(file_exists(WAY . $password . ".conf")){
			$dt = json_decode(file_get_contents(WAY . $password . ".conf"));
			switch ($type) {
				case 'videoCreated':
					$prev = $dt->videoCreated;
					if($prev == null){
						$dt->videoCreated = array($param);
						$file = fopen(WAY . $password . ".conf", "w");
						$fw = fwrite($file, json_encode($dt));
						$fc = fclose($file);
						return true;
					}
					$dt->videoCreated = array();
					$i = 0;
					foreach ($prev as $num) {
						//echo $num;
						$dt->videoCreated[$i] = $num;
						//echo "<br>";
						$i++;
					}
					$dt->videoCreated[$i] = $param;
					$file = fopen(WAY . $password . ".conf", "w");
					$fw = fwrite($file, json_encode($dt));
					$fc = fclose($file);
					var_dump($dt);
					echo "<br>";
					return true;
					break;

				case 'videoLiked':
					$prev = $dt->videoLiked;
					if($prev == null){
						$dt->videoLiked = array($param);
						$file = fopen(WAY . $password . ".conf", "w");
						$fw = fwrite($file, json_encode($dt));
						$fc = fclose($file);
						return true;
					}
					$dt->videoLiked = array();
					$i = 0;
					foreach ($prev as $num) {
						//echo $num;
						$dt->videoLiked[$i] = $num;
						//echo "<br>";
						$i++;
					}
					$dt->videoLiked[$i] = $param;
					$file = fopen(WAY . $password . ".conf", "w");
					$fw = fwrite($file, json_encode($dt));
					$fc = fclose($file);
					//var_dump($dt);
					//echo "<br>";
					return true;
					break;
				
				case 'videoDisliked':
					$prev = $dt->videoDisliked;
					if($prev == null){
						$dt->videoDisliked = array($param);
						$file = fopen(WAY . $password . ".conf", "w");
						$fw = fwrite($file, json_encode($dt));
						$fc = fclose($file);
						return true;
					}
					$dt->videoDisliked = array();
					$i = 0;
					foreach ($prev as $num) {
						//echo $num;
						$dt->videoDisliked[$i] = $num;
						//echo "<br>";
						$i++;
					}
					$dt->videoDisliked[$i] = $param;
					$file = fopen(WAY . $password . ".conf", "w");
					$fw = fwrite($file, json_encode($dt));
					$fc = fclose($file);
					//var_dump($dt);
					//echo "<br>";
					return true;
					break;
				
				default:
					# code...
					break;
			}
		}
		return false;
	}

	function getUserParam($password, $type, $par)
	{
		if(file_exists(WAY . $password . ".conf")){
			$dt = json_decode(file_get_contents(WAY . $password . ".conf"));
			switch ($type) {
				case 'videoCreated':
					foreach ($dt->videoCreated as $value) {
						if ($value == $par) {
							return true;
						}
					}
					return false;
					break;
				case 'videoLiked':
					foreach ($dt->videoLiked as $value) {
						if ($value == $par) {
							return true;
						}
					//	echo "$value <br>";
					}
					return false;
					break;
				case 'videoDisliked':
					foreach ($dt->videoLiked as $value) {
						if ($value == $par) {
							return true;
						}
					//	echo "$value <br>";
					}
					return false;
					break;

			}
		}
		return false;
	}

	function repUserParam($password, $type, $par, $np)
	{
		if(file_exists(WAY . $password . ".conf")){
			$dt = json_decode(file_get_contents(WAY . $password . ".conf"));
			switch ($type) {
				case 'videoCreated':
					$i = 0;
					foreach ($dt->videoCreated as $value) {
						if ($value == $par) {
							$dt->videoCreated[$i] = $np;
						}
						$i++;
					}
					break;
				case 'videoLiked':
					$i = 0;
					foreach ($dt->videoLiked as $value) {
						if ($value == $par) {
							$dt->videoLiked[$i] = $np;
						}
						$i++;
					}
					break;
				case 'videoDisliked':
					$i = 0;
					foreach ($dt->videoDisliked as $value) {
						if ($value == $par) {
							$dt->videoDisliked[$i] = $np;
						}
						$i++;
					}
					break;

			}
			$file = fopen(WAY . $password . ".conf", "w");
			$fw = fwrite($file, json_encode($dt));
			$fc = fclose($file);	
			return true;
		}
		return false;
	}
	//addUser("123", "NThacker", "ht@milo.co", "8800555355");
	//writeUserParam("123", "HW", "videoCreated");
	//writeUserParam("123", "The Portal", "videoCreated");
	//writeUserParam("123", "The Alogical", "videoCreated");

 ?>