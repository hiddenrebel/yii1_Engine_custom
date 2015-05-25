<?php

class m150511_094455_terms extends CDbMigration
{
	public function up()
	{
		 $this->createTable('terms', array(
            'id_term' => 'pk',
            'name' => 'string',
            'slug' => 'string NOT NULL',
            'group_term' => 'INTEGER (1) NOT NULL DEFAULT \'0\' ',
        ));
	}

	public function down()
	{
		echo "m150511_094455_terms does not support migration down.\n";
		$this->dropTable('terms');
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