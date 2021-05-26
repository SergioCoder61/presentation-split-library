<?php
require_once('PesentationConverter.php');

$conv = new PesentationConverter;

$errorMessage = $successMessage = '';

if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] == 0) {
    $checkPdf = $conv->checkPdfFileType($_FILES['uploadedFile']['type']);
    if ($checkPdf) {
        move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $conv->presentationPath . '.pdf');
        $split = $conv->splitPdfFile();
        if ($split) { 
            $successMessage = 'Файл PDF успешно разобран на png-слайды'; 
        } else {
            $errorMessage = 'Сбой при разборке PDF файла';            
        } 
    } else {
        $checkPresentation = $conv->checkPresentationFileType($_FILES['uploadedFile']['type']);
        if ($checkPresentation) {
            $fileExtension = end(explode('.', $_FILES['uploadedFile']['name']));
            $filePatsh = $conv->presentationPath . '.' . $fileExtension;
            move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $filePatsh);    
            $split = $conv->splitPresentationFile($filePatsh);
            if ($split) { 
                $successMessage = 'Файл презентации успешно разобран на png-слайды:'; 
            } else {
                $errorMessage = 'Сбой при разборке файла презентации';            
            } 
        } else {
            $errorMessage = 'Недопустимый тип файла<br/>Допускаются файлы: PDF, PPT, PPTX, PPTM, PPS, PPSM, ODP, FODP';
        }
    }
} else {
    if ($_FILES['uploadedFile']['error'] == 1 || $_FILES['uploadedFile']['error'] == 2) {
        $errorMessage = 'Превышен допустимый размер файла';        
    }
    if ($_FILES['uploadedFile']['error'] > 2) {
        $errorMessage = 'Сбой при загрузке, файл презентации не загружен';        
    }
} 

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">
<title></title>
<style>
    div, ul, a {
        display: block;
        margin-top: 10px;
    }
</style>

</head>

<body>

<div style="color:red"><?= $errorMessage ?></div>
<div><?= $successMessage ?></div>
<?php if (!empty($conv->slidesList)): ?>
    <ul>
    <?php foreach ($conv->slidesList as $slide): ?>
        <li><?= $slide ?></li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
<a href="index.html">&lt;&lt; Загрузить файл презентации</a>
		
</body>

</html>
