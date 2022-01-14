<div class="addArticle_container1">
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="addArticle_container2">
            <div class="addArticle_container3">
                <p class="addArticle_title">Title</p>
                <input class="addArticle_title_input" name="title"/>
            </div>
            <div class="addArticle_container3">
                <p class="addArticle_title">Description</p>
                <input class="addArticle_title_input" style="margin-left: 20px;" name="description"/>
            </div>
            <div class="addArticle_container3">
                <p class="addArticle_title">Content</p>
                <textarea class="addArticle_textarea" name="content"></textarea>
                <div class="addArticle_information">
                    <p># - for Heading 1</p>
                    <p>## - for Heading 2</p>
                    <p>If you want paragraph after header put two white space after header and then press enter</p>
                    <p>*text* - text will be italic</p>
                    <p>**bold** - text will be bold</p>
                    <p>*text - list item with bullet</p>
                    <p>--- - Horizontal rule</p>
                    <p>1. One- list item with number</p>
                    <p>![Image](http://url/a.png) - provide image</p>
                    <p>[Link](http://a.com) - provide link</p>
                </div>
            </div>
            <div class="addArticle_container3">
                <p class="addArticle_title">Image</p>
                <input type="file" name="image" style="margin-left: 75px;"/>
            </div>
            <input style="display: none;" name="id" value="<?php echo $_SESSION['user']['id'] ?>"/>
            <input style="display: none;" name="type_of_user" value="<?php echo $_SESSION['user']['type'] ?>"/>
            <button class="addArticle_btn" type="submit">Confirm</button>
        </div>
    </form>
</div>

