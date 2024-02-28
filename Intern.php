<?php

    function validationLength($title){
        if(strlen($title) < 4 || strlen($title) > 140){
            return "ชื่อกระทู้ต้องมีความยาวระหว่าง 4-140 ตัวอักษร ";
        }
    }
    function validationHtml($title){
        if($title !== strip_tags($title)){
            return "ชื่อกระทู้ไม่สามารถใช้ tags ได้ ";
        }
    }
    function validationConLength($content){
        if(strlen($content) < 6 || strlen($content) > 2000){
            return "เนื้อหาในกระทู้ต้องมีความยาว 6-2000 ตัวอักษร ";
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = $_POST["title"];
        $content = $_POST["content"];

        $titleResultLength = validationLength($title);
        if($titleResultLength){
            echo $titleResultLength;
        }

        $titleResultHtml = validationHtml($title);
        if($titleResultHtml){
            echo $titleResultHtml;
        }

        $contentResult = validationConLength($content);
        if($contentResult){
            echo $contentResult;
        }

        if(!$titleResultLength && !$titleResultHtml && !$contentResult) {
            echo "<h2>กระทู้ล่าสุด</h2>";
            echo "<p>หัวข้อกระทู้ : " . htmlspecialchars($title) . "</p>";
            echo "<p>เนื้อหา: " . $content . "</p>";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>กระทู้</title>
</head>
<body style= "text-align: center;">
    <h1>ตั้งกระทู้ใหม่</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="title">หัวข้อกระทู้:</label><br>
    <input type="text" id="title" name="title"><br><br>
    <label for="content">เนื้อหา:</label><br>
    <textarea id="content" name="content" rows="4" cols="50"></textarea><br><br>
    <button type="button" onclick="makeBold()" title="ตัวหนา">Bold</button>
    <button type="button" onclick="makeItalic()" title="ตัวเอียง">Italic</button>
    <button type="button" onclick="makeMark()" title="ไฮไลท์">Highlight</button>
    <br><br>
    <input type="submit" value="Submit">
    </form>
    <script>
        function makeBold() {
            var content = document.getElementById("content");
            var selectedText = content.value.substring(content.selectionStart, content.selectionEnd);
            var newText = "<b>" + selectedText + "</b>";
            content.setRangeText(newText);
        }
        function makeItalic() {
            var content = document.getElementById("content");
            var selectedText = content.value.substring(content.selectionStart, content.selectionEnd);
            var newText = "<i>" + selectedText + "</i>";
            content.setRangeText(newText);
        }
        function makeMark() {
            var content = document.getElementById("content");
            var selectedText = content.value.substring(content.selectionStart, content.selectionEnd);
            var newText = "<mark>" + selectedText + "</mark>";
            content.setRangeText(newText);
        }
    </script>
</body>
</html>