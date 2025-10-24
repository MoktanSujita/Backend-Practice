<?php
include 'config.php';

//fetching the files from the db by the latest uploaded first
$stmt = $conn->query("SELECT * FROM uploads ORDER BY uploaded_at DESC");
//fetching allthe files
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Uploads</h2>
<ul>
    <!--looping throught each file-->
    <?php foreach($files as $file):?>
        <li>
            <!-- echo $file['filepath'] -> opens the file
             target-> how the file is opened (in same tab or different window)-->
            <a href="<?php echo $file['filepath'];?>" target="_blank">
            <!--htmlspecialchars - prevents HTML injection -->
                <?php echo htmlspecialchars($file['filename']); ?>
            </a>
        </li>
    <?php endforeach;?> 
</ul>