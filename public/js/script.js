let contenu = {
    selector: '#postContent',
    inline_boundaries_selector: 'a[href]',
    height: 400,
    keep_styles: true,
    skin: 'oxide-dark',
    content_css:'default',
    body_class: 'Subcribe',
    content_style: `.Subcribe { color:#fcfcfc; background: #141E30;
        background: -webkit-linear-gradient(to right, #243B55, #141E30);
        background: linear-gradient(to right, #243B55, #141E30);
    }`+
                                'a {color : #16a085; text-decoration:none }'+
    `a:hover { cursor:pointer; background : #16a085; color:#fcfcfc;
        padding : 2px; border-radius:6px }`,
    plugins: [
        'advlist autolink lists link charmap print preview',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | backcolor | link | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat'
};
let commentaire = {
    selector: '#commentaire',
    height: 400,
    skin: 'oxide-dark',
    content_css:'default',
    body_class: 'inputComment',
    content_style: `.inputComment { color: #fcfcfc; background: #232526;
        background: -webkit-linear-gradient(to left, #4d4647, #232526);
        background: linear-gradient(to left, #46484a, #232526);
    }`+'a {color : #16a085; text-decoration:none }',
    plugins: [
        'advlist autolink lists link charmap print preview',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | backcolor | link | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat'
};


tinymce.init(contenu);

tinymce.init(commentaire);
