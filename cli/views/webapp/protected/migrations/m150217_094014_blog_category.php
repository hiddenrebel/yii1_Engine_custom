<?php

class m150217_094014_blog_category extends CDbMigration
{
	public function up()
	{
		$this->createTable('blog_category', array(
            'id_cat' => 'pk',
            'name_cat' => 'string NOT NULL',
            'desc_cat' => 'text',
            'parent_cat' => 'string',
            'slug' => 'string NOT NULL',
            'create_at' => 'date',
        ));
	}

	public function down()
	{
		echo "m150217_094014_blog_category does not support migration down.\n";
		$this->dropTable('blog_category');
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