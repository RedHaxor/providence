<?php
/* ----------------------------------------------------------------------
 * themes/default/statistics/panels/counts_by_type_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2019 Whirl-i-Gig
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

	$data = $this->getVar('data');
	$totals = is_array($data['records']['counts']['by_type']) ? $data['records']['counts']['by_type'] : [];

?>
	<h3><?php print _t('Records totals by type'); ?></h3>
	<ul>
<?php
	foreach($totals as $table => $totals) {
		print "<li>".caUcFirstUTF8Safe(Datamodel::getTableProperty($table, 'NAME_PLURAL'))."<ul>";
		foreach($totals as $access => $total) {
			print "<li>{$access}: {$total}</li>\n";
		}
		print "</ul></li>\n";
	}
?>
	</ul>
<?php
