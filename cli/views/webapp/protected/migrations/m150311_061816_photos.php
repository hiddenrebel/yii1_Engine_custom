<?php

class m150311_061816_photos extends CDbMigration
{
	public function up()
	{
		$this->createTable('photos', array(
            'id_photo' => 'pk',
            'id_album' => 'integer NOT NULL',
            'title_photo' => 'string',
            'desc_photo' => 'text',
            'img_photo' => 'string',
            'alt_photo' => 'string',
            'create_at' => 'date',
        ));
	}

	public function down()
	{
		echo "m150311_061816_photos does not support migration down.\n";
		$this->dropTable('photos');
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