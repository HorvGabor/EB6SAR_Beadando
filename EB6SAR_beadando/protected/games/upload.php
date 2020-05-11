<?php  
    require_once DATABASE_CONTROLLER;

    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        $title = $_POST['title'];
        $publisher = $_POST['publisher'];
        $release_date = $_POST['release_date'];
        $price = $_POST['price'];

        $max_string_lenght = 255;

        if ($title == null) {
            $errors['title'][] = "Title is required";
        }
        
        if (strlen($title) <= 2) {
            $errors['title'][] = "Title must be longer than 2";
        }
        if (strlen($title) > $max_string_lenght) {
            $errors['title'][] = "Title must be shorter than {$max_string_lenght}";
            
        }
        

        if ($publisher == null) {
            $errors['publisher'][] = "Publisher is required";
        }
        if (strlen($publisher) > $max_string_lenght) {
            $errors['publisher'][] = "Publisher must be shorter than {$max_string_lenght}";
        }
        

        if ($release_date == null) {
            $errors['release_date '][] = "Release date  is required";
        }
        if (!is_numeric($year)) {
            $errors['release_date '][] = "Release date  must be a number";
        }
        if ($release_date  <= 1900) {
            $errors['release_date '][] = "Release date  must be greater or eq. than 1900";
        }
            $curr_year = date('Y');
        if ($release_date  > $curr_year) {
            $errors['release_date '][] = "Release date  must be less than {$curr_year}";
        }
        

        if ($price == null) {
            $errors['price'][] = "Price is required";
        }
        
        if($_FILES["image"]["tmp_name"]!=null){
            $target_dir = BASE_PATH."/img/upload/";
            $target_file = $target_dir.basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $img = getimagesize($_FILES["image"]["tmp_name"]);
            if($img == false) {
                $errors['image'][] = "File is not an image.";  
            }
            if (file_exists($target_file)) {
                $errors['image'][] = "Sorry, file already exists.";   
            }
            if ($_FILES["image"]["size"] > 500000) {
                $errors['image'][] = "Sorry, your file is too large.";    
            }
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $errors['image'][] = "Only JPG, JPEG, PNG & GIF files are allowed.";
            }
            if (count($errors) == 0 )
            {
                if(move_uploaded_file($_FILES['image']['tmp_name'],$target_file)) {
                    $sql = $db->prepare("INSERT INTO `books` (`title`, `writer`, `year`, `cover`, `description`) VALUES (?, ?, ?, ?, ?)");
                    $sql->bind_param("ssiss", $title, $writer, $year, $_FILES['image']['name'], $description);
                    $sql->execute();
                    $sql->close();
                
                    $new_id = $db->insert_id;
                } 
            }else{
                $error["image"][]="Something happened";
            }
        }else{if (count($errors)) {
            $sql = $db->prepare("INSERT INTO `games` (`title`, `release_date`, `publisher`, `price`) VALUES (?, ?, ?, ?)");
            $sql->bind_param("ssis", $title, $publisher, $release_date, $price);
            $sql->execute();
            $sql->close();
            
            $new_id = $db->insert_id;

        }       
    }
}
?>
<?php include_once "_header.php"; ?>
<div class="page page-upload">
<h1>Upload</h1>
<form action="?p=upload" method="POST" enctype="multipart/form-data">
    <div class="form-group<?php echo isset($errors['title']) ? " has-error" : "" ?>">
        <label for="title">Title</label>
        <input class="form-input" type="text" name="title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : ''; ?>">
        <?php
            if (isset($errors['title'])) {
                foreach($errors['title'] as $error) {
                    echo "<p class='input-error'>$error</p>";
                }
            }
        ?>
    </div>
    <div class="form-group<?php echo isset($errors['year']) ? " has-error" : "" ?>">
        <label for="year">Year</label>
        <input class="form-input" type="number" name="year" value="<?php echo isset($year) ? $year : ''; ?>">
        <?php if (isset($errors['year'])) : ?>
            <?php foreach($errors['year'] as $error) : ?>
                <p class="input-error"><?php echo $error; ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="form-group<?php echo isset($errors['writer']) ? " has-error" : "" ?>">
        <label for="writer">Writer</label>
        <input class="form-input" type="text" name="writer" value="<?php echo isset($writer) ? $writer : ''; ?>">
        <?php echo html_errors('writer'); ?>
    </div>
    <div class="form-group<?php echo isset($errors['description']) ? " has-error" : "" ?>">
        <label for="description">Description</label>
        <textarea class="form-input" name="description"><?php echo isset($description) ? $description : ''; ?></textarea>
        <?php echo html_errors('description'); ?>
    </div>
    <div class="form group<?php echo isset($errors['image']) ? " has-error" : "" ?>">
        Select image to upload:
        <input type="file" name="image" id="image">
        <?php echo html_errors('image'); ?>
    </div>
    <div class="form-group">
        <button class="btn" type="submit">Create</button>
    </div>
</form>
</div>
<?php include_once "_footer.php"; ?>