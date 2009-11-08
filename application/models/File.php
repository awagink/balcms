<?php

/**
 * File
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6365 2009-09-15 18:22:38Z jwage $
 */
class File extends BaseFile {

	public function setUp ( ) {
		$this->hasMutator('file', 'setFile');
		parent::setUp();
	}

	public function setFile ( $file ) {
		global $Application;
		
		// Configuration
		$config = array();
		$config['bal'] = $Application->getOption('bal');
		
		// Check the file
		if ( !empty($file['error']) ) {
			$error = $file['error'];
			switch ( $file['error'] ) {
				case UPLOAD_ERR_INI_SIZE :
					$error = 'ini_size';
					break;
				case UPLOAD_ERR_FORM_SIZE :
					$error = 'form_size';
					break;
				case UPLOAD_ERR_PARTIAL :
					$error = 'partial';
					break;
				case UPLOAD_ERR_NO_FILE :
					$error = 'no_file';
					break;
				case UPLOAD_ERR_NO_TMP_DIR :
					$error = 'no_tmp_dir';
					break;
				case UPLOAD_ERR_CANT_WRITE :
					$error = 'cant_write';
					break;
				default :
					$error = 'unknown';
					break;
			}
			throw new Doctrine_Exception('error-application-file-' . $error);
			return false;
		}
		if ( empty($file['tmp_name']) || !is_uploaded_file($file['tmp_name']) ) {
			throw new Doctrine_Exception('error-application-file-invalid');
			return false;
		}
		
		// Prepare config
		$file_upload_path = realpath($config['bal']['files']['upload_path']) . DIRECTORY_SEPARATOR;
		
		// Prepare file
		$file_name = $file['name'];
		$file_old_path = $file['tmp_name'];
		$file_new_path = $file_upload_path . $file_name;
		$exist_attempt = 0;
		while ( file_exists($file_new_path) ) {
			// File already exists
			// Pump exist attempts
			++$exist_attempt;
			// Add the attempt to the end of the file
			$file_new_path = $file_upload_path . get_filename($filename,false) . $exist_attempt . get_extension($file_name);
		}
		
		// Move file
		$success = move_uploaded_file($file_old_path, $file_new_path);
		if ( !$success ) {
			throw new Doctrine_Exception('Unable to upload the file.');
			return false;
		}
		
		// Secure
		$file_path = realpath($file_new_path);
		$file_size = filesize($file_path);
		$file_mimetype = get_mime_type($file_path);
		$file_type = get_filetype($file_path);
		
		// Apply
		$this->name = $filename;
		$this->path = $file_path;
		$this->size = $file_size;
		$this->mimetype = $file_mimetype;
		$this->type = $file_type;
		
		// Apply: Image
		if ( $file_type === 'image' ) {
			$image_dimensions = image_dimensions($file_path);
			if ( !empty($image_dimensions) ) {
				// It is not a image we can modify
				$this->width = 0;
				$this->height = 0;
			} else {
				$this->width = $image_dimensions['width'];
				$this->height = $image_dimensions['height'];
			}
			
		}
		
		// Done
		return true;
	}
	
	/**
	 * Download the File
	 * @return
	 */
	public function download ( ) {
		global $Application;
		
		// Get path
		$file_path = $this->path;
		
		// Output result and download
		become_file_download($file_path, null, null);
		die();
	}
	
	public function postDelete ( $Event ) {
		global $Application;
		// Prepare
		$Invoker = $Event->getInvoker();
		
		// Get Path
		$file_path = $Invoker->path;
		
		// Delete the file
		unlink($file_path);
		
		// Done
		return true;
	}
}
