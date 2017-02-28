<?php 

class orders{
	private static $_instance;
    private function __construct(){}
	private function __clone(){}
    public static function getInstance() {
        if ( is_null(self::$_instance) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	
	//==================================================
	
	public function addOrder($title, $desc, $price){
		global $db, $user;
		
		$title = addslashes($title);
		$desc = addslashes($desc);
		$price = (int)$price;
		$userId = $user->getId();
		
		if($db->query("INSERT INTO `orders` (id, id_customer, title, description, price, status) 
							VALUES (NULL, '{$userId}', '{$title}', '{$desc}', '{$price}', '0')")) {
			return true;
		} else {
			return $db->checkError();
		}
	}
	
	public function getOrders($id){
		global $db;
		
		$result = null;
		
		$q = $db->query("SELECT `id`, `title`, `description`, `price`, `status` FROM `orders` WHERE `id_customer` = '{$id}' ORDER BY  `orders`.`id` DESC");
		
		while($row = mysql_fetch_assoc($q)){
			switch($row["status"]){
				case "2": $status = "Завершён"; break;
				case "1": $status = "В разработке"; break;
				default: $status = "На обработке"; break;
			}
			
			$result .= "<tr>
							<td>{$row["id"]}</td>
							<td>{$row["title"]}</td>
							<td>{$row["description"]}</td>
							<td>{$row["price"]} рублей</td>
							<td>{$status}</td>
						</tr>";
		}
		
		return $result;
		
	}
}