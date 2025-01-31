<?php
use Aws\S3\S3Client;

defined('BASEPATH') OR exit('No direct script access allowed');

class Aws_s3_file_upload {

	public function __construct() {
		require_once FCPATH . 'aws/aws-autoloader.php';
	}

	public $bucket = 'bhaktiappproduction';

	function aws_s3_video_upload($name, $inside_bucket) {

		$_FILES['file'] = $name;

		$s3Client = new S3Client([
			'version' => 'latest',
			'region' => 'ap-south-1',
			'credentials' => [
//				'key' => 'AKIA4OH57KEDDKAOXOE3',
//				'secret' => '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',
                            'key' => 'AKIA4OH57KEDH6RDDUW4',
				'secret' => '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',
			],
		]);
		$result = $s3Client->putObject(array(
			'Bucket' => $this->bucket,
			'Key' => $inside_bucket . '/' . rand(0, 7896756) . str_replace([':', ' ', '/', '*', '#', '@', '%'], "_", $_FILES["file"]["name"]),
			'SourceFile' => $_FILES["file"]["tmp_name"],
			'ContentType' => 'video',
			'ACL' => 'public-read',
			'StorageClass' => 'REDUCED_REDUNDANCY',
			'Metadata' => array('param1' => 'value 1', 'param2' => 'value 2'),
		));
		$data = $result->toArray();
		$video = explode('/', $data['ObjectURL']);
		//return end($video);
		// print_r($video);exit;
		return $data['ObjectURL'];
		return $video[5];
	}

	function aws_s3_file_upload($name, $inside_bucket) {
		$_FILES['file'] = $name;

		$s3Client = new S3Client([
			'version' => 'latest',
			'region' => 'ap-south-1',
			'credentials' => [
//				'key' => 'AKIAJBL76SN3WKDCRP5A',
//				'secret' => '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',
                            'key' => 'AKIA4OH57KEDH6RDDUW4',
				'secret' => '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',
			],
		]);
		$result = $s3Client->putObject(array(
			'Bucket' => $this->bucket,
			'Key' => $inside_bucket . '/' . rand(0, 7896756) . str_replace([':', ' ', '/', '*', '#', '@', '%'], "_", $_FILES["file"]["name"]),
			'SourceFile' => $_FILES["file"]["tmp_name"],
			'ContentType' => 'video',
			'ACL' => 'public-read',
			'StorageClass' => 'REDUCED_REDUNDANCY',
			'Metadata' => array('param1' => 'value 1', 'param2' => 'value 2'),
		));
		$data = $result->toArray();
		//echo "<pre>";print_r($data);die;
		$video = explode('/', $data['ObjectURL']);
		//return end($video);
		return $data['ObjectURL'];
	}

	function getExtension($str) {
		$i = strrpos($str, ".");
		if (!$i) {
			return "";
		}

		$l = strlen($str) - $i;
		$ext = substr($str, $i + 1, $l);

		return $ext;

	}

}