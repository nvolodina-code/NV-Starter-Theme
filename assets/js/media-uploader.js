jQuery(document).ready(function($){
  let mediaUploader;

  $('.nonna-upload-btn').click(function(e) {
    e.preventDefault();
    const button = $(this);
    const target = $('#' + button.data('target'));

    if (mediaUploader) {
      mediaUploader.open();
      return;
    }

    mediaUploader = wp.media({
      title: 'Choose Image',
      button: {
        text: 'Use this image'
      },
      multiple: false
    });

    mediaUploader.on('select', function() {
      const attachment = mediaUploader.state().get('selection').first().toJSON();
      target.val(attachment.url);
    });

    mediaUploader.open();
  });
});
