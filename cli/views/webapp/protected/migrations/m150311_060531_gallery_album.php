<?php

class m150311_060531_gallery_album extends CDbMigration
{
	public function up()
	{
		$this->createTable('gallery_album', array(
            'id_album' => 'pk',
            'title_album' => 'string',
            'desc_album' => 'text',
            'slug_album' => 'string',
            'cover_album' => 'string',
            'create_at' => 'date',
        ));
	}

	public function down()
	{
		echo "m150311_060531_gallery_album does not support migration down.\n";
		$this->dropTable('gallery_album');
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