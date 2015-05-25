<?php

class m150511_094559_term_taxonomy extends CDbMigration
{
	public function up()
	{
		$this->createTable('term_taxonomy', array(
            'id_term_taxonomy' => 'pk',
            'id_term' => 'string',
            'taxonomy' => 'string',
            'description_taxonomy' => 'text',
            'parent_taxonomy' => 'INTEGER (1) NOT NULL DEFAULT \'0\' ',
            'count_taxonomy' => 'INTEGER (1) NOT NULL DEFAULT \'0\' ',
        ));
	}

	public function down()
	{
		echo "m150511_094559_term_taxonomy does not support migration down.\n";
		$this->dropTable('term_taxonomy');
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