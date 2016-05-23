<?php
class AddController extends Controller {

protected $_last_id;

public function insert() {

    $_pgheader = get_class($this);  
    include(ROOT . DS . 'application'  . DS . 'views' . DS . 'body.php');

}


public function uploader() {

// https://github.com/CreativeDream/php-uploader
$uploader = new Uploader();
$data = $uploader->upload($_FILES['files'], array(
    'limit' => 10, //Maximum Limit of files. {null, Number}
    'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
    'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
    'required' => false, //Minimum one file is required for upload {Boolean}
    'uploadDir' => ROOT.DS.'uploads/', //Upload directory {String}
    'title' => array('auto', 10), //New file name {null, String, Array} *please read documentation in README.md
    'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
    'perms' => null, //Uploaded file permisions {null, Number}
    'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
    'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
    'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
    'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
    'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
    'onRemove' => '$this->onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
));

if($data['isComplete']){
	$alias_chrs = array('.','-');
    $files = $data['data']['files'][0];
    $file_handle = fopen("$files", "r");
    // while (!feof($file_handle)) {
    // Nagiosql related schema
    while (($line = fgets($file_handle)) !== false) {
        $edge_alias = str_replace($alias_chrs, " ",rtrim($line));
        echo "[+] processing: $line<br/>";
		$this->Add->query("INSERT INTO tbl_host(host_name,alias,address,check_command,notes_url,config_id) values (:host_name,:alias,:address,:check_command,:notes_url,:config_id)");
		$this->Add->bind(':host_name',rtrim($line));
		$this->Add->bind(':alias', $edge_alias);
		$this->Add->bind(':address', rtrim($line).'.cdn.company.com');
		$this->Add->bind(':check_command', '17!5666');
		$this->Add->bind(':notes_url', '/path/index.php/company-cdn-servers.html');
		$this->Add->bind(':config_id', 4);

		$this->Add->execute();

		$this->_last_id = $this->Add->lastInsertId(); // not used yet
    }

    echo "<br/>DONE.<br/>";
    echo '<a href="http://company.com/add_edge/add/insert">Go Back &lt;&lt;</a>';
    fclose($file_handle);
}

if($data['hasErrors']){
    $errors = $data['errors'];
    print_r($errors);
}

} // Ends function

public function onFilesRemoveCallback($removed_files){
    foreach($removed_files as $key=>$value){
        $file = 'uploads/' . $value;
        if(file_exists($file)){
            unlink($file);
            unset($removed_files[$key]);
        }
    }

    return $removed_files;
} // Ends function        

} // Ends class

