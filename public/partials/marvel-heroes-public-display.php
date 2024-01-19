<div class="marvel-heroes-container">
    <?php
    if (!empty($characters_data)) {
    ?>
        <div class="marvel-heroes-list">
            <?php
            foreach ($characters_data as $hero) {
                $hero_name = esc_html($hero['name']);
                $hero_thumbnail = esc_html($hero['thumbnail']['path']) . '.' . esc_html($hero['thumbnail']['extension']);
                $hero_description = esc_html($hero['description']);
                $modified_date = isset($hero['modified']) ? date('Y', strtotime($hero['modified'])) : '';

                $hero_comics = $this->fetch_marvel_characters($hero_name, '', $modified_date);

                $comics = isset($hero['comics']) ? $hero['comics'] : array();
                $series = isset($hero['series']) ? $hero['series'] : array();
                $events = isset($hero['events']) ? $hero['events'] : array();
                $stories = isset($hero['stories']) ? $hero['stories'] : array();


            ?>
                <div class="marvel-hero-item">
                    <img class="marvel-hero-item-img" src="<?php echo $hero_thumbnail; ?>" alt="<?php echo $hero_name; ?>">
                    <div class="marvel-hero-info">
                        <a href="#" class="marvel-hero-item-name" data-toggle="modal" data-target="#marvel-hero-modal-<?php echo sanitize_title($hero_name); ?>" data-name="<?php echo $hero_name; ?>" data-description="<?php echo $hero_description; ?>">
                            <?php echo $hero_name; ?>
                        </a>
                        <p><?php echo $modified_date; ?></p>
                    </div>

                </div>

                <div class="modal fade" id="marvel-hero-modal-<?php echo sanitize_title($hero_name); ?>" tabindex="-1" role="dialog" aria-labelledby="marvel-hero-modal-label-<?php echo sanitize_title($hero_name); ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="marvel-hero-modal-label-<?php echo sanitize_title($hero_name); ?>"><?php echo $hero_name; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="hero-thumbnail">
                                    <img class="marvel-hero-item-img" src="<?php echo $hero_thumbnail; ?>" alt="<?php echo $hero_name; ?>">
                                </div>
                                <div class="hero-info">
                                    <h3>Description:</h3>
                                    <p><?php echo $hero_description; ?></p>
                                    <h3>Series:</h3>
                                    <p><?php echo implode(', ', array_column($hero['series']['items'], 'name')); ?></p>
                                    <h3>Events:</h3>
                                    <p><?php echo implode(', ', array_column($hero['events']['items'], 'name')); ?></p>
                                    <h3>Stories:</h3>
                                    <p><?php echo implode(', ', array_column($hero['stories']['items'], 'name')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    <?php
    } else {
        echo '<span class="marvel-heroes-no-result">No Marvel Heroes Found.</span>';
    }
    ?>
</div>