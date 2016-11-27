<?php
/**
 * Author: Long Doan
 * Date: 11/29/12 2:46 PM
 */
class Uploader {
  /**
   * process file upload request
   * @param callback $naming, $success, $error
   * @author Long Nguyen
   */
  public static function process ($file, $options = array()) {

    if ($file['error'] != 0) {
      return array('error' => true, 'message' => 'Error #'.$file['error']);
    }

    if (!isset($options['allowedExt'])) {
      $options['allowedExt'] = array('jpg','jpeg','png','gif');
    }
    if (!isset($options['uploadDir'])) {
      $options['uploadDir'] = "uploads/tmp/";
    }
    if (!isset($options['namespace'])) {
      $options['namespace'] = 'product';
    }
    if (!isset($options['validation'])) {
      $options['validation'] = function($file, $options){
        $filename = strtolower($file['name']);
        $info = pathinfo($file['name']);
        if (!in_array(strtolower($info['extension']), $options['allowedExt'])) {
          return array('error' => true, 'message' => 'Only '.implode(',',$options['allowedExt']).' files are allowed');
        }
        return array('error' => false);
      };
    }
    if (!isset($options['naming'])) {
      $options['naming'] = function($file, $options){
        $filename = strtolower($file['name']);
        $info = pathinfo($filename);
        $filename = $options['namespace']."_".md5($filename.time()).".".$info['extension'];
        return $filename;
      };
    }
    if (!isset($options['success'])) {
      $options['success'] = function($file, $options){
        return array('error' => false, 'message' => 'File was uploaded successfully', 'filename' => $file['name']);
      };
    }
    if (!isset($options['error'])) {
      $options['error'] = function($file, $options){
        return array('error' => true, 'message' => 'Something went wrong with your upload');
      };
    }

    if (!is_dir($options['uploadDir'])) {
      @mkdir($options['uploadDir'], 0777, true);
    }

    $validation = $options['validation']($file, $options);
    if ($validation['error']) {
      return $validation;
    }

    $file['name'] = $options['naming']($file, $options);

    if (move_uploaded_file($file['tmp_name'], $options['uploadDir'].$file['name'])){
      return $options['success']($file, $options);
    } else {
      return $options['error']($file, $options);
    }

  }
}

?>
