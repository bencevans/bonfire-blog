<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_blog extends Migration {
	
	public function up() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->add_field('`id` int(11) NOT NULL AUTO_INCREMENT');
			$this->dbforge->add_field("`blog_name` VARCHAR(200) NOT NULL");
			$this->dbforge->add_field("`blog_slug` VARCHAR(200) NOT NULL");
			$this->dbforge->add_field("`blog_content` TEXT NOT NULL");
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('blog');

	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('blog');

	}
	
	//--------------------------------------------------------------------
	
}