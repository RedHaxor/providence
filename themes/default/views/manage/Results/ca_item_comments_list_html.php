<?php
/* ----------------------------------------------------------------------
 * themes/default/views/manage/Results/ca_item_comments_list_html.php :
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2009-2019 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * This source code is free and modifiable under the terms of
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */ 
 	$result = $this->getVar('result');
	$items_per_page = $this->getVar('current_items_per_page');
	
	$i = 0;
	$item_count = 0;
?>
	<div id="commentsResults">	
		<div style="text-align:right;">
			<?php print _t('Batch actions'); ?>: <a href='#' onclick='jQuery("#commentListForm").attr("action", "<?php print caNavUrl($this->request, 'manage', 'Comments', 'Approve'); ?>").submit();' class='form-button'><span class='form-button approveDelete'><?php print caNavIcon(__CA_NAV_ICON_APPROVE__, 1); ?><span class='formtext'><?php print _t("Approve"); ?></span></span></a>
			<a href='#' onclick='jQuery("#commentListForm").attr("action", "<?php print caNavUrl($this->request, 'manage', 'Comments', 'Delete'); ?>").submit();' class='form-button'><span class='form-button approveDelete'><?php print caNavIcon(__CA_NAV_ICON_DELETE__, 1); ?><span class='formtext'><?php print _t("Delete"); ?></span></span></a>
		</div>
		<table id="caItemList" class="listtable" border="0" cellpadding="0" cellspacing="1" style="margin-top:10px;">
			<thead>
				<tr>
					<th class="list-header-nosort">
						<?php print _t('Item'); ?>
					</th>
					<th class="list-header-nosort">
						<?php print _t('Comment'); ?>
					</th>
					<th class="list-header-nosort">
						<?php print _t('Author'); ?>
					</th>
					<th class="list-header-nosort">
						<?php print _t('Date'); ?>
					</th>
					<th class="list-header-nosort">
						<?php print _t('Status'); ?>
					</th>
					<th class="list-header-nosort">
						<?php print _t('Notes'); ?>
					</th>
					<th class="list-header-nosort"><?php print _t('Select'); ?></th>
				</tr>
			</thead>
			<tbody>

<?php	

        $comment_data = ca_item_comments::getItemCommentDataForResult($result, ['itemsPerPage' => $items_per_page, 'request' => $this->request]);
        
        $item_count = 0;
		while(($item_count < $items_per_page) && $result->nextHit()) {
		    $d = ca_item_comments::getItemCommentDataForDisplay($result, $comment_data);
?>
				<tr>
					<td>
<?php
						print !$d['id'] ? $d['label'] : caEditorLink($this->request, $d['label'], '', $d['table_num'], $d['row_id'])." ({$d['idno']})";
?>
					</td>
					<td>
						<div class="caUserCommentsListComment">
							<?php print $d['comment']; ?>
						</div>
					</td>
					<td>
						<div class="caUserCommentsListName">
<?php 
						    print "{$d['name']} ({$d['email']})";
?>
						</div>
					</td>
					<td>
<?php 
						print $d['created_on'];
?>
					</td>
					<td>
						<?php print $d['moderated_on'] ? _t("Approved") : _t("Needs moderation"); ?>
					</td>
					<td>
<?php
                        if ($d['notes']) { print "{$d['notes']}<br/>\n"; }
						if($result->getMediaTag('ca_item_comments.media1', "thumbnail")){
							print "<span style='white-space: nowrap;'>".$result->getMediaTag("ca_item_comments.media1", "thumbnail");
							print caNavButton($this->request, __CA_NAV_ICON_DOWNLOAD__, _t('Download'), '', 'manage', 'Comments', 'DownloadMedia', array('version' => 'original', 'comment_id' => $result->get('ca_item_comments.comment_id'), 'mode' => 'search', 'download' => 1), array(), array('no_background' => true, 'dont_show_content' => true));
							print "</span>";
						}
?>
					</td>
					<td>
						<input type="checkbox" name="comment_id[]" value="<?php print $result->get('comment_id'); ?>">
					</td>
				</tr>
<?php
			$i++;
			$item_count++;
		}
?>
			</tbody>
		</table>
	</div><!--end commentsResults -->
