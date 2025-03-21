<?php
	define('WAY', './');
	

	class Parameters
	{
		public $FLAGS = 0;
		public $videosCreated = [];
		public $videosLiked = [];
		public $videosDisliked = [];
	}

	class TreeNode
	{
		public $nameNode = "";
		public $left;
		public $right;
		public $collisionLink;
		public $targetID = 0;
		public $tableId;
	}

	class CollisionNode
	{
		public $nameNode = "";
		public $collisionLink;
	}

	class START
	{
		public $root;
		public $users = 1;
	}

	function AddUserToTable($name)
	{
		$id = getHash($name);
		if(file_exists(WAY . "table.json")){
			$data = json_decode(file_get_contents(WAY . "table.json"));
			$node = $data->root;
			while (true) {
				var_dump($node);
				if ($node->targetID == $id) {
					if($node->nameNode == $node){
						return false;
					} else {
						if($node->collisionLink == null){
							$node->collisionLink  = new TreeNode();
							$node->nameNode = $name;
							$node->targetID = $id;
							$stmt = json_encode($data);
							$file = fopen("table.json", "w");
							$fw = fwrite($file, $stmt);
							$fc = fclose($file);
							return true;
						}
					}
				}

				if($node->targetID > $id){
					if($node->right != null){
						$node = $node->right;
						continue;
					} else {
						$node->right  = new TreeNode();
						$node->nameNode = $name;
						$node->targetID = $id;
						$stmt = json_encode($data);
						$file = fopen("table.json", "w");
						$fw = fwrite($file, $stmt);
						$fc = fclose($file);
						return true;
					}
				}

				if($node->targetID < $id){
					if($node->left != null){
						$node = $node->left;
						continue;
					} else {
						$node->left  = new TreeNode();
						$node->nameNode = $name;
						$node->targetID = $id;
						$stmt = json_encode($data);
						$file = fopen("table.json", "w");
						$fw = fwrite($file, $stmt);
						$fc = fclose($file);
						return true;
					}
				}
			}

		} else {
			$data = new START();
			$data->root = new TreeNode();
			$data->root->nameNode = $name;
			$data->root->targetID = $id;
			$stmt = json_encode($data);
			$file = fopen(WAY . "table.json", "w");
			$fw = fwrite($file, $stmt);
			$fc = fclose($file);
			return true;
		}
	}

	function Symetrical()
	{
		$data = json_decode(file_get_contents(WAY . "table.json"));
		warp($data->root);
	}

	function warp($obj)
	{
		if($obj == null) return;
		warp($obj->left);
		echo $obj->nameNode . "<br>";
		warp($obj->right);
	}

	function getHash($name)
	{
		$hash = 0;
		for ($i=0; $i < strlen($name); $i++) {
			$hash = ($hash << 5) - $hash;
			$hash += ord($name[$i]);
		}

		return $hash;
	}

	Symetrical();
	//AddUserToTable("WiNUser");
?>