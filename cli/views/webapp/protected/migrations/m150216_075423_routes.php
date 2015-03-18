<?php

class m150216_075423_routes extends CDbMigration
{
	public function up()
	{
		$this->createTable('blog_routes', array(
            'id_route' => 'pk',
            'real_link' => 'string NOT NULL',
            'slug' => 'string NOT NULL',
            'create_at' => 'date',
        ));
	}

	public function down()
	{
		echo "m150216_075423_routes does not support migration down.\n";
        $this->dropTable('blog_routes');
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}