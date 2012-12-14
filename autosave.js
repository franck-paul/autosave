$(document).ready(function(){
	if ($('#id').length) {
		$('#entry-form').append('<input type="hidden" id="save" value="save" name="save" />');
		$('#entry-form').autosave({
			/** Timer durations **/
			interval: 	Number(autosave_delay),
			monitor: 	3000,
			/** Callbacks **/
			save: 		function(e,o) {
				d = new Date();
				t = autosave_msg_saved.replace('%s',d.toLocaleTimeString());
				if ($('#content p.message').length > 0) {
					$('#content p.message').text(t);
				} else {
					var msg = $(document.createElement('p'));
					msg.addClass('message');
					msg.text(t);
					$('#content').prepend(msg);
				}
			}
		});
	} else {
		t = autosave_msg_waiting;
		if ($('#content p.message').length > 0) {
			$('#content p.message').text(t);
		} else {
			var msg = $(document.createElement('p'));
			msg.addClass('message');
			msg.text(t);
			$('#content').prepend(msg);
		}
	}
});