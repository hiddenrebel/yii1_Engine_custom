<?php

class m150220_085802_blog_related_category extends CDbMigration
{
	public function up()
	{
		$this->createTable('blog_related_category', array(
            'id_related_cat' => 'pk',
            'id_post' => 'string NOT NULL',
            'id_cat_related' => 'string NOT NULL',
            'create_at' => 'date',
        ));
	}

	public function down()
	{
		echo "m150220_085802_blog_related_category does not support migration down.\n";
		$this->dropTable('blog_related_category');
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