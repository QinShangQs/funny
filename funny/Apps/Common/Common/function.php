<?php
// 获取文件夹大小
function getDirSize($dir) {
	$handle = opendir ( $dir );
	while ( false !== ($FolderOrFile = readdir ( $handle )) ) {
		if ($FolderOrFile != "." && $FolderOrFile != "..") {
			if (is_dir ( "$dir/$FolderOrFile" )) {
				$sizeResult += getDirSize ( "$dir/$FolderOrFile" );
			} else {
				$sizeResult += filesize ( "$dir/$FolderOrFile" );
			}
		}
	}
	closedir ( $handle );
	return $sizeResult;
}
// 单位自动转换函数
function getRealSize($size) {
	$kb = 1024; // Kilobyte
	$mb = 1024 * $kb; // Megabyte
	$gb = 1024 * $mb; // Gigabyte
	$tb = 1024 * $gb; // Terabyte
	
	if ($size < $kb) {
		return $size . " B";
	} else if ($size < $mb) {
		return round ( $size / $kb, 2 ) . " KB";
	} else if ($size < $gb) {
		return round ( $size / $mb, 2 ) . " MB";
	} else if ($size < $tb) {
		return round ( $size / $gb, 2 ) . " GB";
	} else {
		return round ( $size / $tb, 2 ) . " TB";
	}
}
function deldir($dir) {
	// 先删除目录下的文件：
	$dh = opendir ( $dir );
	while ( $file = readdir ( $dh ) ) {
		if ($file != "." && $file != "..") {
			$fullpath = $dir . "/" . $file;
			if (! is_dir ( $fullpath )) {
				unlink ( $fullpath );
			} else {
				deldir ( $fullpath );
			}
		}
	}
	
	closedir ( $dh );
	// 删除当前文件夹：
	if (rmdir ( $dir )) {
		return true;
	} else {
		return false;
	}
}