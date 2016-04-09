<?php 
class Database extends App{
	public $_db;
	
	/**
	 * Database connetion setup
	 * @private
	 */
	public function __construct() {
        parent::__construct();
        $dns = 'mysql:host='.parent::$config['host'].';dbname='.parent::$config['name'];
        $user = parent::$config['username'];
        $password = parent::$config['password'];
        
        try {
            $this->_db = new PDO($dns, $user, $password);
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $e) {
            $this->error("Database: ".$e);
        }
	}
    
	/**
	 * PDO bindValue
	 * @param object &$pdo   PDO
	 * @param array  &$array ['name' => 'value',...] :name will be value
	 */
	public function arrayBinder(&$pdo, &$array) {
		foreach ($array as $key => $value) {
			$pdo->bindValue(':'.$key,$value);
		}
	}
    
    /**
     * Install The Database if it does not exist
     */
    public function installDatabase(){
        $installSQL = "CREATE TABLE `news` (
          `id` int(11) NOT NULL,
          `title` varchar(255) NOT NULL,
          `article` text NOT NULL,
          `preview` text NOT NULL,
          `author` int(11) NOT NULL,
          `image` varchar(255) NOT NULL,
          `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `style` int(1) NOT NULL DEFAULT '0'
        ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

        --
        -- Dataark for tabell `news`
        --

        INSERT INTO `news` (`id`, `title`, `article`, `preview`, `author`, `image`, `timestamp`, `style`) VALUES
        (1, 'New Faeria Deckbuilder; on faeriaguide!', 'Lorem Ipsum Dolor Sit Amet Greedo, Han Solo, Luke, Leia, Nien Numb, Darth vader, Anakin Skywaalker, Lorem Ipsum Dolor Sit Amet Greedo, Han Solo, Luke, Leia, Nien Numb, Darth vader, Anakin Skywaalker, Lorem Ipsum Dolor Sit Amet Greedo, Han Solo, Luke, Leia, Nien Numb, Darth vader, Anakin Skywaalker, Lorem Ipsum Dolor Sit Amet Greedo, Han Solo, Luke, Leia, Nien Numb, Darth vader, Anakin Skywaalker, Lorem Ipsum Dolor Sit Amet Greedo, Han Solo, Luke, Leia, Nien Numb, Darth vader, Anakin Skywaalker, ', 'Lorem Ipsum Dolor Sit Amet Greedo, Han Solo, Luke, Leia, Nien Numb, Darth vader, Anakin Skywaalker', 0, '123.png', '2016-04-07 22:02:02', 0),
        (2, 'Key Guides for Players', 'Welcome to the first stage of the Scrolls Academy!\r\n\r\nNow that you’ve completed the tutorials, and maybe played a few games with your first deck, you’ll probably want to know more about what a Collectible Card Game (CCG) like Scrolls entails and how to improve your knowledge and skill as a Caller.\r\n\r\nThis game is more than simply the board and single cards being played, it’s about aggression and control, tactics and strategies, synergies and opposites. Each part of the guide below allows you to click on the image or keyword and you will be presented with videos, articles, and guides detailing that subject.', 'Now that you’ve completed the tutorials, and maybe played a few games with your first deck, you’ll probably want to know more about what a Collectible Card Game (CCG) like Scrolls entails and how to improve your knowledge and skill as a Caller.', 1, 'http://academy.scrollsguide.com/guide/key-guides-for-players', '2016-04-07 23:22:56', 0);
        ";
    }
}

$app->setPDO(new Database());