<?php
$connect = mysqli_connect("localhost", "root", "root", "softjet")//��������� � ������� ("����", "��� ������������", "������")
or die("<p>������ ����������� � ���� ������! " . mysqli_error($connect). "</p>");


 function handle_error($user_error_message, $system_error_message)
 {die ($user_error_message ." " . $system_error_message); };
 $upload_dir = "user_images/";
 $image_fildname = "user_pic";
 
 $php_errors = array(1 => '�������� ���. ������ �����, ��������� � php.ini',
 2 => '��������� ���. ������ �����, ��������� � ����� html',
 3 => '���� ���������� ������ ����� �����',
 4 => '���� ��� �������� �� ��� ������');
 //�������� �� ������ ��� ��������
$_FILES[$image_fildname]['error'] == 0
or handle_error ("������� �� ������� �������� ���� �����������<br>" , $php_errors[$_FILES[$image_fildname]['error']]);

 //������������� �� ������������ ���� �����������. ��������
@getimagesize($_FILES[$image_fildname]['tmp_name'])
or handle_error("<p> �� ������� ����, ������� �� �������� ������������<br>", $_FILES[$image_fildname]['tmp_name'] ." �� �������� ������������");

//����������� �����
$now = time();
while(file_exists($upload_filename = $upload_dir . $now . '-' . $_FILES[$image_fildname]['name'])){
	$now++;
}
echo $upload_filename;

@move_uploaded_file($_FILES[$image_fildname]['tmp_name'], $upload_filename)
or handle_error("�������� �������� ��� ���������� ������ ����������� � ��� ���������� ����� <br>",
"������, ��������� � ������� ������� ��� ����������� ����� � {$upload_filename}");

$insert_sql = "INSERT INTO `articles` SET `image` = '$upload_filename'";
mysqli_query($connect, $insert_sql);

?>