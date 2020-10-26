
<html>
<head>

</head>
<body>
<div>
    <form method="post" action="index.php?controller=">
        <label>Search content : </label>
         <input name="search-content" placeholder="please enter your search content value">
        <br>
        <label>By category</label>
        <select name="post-category">
            <option value="0">Not set</option>
            <?php
            foreach ($categories as $category){
             ?>
                <option value="<?php echo $category->getId(); ?>"> <?php echo $category->getLabel(); ?></option>
            <?php
            }
            ?>
        </select>
        <br>
        <label>Creation date</label>
        <input name="creation-date" value="" placeholder="insert your creation date .." type="datetime-local">
        <br>
        <label>Update date</label>
        <input name="update-date" placeholder="insert your update date .." type="datetime-local">
        <br>
        <input type="submit" value="Validate">
    </form>
</div>
</body>
</html>