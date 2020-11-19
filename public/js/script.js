let formPost = new tinymce.util.Color('#232526')
tinymce.init({
    selector: '#contenuPost',
    height: 400,
    keep_styles: true,
    skin: 'oxide-dark',
    content_css:'default',
    body_class: 'Subcribe',
    content_style: `.Subcribe {background: #141E30;
                     background: -webkit-linear-gradient(to right, #243B55, #141E30);
                     background: linear-gradient(to right, #243B55, #141E30);}`,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen emoticons',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | backcolor | link | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat'
});

tinymce.init({
    selector: '#commentaire',
    height: 400,
    skin: 'oxide-dark',
    content_css:'default',
    body_class: 'inputComment',
    content_style: `.inputComment {color: fcfcfc;
                                   background: #232526;
                                   background: -webkit-linear-gradient(to left, #4d4647, #232526);
                                   background: linear-gradient(to left, #46484a, #232526);}`,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen emoticons',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | backcolor | link | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat'
});
