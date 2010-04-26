<?php
/*******************************************************************
* Glype Proxy Script
* 
* This theme configuration file allows easy customization of the
* theme without editing the HTML templates.
*******************************************************************
* Theme: Simple
* Author: Glype
* Website: http://www.glype.com/
******************************************************************/

/*****************************************************************
* Themes can use "theme replacements". These are HTML tags of the format
* <!--[tag_name]--> in the template files. To automatically replace
* these placeholders with other text, use the $themeReplace array.
*  e.g.
* <!--[tag_name]--> will be replaced with the value of $themeReplace['tag_name']
******************************************************************/

// Website name
$themeReplace['site_name'] = 'glype proxy';

// Meta description
$themeReplace['meta_description'] = <<<OUT

OUT;

// Meta keywords (separate with comma)
$themeReplace['meta_keywords'] = <<<OUT

OUT;

// Proxy description text
$themeReplace['description'] = '
   <p>这个在线代理支持javascript、CSS、图片、下载等功能。</p>
<p>并且当开启&ldquo;加密URL&rdquo;时，不会因为URL含有<span style="color: rgb(255, 0, 0); ">敏感字</span>而被重置（即使你使用http协议）。</p>
   <p><span style="font-size: xx-large; ">愿天下无<span style="color: rgb(255, 0, 0); ">墙</span>！</span></p>
   <p><img align="middle" alt="" src="'.GLYPE_URL.'/themes/default/nowall.png" /></p>
   <p><span class="Apple-style-span" style="font-size: xx-small;"><a target="_blank" href="http://waiwaier.com/post/210">歪歪儿</a>修改、汉化，<a target="_blank" href="https://twitter.com/vparano">vparano</a>再修改</span></p>
';

// Ad location above the form on the index page
$themeReplace['index_above_form'] = <<<OUT

OUT;

// Ad location below the form on the index page
$themeReplace['index_below_form'] = <<<OUT

OUT;

// Ad location on proxified pages below the url mini-form
$themeReplace['proxified'] = <<<OUT

OUT;
?>