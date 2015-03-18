<?php

class m150216_065307_post extends CDbMigration
{
	public function up()
    {
        $this->createTable('blog_post', array(
            'id_post' => 'pk',
            'author_post' => 'string',
            'title_post' => 'string NOT NULL',
            'content_post' => 'text',
            'img_post' => 'text',
            'slug_post' => 'string',
            'created_date_post' => 'date',
            'publish_post' => 'string',
        ));
    }
 	public function down()
	{
		echo "m150216_065307_post does not support migration down.\n";
        $this->dropTable('blog_post');
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