<?php                                                                                                                
//DBに接続
try {
    $pdo = new PDO('mysql:host=localhost;dbname=bbs', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    throw $e;
}                                                                                         

//フォームに入力されたidの登録内容を取得foreach ($pdo->query($query) as $row):
  $edit_id = $_POST['edit_id'];
  
  if(!empty ($_POST['edit'])){
  { 
    $sql = "SELECT * FROM post WHERE (id = :id)";
    $stmt = $pdo->prepare($sql);
    $edit_info=$stmt->execute(array('id' => $edit_id));
    foreach ($edit_info as $row) 
  // }

//変更内容が送信されたら、フォームに入力された変更データをDBに上書き
if(!empty ($_POST['Update']))
{
    $name = $_POST["name"];
    $title = $_POST["title"];
    $body = $_POST["body"];
}

if (strlen($name) and strlen($title) and strlen($body))
{
    $sql = "UPDATE post SET name = :name, title = :title, body = :body 
    WHERE (id = :id);"; 
    $stmt = $pdo->prepare($sql);
    $stmt ->bindparam(":name", $name);
    $stmt ->bindparam(":title", $title);
    $stmt ->bindparam(":body", $body);
    $stmt ->execute();
}
//id入力フォーム
echo "<form method='POST' action='edit.php'>";
echo "変更 No:<input type='text' name='edit_id' size='5' >";
echo "<input type='submit' name='delete' value='edit' >";


//編集フォームに取得した情報をセットし、上書き内容をedit.phpに送信
echo "<input type='hidden' name='id' value='" . htmlentities($_GET["id"],ENT_QUOTES) . "'>";
echo "名前：<input type='text' name='name' value='" . $row['name'] . "'><br>";
echo "タイトル：<input type=x'text' name='title' value='" . $row['title'] . "'><br>";
echo "本文：<textarea name='body'>" . $row['body'] . "</textarea><br>";
echo "<input type='submit' value='Update'>";
echo "</form>";
?>