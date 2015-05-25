<?php

class m150216_080247_users extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('users', array(
            'id_user' => 'pk',
            'username' => 'string',
            'password_user' => 'string',
            'role_user' => 'string',
        ));

        $this->insert('users',array(
		         'username' =>'mayuyu',
		         'password_user' => '$2a$13$ViAODKSx1RE4mwg..ZLlYOP4F95eEEB4l5SZMyI6lyZXK/qa/cTom',
		         'role_user' => 'user',
		  ));
		$this->insert('users',array(
		         'username' =>'admin',
		         'password_user' => '$2a$13$udJsDd35JWDadtLTyrGWJ.loYVGH7N3wiptr54noJiyWVHi0eJlua',
		         'role_user' => 'admin',
		  ));
	}

	public function down()
	{
		echo "m150216_080247_users does not support migration down.\n";
        $this->dropTable('users');
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