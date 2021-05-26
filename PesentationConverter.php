<?php
/**
 * Класс для разбора PDF и PowerPoint презентаций на png-слайды.
 *
 * @package     prodamus
 * @copyright   2021 Prodamus Ltd. http://prodamus.ru/
 * @author      Sergey Shchepa <admin@web-doc.ru>
 * @version     1.0
 * @since       27.05.2021
 */

use Aspose\Slides\Cloud\Sdk\Api\SlidesApi;
use Aspose\Slides\Cloud\Sdk\Api\Configuration;
use Aspose\Slides\Cloud\Sdk\Model;
use Aspose\Slides\Cloud\Sdk\Model\Requests;

require_once( __DIR__ . '\vendor\autoload.php');


class PesentationConverter {
    /**
     * Допустимые типы файлов презентаций
     *
     * @var array
     */
    public $allowedPresentationFileTypes = [
        'application/vnd.ms-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
        'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
        'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
        'application/vnd.oasis.opendocument.presentation',
    ];

    /**
     * Допустимый тип файлов PDF
     *
     * @var string
     */
    public $allowedPdfFileType = 'application/pdf';

    /**
     * Полный путь к файлу презентации (без расширения файла)
     *
     * @var string
     */
    public $presentationPath = __DIR__ . '\presentation\presentation';

    /**
     * Cписок имен png-слайдов
     *
     * @var array
     */
    public $slidesList = [];

    /**
     * ASPOSE API клиентский номер
     *
     * @var string
     */
    public $asposeClientId = '8ab19107-34a5-45e0-9a80-28e914c31690';

    /**
     * ASPOSE API секретный ключ
     *
     * @var string
     */
    public $asposeSecretKey = '0f5e35731d976d2c9d5fd6539841f470';

// PDF, PPT, PPTX, PPTM, PPS, PPSM, ODP, FODP

	/**
	 * Проверка типа загруженного файла на соответствие разрешенным типам презентации 
     *
     * @param string  $uploadedFileType
     * @return bool
     */
    public function checkPresentationFileType($uploadedFileType) {
        if (in_array($uploadedFileType, $this->allowedPresentationFileTypes)) {
            return true;
        } else {
            return false;
        } 
    }

	/**
	 * Проверка типа загруженного файла на равенство типу PDF 
     *
     * @param string  $uploadedFileType
     * @return bool
     */
    public function checkPdfFileType($uploadedFileType) {
        if ($uploadedFileType == $this->allowedPdfFileType) {
            return true;
        } else {
            return false;
        } 
    }
 
	/**
	 * Разбор файла PDF на png-слайды
     *
     * @return bool
     */
    public function splitPdfFile() {
        $pdf = $this->presentationPath . '.pdf';
        $im = new imagick($pdf);
        $countPages = $im->getNumberImages(); 
        if ($countPages) { 
            for ($i = 0; $i < $countPages; $i++) {
                $page = $pdf . '[' . $i . ']'; 
                $image = new Imagick($page);            
                $image->setImageFormat('png'); 
                $image->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
                $image->setImageCompressionQuality(100);
                $image->writeImage(__DIR__ . '/slides/Slide-' . ($i+1) . '.png'); 
                $this->slidesList[] = 'Slide-' . ($i+1) . '.png';
            }
            return true;
        } else {
            return false;
        }
    }

	/**
	 * Разбор файла презентации на png-слайды
     *
     * @param string  $filePatsh
     * @return bool
     */
    public function splitPresentationFile($filePatsh) {
        $config = new Configuration();
        $config->setAppSid($this->asposeClientId);
        $config->setAppKey($this->asposeSecretKey);
        $api = new SlidesApi(null, $config);
        $stream = fopen($filePatsh, 'r');
        $result = $api->splitOnline($stream, Model\SlideExportFormat::PNG, null, null, null, null, null);
        $zip = zip_open($result->getPathname());
        while ($zip_entry = zip_read($zip)) {
            $contents = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
            $dataPath = 'slides/';
            file_put_contents($dataPath . zip_entry_name($zip_entry), $contents);
            $this->slidesList[] = zip_entry_name($zip_entry);
            zip_entry_close($zip_entry);
        }
        zip_close($zip);
        return true;
    }

}