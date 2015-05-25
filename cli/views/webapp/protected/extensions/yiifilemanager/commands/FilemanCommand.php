<?php
class FilemanCommand extends CConsoleCommand {
	public function actionIndex($cmd='list',$fileids='',$id='',$files='', $name='', $file_id=''){
		printf("\nFileman tester. ID=%s\n",$id);
		printf("usage:\n");
		printf("	--cmd=list (default)\n");
		printf("	--cmd=add --id=123456 --files=/var/tmp/file1,/var/tmp/file2\n");
		printf("	--cmd=rem --id=123456 --fileids=129819,129982\n");
		printf("	--cmd=path --id=123456 --fileids=129819\n");
		printf("	--cmd=canread --id=123456 --fileids=129819,119891\n");
		printf("	--cmd=rename --id=123456 --file_id=129819 --name=newname\n");
		printf("\n");
		if($id=='')
			die("must provide an id. use --id=123456 or something else to test\n");
		if($cmd=='add'){
			// ADD
			//
			if(($id=='') || ($files=='')){
				printf("add command must be:\n");
				printf("	--cmd=add --id=123456 --files=/var/tmp/file1,/var/tmp/file2\n");
			}else{
				$ar = explode(",",$files);
				$result = Yii::app()->fileman->add_files($id, $ar);
				if(empty($result))
					printf("no files added.\n");
				foreach($result as $r)
					printf("added files [%s]\n",$r);
			}
		}elseif($cmd=='list'){
			// LIST
			//
			foreach(Yii::app()->fileman->list_files($id) as $fd)
				printf("file -> [%s] [%s] [%s]\n",
					$fd['id'],$fd['file_id'],$fd['filename']);
		}elseif($cmd=='rem'){
			// DELETE
			//
			if($fileids == ''){
				printf("usage: fileman --cmd=rem --fileids=129812,198928\n");
			}else{
				$ar = explode(",",$fileids);
				$removed = Yii::app()->fileman->remove_files($id,$ar);
				printf("file removed: %s\n",$removed);
			}
		}elseif($cmd=='path'){
			$path = Yii::app()->fileman->get_file_path($id, $fileids);
			if($path != null){
				printf("REAL FILE PATH IS: %s\n",$path);
			}
			else
				printf("file not found\d");
		}elseif($cmd=='canread'){
			if(($fileids == '') || ($id == '')){
				printf("usage: fileman --cmd=canread --id=123456 --fileids=129812,198928\n");
			}else{
				$ar = explode(",",$fileids);
				foreach($ar as $file_id)
					printf("can_read %s: %s\n",
						$file_id,
						Yii::app()->fileman->can_read($id,$file_id) ? "YES" : "NO");
			}
		}elseif($cmd=='rename'){
			if($name == ''){
				printf("usage:\n");
				printf("	--cmd=rename --id=123456 --file_id=129819 --name=newname\n");
			}else{
				printf("result: %s\n",Yii::app()->fileman->rename_file($id, $file_id, $name));
			}
		}
	}

}
