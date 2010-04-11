{literal}
    <script type = "text/javascript">
	    function collapse(topic_id) {
		    var topic = $('#topic_content_' + topic_id);
		    if (!topic.html().length) {
			    topic.append($('#loader').css('display', 'block'));
			    topic.load(
				    'message.php?action=view_content', 
					{user: {/literal}{$user->get_player_id()}{literal}, topic: topic_id},
				    function (){collapse(topic_id);}
				);
			}
			else {
		        topic.slideToggle(600);
				$('#loader').css('display', 'none');
			}
		}
	</script>
{/literal}
{foreach from=$topics item="topic"}
    <div>
        <div style = "cursor: pointer; border: dashed 1px #000000;" onclick = "javascript: collapse({$topic->get_id()});">
            <div style = "float: left;" align="left">
                <strong>Sent:</strong> {$topic->get_sent_date()}
                {if $show_topic_title}<b><i>{$topic->get_topic()}</i></b>{/if}
            </div>
            <div align="right">
                {assign var="sender" value = $topic->get_sender()}
                <strong>From:</strong> <a href = "profile.php?name={$sender->get_name()}">{$sender->get_name()}</a>
            </div>
        </div>
        <div id = "topic_content_{$topic->get_id()}" style = "display: none;"></div>
    </div>
{/foreach}
{html_entity->loader}
{if $topics}
    {html_entity->paginate total=$total url=$url items_per_page=$items_per_page is_js_url=$is_js}
{/if}