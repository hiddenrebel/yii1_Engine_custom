<?php

class m150224_084639_blog_cover extends CDbMigration
{
	public function up()
	{
		$this->createTable('blog_cover', array(
            'id_cover' => 'pk',
            'id_cat' => 'string',
            'id_post' => 'string',
            'create_at' => 'date',
        ));
	}

	public function down()
	{
		echo "m150224_084639_blog_cover does not support migration down.\n";
		$this->dropTable('blog_cover');
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