<?php

class m150218_042038_blog_related_post extends CDbMigration
{
	public function up()
	{
		$this->createTable('blog_related_post', array(
            'id_related' => 'pk',
            'id_post' => 'string NOT NULL',
            'id_post_related' => 'string NOT NULL',
            'create_at' => 'date',
        ));
	}

	public function down()
	{
		echo "m150218_042038_blog_related_post does not support migration down.\n";
		$this->dropTable('blog_related_post');
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