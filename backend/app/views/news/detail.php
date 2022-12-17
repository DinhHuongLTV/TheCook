<?php
?>
<h2>Chi tiết nội dung tin</h2>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $data['id'] ?></td>
    </tr>
    <tr>
        <th>Tiêu đề</th>
        <td><?php echo $data['name'] ?></td>
    </tr>
    <tr>
        <th>Hạng mục</th>
        <td>
            <?php foreach ($data['categories'] as $category):?>
                <?php echo $category['id'] == $data['category_id'] ? $category['name'] : ""?>
            <?php endforeach;?>
        </td>
    </tr>
    <tr>
        <th>Ảnh minh họa</th>
        <td>
            <?php if (!empty($data['avatar'])): ?>
                <img height="80" src="assets/uploads/<?php echo $data['avatar'] ?>"/>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>Tóm tắt</th>
        <td><?php echo $data['summary'] ?></td>
    </tr>
    <tr>
        <th>Nội dung</th>
        <td><?php echo $data['content'] ?></td>
    </tr>
    <tr>
        <th>SEO title</th>
        <td><?php echo $data['seo_title'] ?></td>
    </tr>
    <tr>
        <th>SEO keywords</th>
        <td><?php echo $data['seo_keywords'] ?></td>
    </tr>
    <tr>
        <th>SEO description</th>
        <td><?php echo $data['seo_description'] ?></td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            <?php echo $data['status'] == 1 ? "Active" : "Disabled";
            ?>
        </td>
    </tr>
    <tr>
        <th>created_at</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($data['created_at'])) ?></td>
    </tr>
    <tr>
        <th>updated_at</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($data['updated_at'])) ?></td>
    </tr>
</table>
<a href="index.php?controller=news&action=index" class="btn btn-default">Back</a>