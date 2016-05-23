<?php
class RemoveController extends Controller {

protected $_last_id;

public function delete() {

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
    while (($line = fgets($file_handle)) !== false) {
        # Tara should just create a file with edge names (e.g: csm-57-eur3) each separated by a new line, so just a one column file 
        echo "[+] processing: $line<br/>";
        $this->Remove->query("DELETE FROM tbl_host WHERE host_name = :host_name AND config_id = :config_id");
        $this->Remove->bind(':host_name',rtrim($line));
        $this->Remove->bind(':config_id', 4);

        $this->Remove->execute();

        $this->_last_id = $this->Remove->lastInsertId(); // not used yet
    }

    echo "<br/>DONE.<br/>";
    echo '<a href="http://nagios01.priv.yospace.net/add_edge/add/insert">Go Back &lt;&lt;</a>';
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

