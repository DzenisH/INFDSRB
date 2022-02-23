<script>

    window.onload = function(){
        document.getElementById("addArticle_title_required").style.display = "none";
        document.getElementById("addArticle_description_required").style.display = "none";
        document.getElementById("addArticle_content_required").style.display = "none";
        document.getElementById("addArticle_image_required").style.display = "none";

    }

    function addArticle(){
        const form = document.getElementById("addArticle_form");
        const title = document.getElementById("addArticle_title_input").value;
        const description = document.getElementById("addArticle_description").value;
        const content = document.getElementById("addArticle_content").value;
        const image = document.getElementById("addArticle_image").value;
        if(title.length === 0 || description.length === 0 || content.length === 0 ||
        image === '')
        {
            if(title.length === 0){
                document.getElementById("addArticle_title_required").style.display = "block";
            }else{
                document.getElementById("addArticle_title_required").style.display = "none";
            }
            if(description.length === 0){
                document.getElementById("addArticle_description_required").style.display = "block";
            }else{
                document.getElementById("addArticle_description_required").style.display = "none";
            }
            if(content.length === 0){
                document.getElementById("addArticle_content_required").style.display = "block";
            }else{
                document.getElementById("addArticle_content_required").style.display = "none";
            }
            if(image === ''){
                document.getElementById("addArticle_image_required").style.display = "block";
            }else{
                document.getElementById("addArticle_image_required").style.display = "none";
            }
        }
        else{
            form.submit();
        }
    }
</script>

<div class="addArticle_container1">
    <form method="POST" action="" enctype="multipart/form-data" id="addArticle_form">
        <div class="addArticle_container2">
            <div>
                <div class="addArticle_container3">
                    <p class="addArticle_title">Title</p>
                    <input class="addArticle_title_input" name="title" id="addArticle_title_input"/>
                </div>
                <p style="color:red;margin-left:137px;font-size:14px;" 
                id="addArticle_title_required">
                    Title is required
                </p>
            </div>
            <div>
                <div class="addArticle_container3">
                    <p class="addArticle_title">Description</p>
                    <input class="addArticle_title_input" id="addArticle_description"
                    style="margin-left: 20px;" name="description"/>
                </div>
                <p style="color:red;margin-left:137px;font-size:14px;" 
                id="addArticle_description_required">
                    Description is required
                </p>
            </div>
            <div>
                <div class="addArticle_container3">
                    <p class="addArticle_title">Content</p>
                    <textarea class="addArticle_textarea" name="content"
                        id="addArticle_content"></textarea>
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
                <p style="color:red;margin-left:137px;font-size:14px;" 
                id="addArticle_content_required">
                    Description is required
                </p>
            </div>
            <div>
                <div class="addArticle_container3">
                    <p class="addArticle_title">Image</p>
                    <input type="file" name="image" style="margin-left: 75px;"
                    id="addArticle_image"/>
                </div>
                <p style="color:red;margin-left:137px;font-size:14px;" 
                id="addArticle_image_required">
                    Image is required
                </p>
            </div>
            <input style="display: none;" name="id" value="<?php echo $_SESSION['user']['id'] ?>"/>
            <input style="display: none;" name="type_of_user" value="<?php echo $_SESSION['user']['type'] ?>"/>
            <button class="addArticle_btn" onclick="addArticle()"
            type="button">
                Confirm
            </button>
        </div>
    </form>
</div>

