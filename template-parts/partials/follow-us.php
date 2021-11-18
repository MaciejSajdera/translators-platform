<?php
$section_5 = get_field("section_5", 1141);
$section_5_title = $section_5['title'];
$section_5_image = $section_5['image'];
$section_5_link = $section_5['link'];
$section_5_paragraph = $section_5['paragraph'];

?>


<div class="follow-us-holder wrapper-flex-column m--auto">
    <h2 class="fs--1000 fw--900 text--blue"><?php echo $section_5_title ?></h2>
    <div class="image-holder">
        <a href="<?php echo $section_5_link ?>" class="w--full text--right mt--7 mb--4 pr--4"><img src="<?php echo $section_5_image['url'] ?>" /></a>
    </div>
    <p class="text--turquoise fs--600 fw--500">
        <?php echo $section_5_paragraph ?>
    </p>
</div>