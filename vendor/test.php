<?php

use Aspose\Slides\Cloud\Sdk\Api\Configuration;
use Aspose\Slides\Cloud\Sdk\Api\SlidesApi;
use Aspose\Slides\Cloud\Sdk\Model\ExportFormat;

require_once('C:\OpenServer\domains\prodamus.loc\vendor\autoload.php');

$config = new Configuration();
$config->setAppSid("8ab19107-34a5-45e0-9a80-28e914c31690");
$config->setAppKey("0f5e35731d976d2c9d5fd6539841f470");
$api = new SlidesApi(null, $config);
$result = $api->convert(fopen("02_payform.pptx", 'r'), ExportFormat::PDF);
echo "My PDF was saved to " . $result->getPathname();
?>