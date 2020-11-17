let formPost = new tinymce.util.Color('#232526')
tinymce.init({
    selector: '#contenuPost',
    plugins: 'image media link tinydrive code imagetools',
    toolbar: 'insertfile image link | code',
    tinydrive_token_provider: 'URL_TO_YOUR_TOKEN_PROVIDER',
});