if (!window.console || !console.firebug) {
	var names = ["log", "debug", "info", "warn", "error", "assert", "dir", "dirxml", "group", "groupEnd", "time", "timeEnd", "count", "trace", "profile", "profileEnd"];
	window.console = {};
	for (var i = 0; i < names.length; ++i) window.console[names[i]] = function() {};
}

$(document).ready(function(){
	if ($('#id').length) {
		/* grouik ! trouver une autre solution, cause un bug dans mon firefox, 
			le formulaire est tout le temps vu comme dirty, même si aucun contenu n'a été modifié
		*/
		$('#entry-form').append('<input type="hidden" id="save" value="save" name="save" />');
		$('#entry-form').autosave({
			/** Timer durations **/
			interval: 	30000,
			monitor: 	3000,
			/** Callbacks **/
			setup: 		function(e,o) {
				console.log("Setting up autosaver...");
			},
			record: 	function(e,o) {
				console.log("Recording form's state for the autosaver...");
			},
			save: 		function(e,o) {
				d = new Date();
				$('#footer p').text('Autosave : dernier enregistrement le '+d.toLocaleString());					
				console.log("Autosaver is now saving...")
			},
			shutdown: 	function(e,o) {
				console.log("Shutting down autosaver...");
			},
			dirty: 		function(e,o) {
				console.log("Autosaver detected a dirty form...");
			}
		});
	} else {
		$('#footer p').text('Autosave désactivé ! y faut enregistrer une première fois le post pour que ça roule');
	}
});