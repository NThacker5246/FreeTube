<?php

	/**
	 * 
	 */
	class TB 
	{
		public $arr;
	}

	function getAndUpCounter()
	{
		$count = file_get_contents(WAY . "table.json");
		$cn = json_decode($count);
		$cnt = $cn->count;
		$cn->count = $cnt + 1;
		$dt = json_encode($cn);
		$file = fopen(WAY . "table.json", "w");
		$fw = fwrite($file, $dt);
		$fc = fclose($file);
		return $cnt;
	}

	function getVideoWay($id)
	{
		$fileOfTable = $id >> 8;
		
		$data = file_get_contents(WAY . "table$fileOfTable.json");
		$dsd = json_decode($data);
		//var_dump($dsd);
		$key = $id & 255;
		$key = "" . $key;
		$src = $dsd->arr->$key;
		return $src;
	}


	function pushVideoWay($id, $link)
	{
		$fileOfTable = $id >> 8;
		
		if(!file_exists(WAY . "table$fileOfTable.json")){
			$dsd = new TB();
			$dsd->arr[$id & 255] = $link;
			$dt = json_encode($dsd);

			$file = fopen(WAY . "table$fileOfTable.json", "w");
			$fw = fwrite($file, $dt);
			$fc = fclose($file);
			return;
		}
		$data = file_get_contents(WAY . "table$fileOfTable.json");
		$dsd = json_decode($data);
		$key = $id & 255;
		$key = "" . $key;
		$dsd->arr->$key = $link;
		$dt = json_encode($dsd);

		$file = fopen(WAY . "table$fileOfTable.json", "w");
		$fw = fwrite($file, $dt);
		$fc = fclose($file);
	}
?>