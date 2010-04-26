<?php
/*******************************************************************
* Glype Proxy Script
*
* Copyright (c) 2008, http://www.glype.com/
*
* Permission to use this script is granted free of charge
* subject to the terms displayed at http://www.glype.com/downloads
* and in the LICENSE.txt document of the glype package.
*******************************************************************
* This page allows the user to change settings for their "virtual
* browser" - includes disabling/enabling referrers, choosing a user
* agent string and tunnelling through another proxy.
******************************************************************/


/*****************************************************************
* Initialize glype
******************************************************************/

require 'includes/init.php';

// Stop caching
sendNoCache();

// Start buffering
ob_start();


/*****************************************************************
* Create content
******************************************************************/

// Return without saving button
$return      = empty($_GET['return']) ? '' : '<input type="button" value="Cancel" onclick="window.location=\'' . $_GET['return'] . '\'">';
$returnField = empty($_GET['return']) ? '' : '<input type="hidden" value="' . $_GET['return'] . '" name="return">';

// Quote strings
function q($value) {
   return str_replace("'", "\'", $value);
}

// Get existing values
$browser      = $_SESSION['custom_browser'];

$currentUA       = q($browser['user_agent']);
$realReferrer    = $browser['referrer'] == 'real' ? 'true' : 'false';
$customReferrer  = $browser['referrer'] == 'real' ? ''     : q($browser['referrer']);
$tunnel          = q($browser['tunnel']);
$tunnelPort      = q($browser['tunnel_port']);
$checkTunnelType = $browser['tunnel_type'] ? "document.getElementById('tunnel-type-{$browser['tunnel_type']}').checked = true;" : '';

