
<script>
    function detailArticle(id){
        const inputId = document.getElementById('articles_id');
        const form = document.getElementById('articles_form');
        inputId.value = id; 
        form.submit();
    }

</script>


<div class="articles_container1">
    <div class="articles_container2">
        <form method="GET" action="/detailArticle" id="articles_form">
            <?php foreach ($articles as $article):?>
                <div class="articles_container3">
                    <img class="articles_image" src="<?php echo $article['image'] ?>"/>
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
                </div>
            <?php endforeach; ?>
            <input style="display: none;" name="id" id="articles_id"/>
        </form>
    </div>
</div>