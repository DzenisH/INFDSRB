<div class="detailArticle_container1">
    <div class="detailArticle_container2">
        <p class="detailArticle_title"><?php echo $article['title'] ?></p>
        <div class="detailArticle_container3">
            <img class="detailArticle_author_image" src="<?php echo $author['image'] ?>"/>
            <p class="detailArticle_author_name"><?php echo $author['name'] ?> 
            <?php echo $author['last_name'] ?></p>
        </div>
        <img class="detailArticle_image" src="<?php echo $article['image'] ?>"/>
        <div class="detailArticle_container4">
            <?php 
            $Parsedown = new Parsedown();
            echo $Parsedown->text($article['content'])?>
        </div>
    </div>
</div>