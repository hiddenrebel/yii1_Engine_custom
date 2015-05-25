<?php

class m150506_073528_comments extends CDbMigration
{
	public function up()
	{
		$this->createTable('comments', array(
			'id_comment' => 'pk',
			'id_post' => 'string NOT NULL',
			'user_comment' => 'string NOT NULL',
			'email_comment' => 'string NOT NULL',
			'content_comment' => 'text NOT NULL',
			'status_comment' => 'INTEGER (1) NOT NULL DEFAULT \'1\' ',
			'create_at' => 'date',
			));

	}

	public function down()
	{
		echo "m150506_073528_comments does not support migration down.\n";
        $this->dropTable('comments');
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