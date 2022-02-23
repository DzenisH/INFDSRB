<script>

    function detailMyArticle(id){
        const inputId = document.getElementById('myArticles_id');
        const form = document.getElementById('myArticles_form');
        inputId.value = id; 
        form.submit();
    }

    function deleteArticle(id){
        const inputId2 = document.getElementById('myArticles_id2');
        const form = document.getElementById('myArticle_delete_form');
        inputId2.value = id; 
        form.submit();
    }

</script>

<div class="articles_container1" style="min-height: 255px;">
    <div class="articles_container2">
        <form method="GET" action="/detailArticle" id="myArticles_form">
            <?php foreach ($articles as $article):?>
                <div class="articles_container3">
                    <img class="articles_image" src="<?php echo $article['image'] ?>"
                    onclick="detailMyArticle('<?php echo $article['id'] ?>')"/>
                    <div class="articles_container4">  
                        <button style="background-color:transparent;border:none;"
                        onclick="detailMyArticle('<?php echo $article['id'] ?>')" 
                        type="button">
                            <h2 class="articles_title">
                                <?php echo $article['title'] ?>
                            </h2>
                        </button>
                        <p><?php echo $article['description'] ?></p>
                    </div>
                    <?php if(isset($_SESSION["user"]) && ($_SESSION["user"]["type"] === "doctor" ||
                        $_SESSION["user"]["type"] === "admin")) :?>
                        <button class="articles_deleteBtn" type="button"
                        onclick="deleteArticle('<?php echo $article['id'] ?>')">DELETE</button>
                    <?php endif; ?> 
                </div>
            <?php endforeach; ?>
            <input style="display: none;" name="id" id="myArticles_id"/>
        </form>
        <form method="POST" action="" id="myArticle_delete_form">
            <input id="myArticles_id2" name="id" style="display: none;"/>
        </form>
    </div>
</div>