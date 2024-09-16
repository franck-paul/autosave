/*global $, dotclear */
'use strict';

$(() => {
  dotclear.autosave = dotclear.getData('autosave');
  if ($('#id').length) {
    $('#entry-form').append('<input type="hidden" id="save" value="save" name="save">');
    $('#entry-form').autosave({
      /** Timer durations **/
      interval: Number(dotclear.autosave.delay),
      monitor: 3000,
      /** Callbacks **/
      save() {
        const d = new Date();
        const t = dotclear.autosave.msg.saved.replace('%s', d.toLocaleTimeString());
        if ($('#content p.message').length > 0) {
          $('#content p.message').text(t);
          return;
        }
        const msg = $(document.createElement('p'));
        msg.addClass('message');
        msg.text(t);
        $('#content h2').after(msg);
      },
    });
  } else {
    const t = dotclear.autosave.msg.waiting;
    if ($('#content p.message').length > 0) {
      $('#content p.message').text(t);
    } else {
      const msg = $(document.createElement('p'));
      msg.addClass('message');
      msg.text(t);
      $('#content h2').after(msg);
    }
  }
});
