<?php 
// For complete examples and data files, please go to https://github.com/aspose-Slides-cloud/aspose-Slides-cloud-php

//    include(dirname(__DIR__) . '\CommonUtils.php');
    use Aspose\Slides\Cloud\Sdk\Api\SlidesApi;
	use Aspose\Slides\Cloud\Sdk\Api\Configuration;
	use Aspose\Slides\Cloud\Sdk\Model;
    use Aspose\Slides\Cloud\Sdk\Model\Requests;

    try {
        // Create SlidesApi instance
		$config = new Configuration();
//		$config->setAppSid(CommonUtils::$AppSid);
//		$config->setAppKey(CommonUtils::$AppKey);
        $config->setAppSid("8ab19107-34a5-45e0-9a80-28e914c31690");
        $config->setAppKey("0f5e35731d976d2c9d5fd6539841f470");

        $slidesApi = new SlidesApi(null, $config);

		$fileName = "02_payform.pptx";

		// Upload original document to storage
		$slidesApi->uploadFile(new Requests\UploadFileRequest($fileName, realpath(__DIR__ . '/../..') . '\resources\\' . $fileName, CommonUtils::$MyStorage));
		
		$request = new Requests\PostSlidesSplitRequest($fileName, null, Model\SlideExportFormat::JPEG);
        $result = $slidesApi->postSlidesSplit($request);
        print_r($result);

    } catch (Exception $e) {
        echo "Something went wrong: ", $e->getMessage(), "\n";
    }
?>