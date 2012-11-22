$(document).ready(function(){
	if ($('#id').length) {
		$('#entry-form').append('<input type="hidden" id="save" value="save" name="save" />');
		$('#entry-form').autosave({
			/** Timer durations **/
			interval: 	30000,
			monitor: 	3000,
			/** Callbacks **/
			save: 		function(e,o) {
				d = new Date();
				t = 'Autosave : dernier enregistrement à '+d.toLocaleTimeString();
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
		t = 'Autosave : en attente d\'un premier enregistrement';
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