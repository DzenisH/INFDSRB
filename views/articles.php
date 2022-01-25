
<script>

    function detailArticle(id){
        const inputId = document.getElementById('articles_id');
        const form = document.getElementById('articles_form');
        inputId.value = id; 
        form.submit();
    }

    function deleteArticle(id){
        const inputId2 = document.getElementById('articles_id2');
        const form = document.getElementById('article_delete_form');
        inputId2.value = id; 
        form.submit();
    }

</script>


<div class="articles_container1">
    <div class="articles_container2">
        <form method="GET" action="/detailArticle" id="articles_form">
            <?php foreach ($articles as $article):?>
                <div class="articles_container3">
                    <img class="articles_image" src="<?php echo $article['image'] ?>"
                    onclick="detailArticle('<?php echo $article['id'] ?>"/>
                    <div class="articles_container4">  
                        <button style="background-color:transparent;border:none;"
                        onclick="detailArticle('<?php echo $article['id'] ?>')" 
                        type="button">
                            <h2 class="articles_title">
                                <?php echo $article['title'] ?>
                            </h2>
                        </button>
                        <p><?php echo $article['description'] ?></p>
                    </div>
                    <?php if(isset($_SESSION["user"]) && $_SESSION["user"]["type"] === "doctor") :?>
                        <button class="articles_deleteBtn" type="button"
                        onclick="deleteArticle('<?php echo $article['id'] ?>')">DELETE</button>
                    <?php endif; ?> 
                </div>
            <?php endforeach; ?>
            <input style="display: none;" name="id" id="articles_id"/>
        </form>
        <form method="POST" action="" id="article_delete_form">
            <input id="articles_id2" name="id" style="display: none;"/>
        </form>
    </div>
</div>