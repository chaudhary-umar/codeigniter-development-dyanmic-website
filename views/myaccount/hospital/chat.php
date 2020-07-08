<div class="row">
	<?php
        $gpt_friends = '';
        $em = $this->doctrine->em;
        $conn = $em->getConnection();
        $stmt1 = $conn->prepare('Select user_id From gpt_admin');
        $stmt1->execute();
        $result1 = $stmt1->fetchAll();
        foreach($result1 as $res1){
            $gpt_friends .= 'GPT'.$res1['user_id'].',';
        }    
        $gpt_friends = substr($gpt_friends,0,-1);
    ?>
</div>

<script>
var chat_appid = '52291';
</script>
<?php if($this->session->user->id && $this->session->user->id > 0) { ?>
 <script>
	var chat_id = "<?php echo $this->session->user->id; ?>";
	var chat_name = "<?php echo $user_detail->getHospital()->getHospitalName().' - '.$user->getUserName(); ?>"; 
	var chat_link = ""; //Similarly populate it from session for user's profile link if exists
	var chat_avatar = "https://global-patienttransfer.com/assets/images/chathospitallogo.jpg"; //Similarly populate it from session for user's avatar src if exists
	var chat_role = "hospital"; //Similarly populate it from session for user's role if exists
	var chat_friends = '<?php echo $gpt_friends;?>'; //Similarly populate it with user's friends' site user id's eg: 14,16,20,31
	</script>
<?php } ?>
<script>
var chat_height = '600px';
var chat_width = '990px';

document.write('<div id="cometchat_embed_synergy_container" style="width:'+chat_width+';height:'+chat_height+';max-width:100%;border:1px solid #CCCCCC;border-radius:5px;overflow:hidden;"></div>');

var chat_js = document.createElement('script'); chat_js.type = 'text/javascript'; chat_js.src = 'https://fast.cometondemand.net/'+chat_appid+'x_xchatx_xcorex_xembedcode.js';

chat_js.onload = function() {
    var chat_iframe = {};chat_iframe.module="synergy";chat_iframe.style="min-height:"+chat_height+";min-width:"+chat_width+";";chat_iframe.width=chat_width.replace('px','');chat_iframe.height=chat_height.replace('px','');chat_iframe.src='https://'+chat_appid+'.cometondemand.net/cometchat_embedded.php'; if(typeof(addEmbedIframe)=="function"){addEmbedIframe(chat_iframe);}
}

var chat_script = document.getElementsByTagName('script')[0]; chat_script.parentNode.insertBefore(chat_js, chat_script);
</script>