echo <<<OUT
   <script type="text/javascript">
      // Update custom ua field with value of currently selected preset
      function updateCustomUA(select) {
         
         // Get value
         var newValue = select.value;
         
         // Custom field
         var customField = document.getElementById('user-agent');
         
         // Special cases
         switch ( newValue ) {
            case 'none':
               newValue = '';
               break;
            case 'custom':
               customField.focus();
               return;
         }
         
         // Set new value
         customField.value = newValue;
         
      }
      
      // Set select box to "custom" field when the custom text field is edited
      function setCustomUA() {
         var setTo = document.getElementById('user-agent').value ? 'custom' : '';
         setSelect(document.getElementById('user-agent-presets'), setTo);
      }
      
      // Set a select field by value
      function setSelect(select, value) {
         for ( var i=0; i < select.length; ++i ) {
            if ( select[i].value == value ) {
               select.selectedIndex = i;
               return true;
            }
         }
         return false
      }
      
      // Clear custom-referrer text field if real-referrer is checked
      function clearCustomReferrer(checkbox) {
         if ( checkbox.checked ) {
            document.getElementById('custom-referrer').value = '';
         }
      }
      
      // Clear real-referrer checkbox if custom-referrer text field is edited
      function clearRealReferrer() {
         document.getElementById('real-referrer').checked = '';
      }
      
      // Add domready function to set form to current values
      window.addDomReadyFunc(function() {
         document.getElementById('user-agent').value        = '{$currentUA}';
         if ( setSelect(document.getElementById('user-agent-presets'), '{$currentUA}') == false ) {
            setCustomUA();
         }
         document.getElementById('real-referrer').checked   = {$realReferrer};
         document.getElementById('custom-referrer').value   = '{$customReferrer}';
         document.getElementById('tunnel').value            = '{$tunnel}';
         document.getElementById('tunnel-port').value       = '{$tunnelPort}';
         {$checkTunnelType}
      });
   </script>
   
	<h2 class="first">浏览器设定</h2>
	<p>你可以在下面设定你的"虚拟浏览器" 。这些设定将会影响代理服务器发送给目标服务器的信息。</p>
   <form action="includes/process.php?action=edit-browser" method="post">
   
      <table cellpadding="2" cellspacing="0" align="center" class="large-table">
         <tr>
            <th colspan="2">User Agent (<a style="cursor:help;" onmouseover="tooltip('你的User Agent发送到服务器来验证你使用的软件是否能够连接到特定网络。')" onmouseout="exit()">?</a>)</th>
         </tr>
         <tr>
            <td width="150">从现有的UA进行选择:</td>
            <td>
               <select id="user-agent-presets" onchange="updateCustomUA(this)">
                  <option value="Mozilla/5.0 (Windows; U; Windows NT 6.1; zh-CN; rv:1.9.1.3) Gecko/20090824 Firefox/3.5.3">Firefox 3.5.3 (Win7,zh-cn)</option>
                  <option value="Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.6; zh-CN; rv:1.9.1.3) Gecko/20090824 Firefox/3.5.3">Firefox 3.5.3 (Mac,zh-cn)</option>
                  <option value="Mozilla/5.0 (Windows; U; Windows NT 6.0; zh-CN; rv:1.8.1.12) Gecko/20080201 Firefox/2.0.0.12">Firefox 2.0 (Vista,zh-cn)</option>
                  <option value="Mozilla/5.0 (Windows; U; Windows NT 6.0; en-GB; rv:1.8.1.12) Gecko/20080201 Firefox/2.0.0.12">Firefox 2.0 (Vista,en)</option>
                  <option value="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6">Firefox 2.0 (XP,en)</option>
                  <option value="Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; en-US; rv:1.8.1.4) Gecko/20070515 Firefox/2.0.4">Firefox 2.0 (Mac,en)</option>
                  <option value="Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0)">Internet Explorer 8 (Win7)</option>
                  <option value="Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)">Internet Explorer 8 (Vista)</option>
                  <option value="Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)">Internet Explorer 7 (Vista)</option>
                  <option value="Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)">Internet Explorer 7 (XP)</option>
                  <option value="Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)">Internet Explorer 6 (XP)</option>
                  <option value="Opera/9.20 (Windows NT 6.0; U; en)">Opera 9.2 (Vista,en)</option>
                  <option value="Opera/9.00 (Windows NT 5.1; U; en)">Opera 9.0 (XP,en)</option>
                  <option value="Opera/9.50 (Macintosh; Intel Mac OS X; U; en)">Opera 9.5 (Mac,en)</option>
                  <option value="Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_2; zh-cn) AppleWebKit/531.21.8 (KHTML, like Gecko) Version/4.0.4 Safari/531.21.10">Safari 4.0.4 (Mac,zh-cn)</option>
                  <option value="Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_1_2 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7D11 Safari/528.16">Safari (iPhone 3.1.2,zen)</option>		
                  <option value="{$_SERVER['HTTP_USER_AGENT']}"> - 当前浏览器/真实的</option>
                  <option value=""> - 无</option>
                  <option value="custom"> - 自定义…</option>         
               </select>
            </td>
         </tr>
         <tr>
            <td colspan="2">
               <input type="text" id="user-agent" name="user-agent" class="full-width" onchange="setCustomUA();">
            </td>
         </tr>
         <tr>
            <td colspan="2" class="small-note"><b>注:</b> 某些网站会根据你的User Agent调节显示的内容。</td>
         </tr>
      </table>
      
      <table cellpadding="2" cellspacing="0" align="center" class="large-table">
         <tr>
            <th colspan="2">引用(referrer) (<a style="cursor:help;" onmouseover="tooltip('引用页的URL通常会发送给服务器。你可以忽略这个设定或者设定不发送引用(referrer)来保护隐私。')" onmouseout="exit()">?</a>)</th>
         </tr>
         <tr>
            <td width="150">发送真实的引用信息(referrer):</td>
            <td><input type="checkbox" name="real-referrer" id="real-referrer" onclick="clearCustomReferrer(this)"></td>
         </tr>
         <tr>
            <td>自定义referrer:</td>
            <td><input type="text" name="custom-referrer" id="custom-referrer" class="full-width" onchange="clearRealReferrer()"></td>
         </tr>
         <tr>
            <td colspan="2" class="small-note"><b>注:</b> 某些网站会验证你的referrer并且可能会因为错误的referrer而禁止访问</td>
         </tr>
      </table>

      <table cellpadding="2" cellspacing="0" align="center" class="large-table">
         <tr>
            <th colspan="2">连接 (<a style="cursor:help;" onmouseover="tooltip('输入另一个连接的代理服务器地址。')" onmouseout="exit()">?</a>)</th>
         </tr>
         <tr>
            <td width="150">代理服务器:</td>
            <td><input type="text" name="tunnel" id="tunnel" size="20"> : <input type="text" name="tunnel-port" id="tunnel-port" size="2"></td>
         </tr>
         <tr>
            <td width="150">类型:</td>
            <td><input type="radio" name="tunnel-type" id="tunnel-type-http" value="http"> <label for="tunnel-type-http">HTTP</label> &nbsp; / &nbsp; <input type="radio" name="tunnel-type" id="tunnel-type-socks5" value="socks5"> <label for="tunnel-type-socks5">SOCKS 5</label></td>
         </tr>
      </table>
      
      <br>
      
      <div style="text-align: center;"><input type="submit" value="保存"> {$return}</div>
      
      {$returnField}
      
   </form>
OUT;


/*****************************************************************
* Send content wrapped in our theme
******************************************************************/

// Get buffer
$content = ob_get_contents();

// Clear buffer
ob_end_clean();

// Print content wrapped in theme
echo replaceContent($content);
?>