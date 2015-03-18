<?php

class m150310_042855_static_page extends CDbMigration
{
	public function up()
	{
		$this->createTable('static_page', array(
            'id_page' => 'pk',
            'title_page' => 'string',
            'desc_page' => 'text',
            'img_page' => 'string',
            'type_page' => 'string',
            'create_at' => 'date',
        ));
	}

	public function down()
	{
		echo "m150310_042855_static_page does not support migration down.\n";
		$this->dropTable('static_page');
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