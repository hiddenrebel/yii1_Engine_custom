#Yii File Manager

Fileman is a framework for handling files attached to an given Identity, it can be 
commonly your current logged in user.

Fileman is designed as an abstract class, so many child classes can be built to satisfy 
business dependencies, like:  Storing files in a disk file,  in a user session, in a database, and so on.

In this case only one child class is provided:  YiiDiskFileManager, created to store files in a disk.


### Install the fileman component:

Register the fileman component into your config file.

	'import'=>array(
		...bla...
		'application.extensions.yiifilemanager.*',  // <<--HERE
	),

	'components'=>array(
		'fileman' => array(
			'class'=>'application.extensions.yiifilemanager.YiiDiskFileManager',
			'storage_path' => "/var/tmp/fileman",
	),

### Basic yii File Manager operations


	$identity = Yii::app()->user->id; // or any IDentificator.

	// ADD FILES
	//	add_files return an array of file_id.
	Yii::app()->fileman->add_files($identity,"/some/place/filename.mp3");
	Yii::app()->fileman->add_files($identity,array("file1", "file2"));

	// LIST FILES
	//   it returns an array of file-data: 
	//		"id" (identity), "file_id", "filename", "longfilename"
	foreach(Yii::app()->fileman->list_files($identity) as $fd)
		printf("file -> [%s] [%s] [%s]\n",
				$fd['id'],$fd['file_id'],$fd['filename']);

	// QUERY THE REAL PATH FOR A GIVEN FILE ID
	//  
	$real_path = Yii::app()->fileman->get_file_path($id, "18aac1a12");
	// ..do what ever you want with this file...
	printf("the real local path is: %s\n",$real_path);

	// QUERY IF THE GIVEN USER ID CAN READ A FILE USING ITS FILE_ID
	//
	$bool = Yii::app()->fileman->can_read(Yii::app()->user->id, "188abc123");

	// RENAME FILES
	//
	$bool = Yii::app()->fileman->rename_file(Yii::app()->user->id, "188abc123", "new file name");

	// REMOVE FILES
	//   using the file_id provided when calling list_files()
	Yii::app()->fileman->remove_file($identity, "18ac11981");
	Yii::app()->fileman->remove_file($identity, array("288abc12","2029acb12"));


### Yii File Manager Class Diagram

![Class Diagram][1]

### Test Fileman in a Command Line utility.

The command line utility is available in the 'commands' directory into this extension.

- Copy the provided file from:
	
		'protected/extensions/yiifilemanager/commands/FilemanCommand.php'

	to:

		"protected/commands/FilemanCommand.php"

- Be sure you have the rigth config file in "protected/yiic.php"

- Test it:

		cd myapp
		cd protected
		./yiic fileman --id=123456 --cmd=list
		./yiic fileman --id=123456 --cmd=add --files=/home/mydoc.txt,/home/some.mp3

- Known Issues:

			exception 'CException' with message 'Property CConsoleApplication.fileman is not defined.' 
			in /home/christian/www/yii/framework/base/CComponent.php:130

		Reason:

			Check your file: protected/yiic.php, it must point to config/main.php, or edit your
			config/console.php file in order to register the yiifilemanager component into it

[1]:https://bitbucket.org/christiansalazarh/yiifilemanager/downloads/fileman-class-diagram.png
