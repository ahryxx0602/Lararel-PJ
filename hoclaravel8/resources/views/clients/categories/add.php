<h1>Thêm chuyên mục</h1>
<form method="post" action="<?php echo route('categories.add') ?>">
              <div>
                            <input type="text" name="category_name" placeholder="Tên chuyên mục" />
              </div>
              <?php echo csrf_field(); ?>
              <button type="submit">Submit</button>
</form>