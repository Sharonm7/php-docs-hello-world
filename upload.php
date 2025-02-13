<?php
if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
    $file = $_FILES['file']['tmp_name'];
    $filename = $_FILES['file']['name'];

    // Azure Function URL (Replace with your actual function URL)
    $url = "https://uploadfunctionapp.azurewebsites.net/api/FileCreator";

    // Prepare file for upload
    $cFile = curl_file_create($file, mime_content_type($file), $filename);
    $postData = ['file' => $cFile];

    // cURL request to Azure Function
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    curl_close($ch);

    echo "Response from Azure Function: " . $response;
} else {
    echo "File upload failed!";
}
?>
