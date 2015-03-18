<?php

class m150223_094851_slider extends CDbMigration
{
	public function up()
	{
		$this->createTable('slider', array(
            'id_slider' => 'pk',
            'title_slider' => 'string',
            'desc_slider' => 'text',
            'img_slider' => 'string',
            'create_at' => 'date',
        ));
	}

	public function down()
	{
		echo "m150223_094851_slider does not support migration down.\n";
		$this->dropTable('slider');
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