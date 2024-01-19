<div class="marvel-comics-container">
    <?php
    if (isset($this->marvel_comics_data) && !empty($this->marvel_comics_data['data']['results'])) {
        $comics = $this->marvel_comics_data['data']['results'];
    ?>
        <div class="marvel-comics-list">
            <?php
            foreach ($comics as $comic) {
                $comic_title = esc_html($comic['title']);
                $comic_thumbnail = esc_html($comic['thumbnail']['path']) . '.' . esc_html($comic['thumbnail']['extension']);
            ?>
                <div class="marvel-comics-item">
                    <img class="marvel-comics-item-img" src="<?php echo $comic_thumbnail; ?>" alt="<?php echo $comic_title; ?>">
                    <span class="marvel-comics-item-title"><?php echo $comic_title; ?> </span>
                </div>
            <?php
            }
            ?>
        </div>
    <?php
    } else {
        echo '<span class="marvel-comics-no-result">No Comics Found.</span>';
    }
    ?>
</div>