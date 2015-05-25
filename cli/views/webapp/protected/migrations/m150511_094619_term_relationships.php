<?php

class m150511_094619_term_relationships extends CDbMigration
{
	public function up()
	{
		$this->createTable('term_relationships', array(
            'id_post' => 'INTEGER',
            'id_term_taxonomy' => 'string',
            'term_order' => 'INTEGER',
        ));
        $this->addPrimaryKey('PK_FOO','term_relationships','id_post, id_term_taxonomy');
	}

	public function down()
	{
		echo "m150511_094619_term_relationships does not support migration down.\n";
		$this->dropTable('term_relationships');
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