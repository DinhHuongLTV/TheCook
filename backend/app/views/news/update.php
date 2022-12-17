<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Tên tiêu đề: </label>
        <input type="text" class="form-control" id="name" placeholder="Enter title" name="name"
               value="<?php echo isset($data['name']) ? $data['name'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['ne']) ? $data['ne'] : "" ?>
        </small>
    </div>

    <div class="form-group">
        <label for="category">Hạng mục: </label>
        <select name="category" id="" class="form-control">
            <?php foreach ($data['categories'] as $category): ?>
                <option value="<?php echo $category['id'] ?>"
                    <?php echo $data['category'] == $category['id'] ? "selected" : ""?>
                >
                    <?php echo $category['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['cae']) ? $data['cae'] : "" ?>
        </small>
    </div>

    <div class="form-group">
        <label for="avatar">Ảnh minh họa: </label>
        <input type="file" name="avatar" id="avatar" class="form-control">
        <?php if(isset($data['avatar'])): ?>
            <img src="assets/uploads/<?php echo $data['avatar']?>" style="height: 100px" alt="hinh anh minh hoa">
        <?php endif;?>
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['ae']) ? $data['ae'] : "" ?>
        </small>
    </div>

    <div class="form-group">
        <label for="summary">Tóm tắt nội dung tin: </label>
        <textarea name="summary" placeholder="Enter news's summary"><?php echo !empty($data['summary']) ? $data['summary'] : ""?></textarea>
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['se']) ? $data['se'] : "" ?>
        </small>
    </div>

    <div class="form-group">
        <label for="content">Nội dung: </label>
        <textarea name="content" placeholder="Enter news's content"><?php echo !empty($data['content']) ? $data['content'] : ""?></textarea>
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['ce']) ? $data['ce'] : "" ?>
        </small>
    </div>

    <div class="form-group">
        <label for="seo_title">SEO title: </label>
        <input type="text" class="form-control" id="seo_title" placeholder="Enter SEO title" name="seo_title"
               value="<?php echo isset($data['seo_title']) ? $data['seo_title'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['ste']) ? $data['ste'] : "" ?>
        </small>
    </div>

    <div class="form-group">
        <label for="seo_keywords">SEO keywords: </label>
        <input type="text" class="form-control" id="seo_keywords" placeholder="Enter SEO keywords" name="seo_keywords"
               value="<?php echo isset($data['seo_keywords']) ? $data['seo_keywords'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['ske']) ? $data['ske'] : "" ?>
        </small>
    </div>

    <div class="form-group">
        <label for="seo_keywords">SEO summary: </label>
        <input type="text" class="form-control" id="seo_keywords" placeholder="Enter SEO summary" name="seo_description"
               value="<?php echo isset($data['seo_description']) ? $data['seo_description'] : "" ?>">
        <small class="form-text text-muted" style="color: red">
            <?php echo !empty($data['sse']) ? $data['sse'] : "" ?>
        </small>
    </div>

    <div class="form-group">
        <label for="">Status: </label>
        <select name="status" id="" class="form-control">
            <?php
                $selected_active = "";
                $selected_disabled = "";
                $data['status'] ? $selected_active = "selected" : $selected_disabled = "selected";
            ?>
            <option value="1" <?php echo $selected_active?> >Active</option>
            <option value="0" <?php echo $selected_disabled?> >Disabled</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" value="Update" name="submit" class="btn btn-primary">
        <a href="index.php?controller=news&action=index" class="btn btn-warning">Back</a>
    </div>
</form>