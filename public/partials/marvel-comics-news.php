<div class="marvel-news-container">
    <?php
    if (!empty($news_data)) {
        usort($news_data, function ($a, $b) {
            $dateA = strtotime($a['modified']);
            $dateB = strtotime($b['modified']);
            return $dateB - $dateA;
        });
    ?>
        <div class="marvel-news-list">
            <?php
            foreach ($news_data as $news_item) {
                $news_title = esc_html($news_item['title']);
                $news_thumbnail = esc_html($news_item['thumbnail']['path']) . '.' . esc_html($news_item['thumbnail']['extension']);

                // Output the news item
            ?>
                <div class="marvel-news-item">
                    <?php if (!empty($news_thumbnail)) : ?>
                        <img src="<?php echo $news_thumbnail; ?>" alt="<?php echo $news_title; ?>">
                    <?php endif; ?>
                    <p><?php echo $news_title; ?></p>
                </div>
            <?php } ?>
        </div>
    <?php } else {
        echo 'No Marvel news available.';
    } ?>
</div>