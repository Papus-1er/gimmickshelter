<?php
/**
 * The template for displaying the comments section
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */

use GimmickShelter\CommentWalker;

?>

<?php
$count = absint(get_comments_number());
?>

<?php if ($count > 0): ?>
<h2><?= $count ?> Commentaire<?= $count > 1 ? 's' : '' ?></h2>
<?php else: ?>
<h2>Laisser un commentaire</h2>
<?php endif ?>

<?php if (comments_open()): ?>
<?php comment_form([
    'title_reply' => 'Title test'
]) ?>
<?php endif ?>
<?php wp_list_comments([
    'style' => 'div',
    'walker' => new CommentWalker(),
    'reverse_top_level' => true
    ]) ?>
<?php paginate_comments_links() ?>