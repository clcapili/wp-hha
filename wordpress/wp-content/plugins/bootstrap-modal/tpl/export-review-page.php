<h1>Review Export</h1>

    <div class="wrap">
        <?php $table->display(); ?>

        <hr />
        
        <h2>Export</h2>
        <p>This will export the entire site as static files.</p>
        <form action="<?= admin_url('admin-post.php')?>" method="post">
            <input type="hidden" name="type" value="export">
            <input type="hidden" name="action" value="export_site">
            <input <?= ($exportDisabled)  ? 'disabled' : '' ?> class="button button-primary" type="submit" value="Export Site" />
        </form>
        
    </div>

    <script>
  
    </script>
