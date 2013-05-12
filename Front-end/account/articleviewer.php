<?php
	/*
	File name: /account/feeds/ajax.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: Page to show the entire article and it's metadata and comments
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/thirdparty/smarty/Smarty.class.php';
	require_once ROOT.'/classes/User.php';
	require_once ROOT.'/classes/Article.php';
	require_once ROOT.'/classes/CommentCollection.php';
	require_once ROOT.'/classes/ImageCollection.php';
	require_once ROOT.'/misc/misc.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');
		
	assert($_GET['articleid']);
	assert($_GET['sheetid']);
	
	$article = new Article($_GET['articleid'],$_GET['sheetid']);
	$comments = new CommentCollection($_GET['articleid']);
	$images = new ImageCollection($_GET['articleid']);
	
	$gui = new Smarty;
	$gui->setTemplateDir(ROOT.'/templates');
	$gui->setCompileDir(ROOT.'/templates_c');
	
	$gui->assign('article',array(
	    'title' => $article->getTitle(),
	    'feedname' => $article->getFeedName(),
	    'time' => $article->getTime(),
	    'url' => $article->getURL(),
	    'content' => $article->getContent(),
	    'geo' => $article->getGeo(),
	    'author' => $article->getAuthor()
	));
	
	$images_array = array();
	$comments_array = array();
	
	while ($images->more()) {
	    $image = $images->next();
	    $imagedata = array();
	    $imagedata['data'] = 'data:image/jpg;base64,'.base64_encode($image['data']);
	    $imagedata['url'] = $image['url'];
	    $images_array[] = $imagedata;
	}
	while ($comments->more())
	    $comments_array[] = $comments->next();
	
	$gui->assign('images',$images_array);    
	$gui->assign('comments',$comments_array);
	$gui->display('root.account.articleviewer.tpl');
/*?>
	<div id="content" class="xfluid">
		
		<div id="article-details" class="portlet x8" style="min-height: 300px;">
			
			<div class="portlet-content">
				<h1><?php echo $article->getTitle(); ?></h1>
				
				<div class="request-info">

					<ul>

						<li><strong>Posted by:</strong> <?php echo $article->getFeedName(); ?></li>

						<li><strong>When:</strong> <?php echo $article->getTime(); ?></li>

						<li><strong>Tags:</strong> <div class="ticket open">Local News</div></li>

						<li><strong>Relevance:</strong> Normal</li>

					</ul>

					<?php
						while ($images->more()) {
							$image = $images->next();
							echo '<a rel="facebox" href="'.$image.'"><img src="'.$image.'" alt="" width="35" height="35"/></a>';
						}
					?>
					
				</div>

				<p><b>Original Article: </b><a href="<?php echo $article->getURL(); ?>" target="_blank"><?php echo $article->getURL(); ?></a></p>
				
				<?php echo $article->getContent(); ?>

				<hr />
				
				<h3>Comments</h3>

				<table>
					<?php
						while ($comments->more()) {
							$comment = $comments->next();
							echo '					<tr>';
							echo '						<td><img src="'.$comment['avatar'].'" class="avatar_img" alt="" /></td>';
							echo '						<td>';
							echo '							<p><strong>'.$comment['author'].'</strong> via '.$comment['via'].' on '.convert_datetime($comment['date'],true).'</p>';
							echo '							<p>'.$comment['comment'].'</p>';
							echo '						</td>';
							echo '					</tr>';
						}
					?>

					<tr>
						<td><img src="/images/avatar.jpg" class="avatar_img" alt="" /></td>
						<td>
							<form action="/account/addcomment.php" method="POST" class="form label-top">
								<input name="articleid" type="hidden" value="<?php echo $_GET['articleid']; ?>"/>
								<div class="field">
									<label for="comment">Reply:</label>
									<textarea name="comment" rows="6" cols="60"></textarea>
								</div>
								
								<br />

								<div class="buttonrow">
									<button class="btn btn-orange">Reply</button>
								</div>
							</form>
						</td>
					</tr>
				</table>
			</div>
		</div>	
		
		<div class="portlet x4">
			<div class="portlet-header"><h4>Extra Details</h4></div>
			
			<div class="portlet-content">
			<?php
				if ($article->getGeo()!=null)
					echo '<iframe width="350" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/?q='.$article->getGeo().'&amp;ie=UTF8&amp;t=m&amp;z=5&amp;vpsrc=0&amp;output=embed"></iframe>';
			?>
			</div>
		</div>
		
	</div>
<?php
	$gui->footer();
*/?>