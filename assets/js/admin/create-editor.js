function create_editor(id){
    CKEDITOR.ClassicEditor.create(document.getElementById(id), {
        toolbar: {
        items: [
            'heading', '|',
            'bold', 'italic', 'strikethrough', 'underline', 'removeFormat', '|',
            'bulletedList', 'numberedList', 'todoList', '|',
            'outdent', 'indent', '|',
            'undo', 'redo',
            '-',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
            'alignment', '|',
            'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed'
        ],
        shouldNotGroupWhenFull: true
        },
        list: {
        properties: {
            styles: true,
            startIndex: true,
            reversed: true
        }
        },
        heading: {
        options: [{
            model: 'paragraph',
            title: 'Paragraph',
            class: 'ck-heading_paragraph'
            },
            {
            model: 'heading1',
            view: 'h1',
            title: 'Heading 1',
            class: 'ck-heading_heading1'
            },
            {
            model: 'heading2',
            view: 'h2',
            title: 'Heading 2',
            class: 'ck-heading_heading2'
            },
            {
            model: 'heading3',
            view: 'h3',
            title: 'Heading 3',
            class: 'ck-heading_heading3'
            },
            {
            model: 'heading4',
            view: 'h4',
            title: 'Heading 4',
            class: 'ck-heading_heading4'
            },
            {
            model: 'heading5',
            view: 'h5',
            title: 'Heading 5',
            class: 'ck-heading_heading5'
            },
            {
            model: 'heading6',
            view: 'h6',
            title: 'Heading 6',
            class: 'ck-heading_heading6'
            }
        ]
        },
        placeholder: 'Напишите свою статью!',
        fontFamily: {
        options: [
            'default'
        ],
        supportAllValues: true
        },
        fontSize: {
        options: [10, 12, 14, 'default', 18, 20, 22, 24],
        supportAllValues: true
        },
        htmlSupport: {
        allow: [{
            name: /.*/,
            attributes: true,
            classes: true,
            styles: true
        }]
        },
        htmlEmbed: {
        showPreviews: true
        },
        link: {
        decorators: {
            addTargetToExternalLinks: true,
            defaultProtocol: 'https://',
            toggleDownloadable: {
            mode: 'manual',
            label: 'Downloadable',
            attributes: {
                download: 'file'
            }
            }
        }
        },
        removePlugins: [
        'CKBox',
        'CKFinder',
        'EasyImage',
        'RealTimeCollaborativeComments',
        'RealTimeCollaborativeTrackChanges',
        'RealTimeCollaborativeRevisionHistory',
        'PresenceList',
        'Comments',
        'TrackChanges',
        'TrackChangesData',
        'RevisionHistory',
        'Pagination',
        'WProofreader',
        'MathType'
        ]
    }).then(editor => {
        return editor;
    });
}

function create_editor_with_data(id, data){
    CKEDITOR.ClassicEditor.create(document.getElementById(id), {
        toolbar: {
        items: [
            'heading', '|',
            'bold', 'italic', 'strikethrough', 'underline', 'removeFormat', '|',
            'bulletedList', 'numberedList', 'todoList', '|',
            'outdent', 'indent', '|',
            'undo', 'redo',
            '-',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
            'alignment', '|',
            'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed'
        ],
        shouldNotGroupWhenFull: true
        },
        list: {
        properties: {
            styles: true,
            startIndex: true,
            reversed: true
        }
        },
        heading: {
        options: [{
            model: 'paragraph',
            title: 'Paragraph',
            class: 'ck-heading_paragraph'
            },
            {
            model: 'heading1',
            view: 'h1',
            title: 'Heading 1',
            class: 'ck-heading_heading1'
            },
            {
            model: 'heading2',
            view: 'h2',
            title: 'Heading 2',
            class: 'ck-heading_heading2'
            },
            {
            model: 'heading3',
            view: 'h3',
            title: 'Heading 3',
            class: 'ck-heading_heading3'
            },
            {
            model: 'heading4',
            view: 'h4',
            title: 'Heading 4',
            class: 'ck-heading_heading4'
            },
            {
            model: 'heading5',
            view: 'h5',
            title: 'Heading 5',
            class: 'ck-heading_heading5'
            },
            {
            model: 'heading6',
            view: 'h6',
            title: 'Heading 6',
            class: 'ck-heading_heading6'
            }
        ]
        },
        placeholder: 'Напишите свою статью!',
        fontFamily: {
        options: [
            'default'
        ],
        supportAllValues: true
        },
        fontSize: {
        options: [10, 12, 14, 'default', 18, 20, 22, 24],
        supportAllValues: true
        },
        htmlSupport: {
        allow: [{
            name: /.*/,
            attributes: true,
            classes: true,
            styles: true
        }]
        },
        htmlEmbed: {
        showPreviews: true
        },
        link: {
        decorators: {
            addTargetToExternalLinks: true,
            defaultProtocol: 'https://',
            toggleDownloadable: {
            mode: 'manual',
            label: 'Downloadable',
            attributes: {
                download: 'file'
            }
            }
        }
        },
        removePlugins: [
        'CKBox',
        'CKFinder',
        'EasyImage',
        'RealTimeCollaborativeComments',
        'RealTimeCollaborativeTrackChanges',
        'RealTimeCollaborativeRevisionHistory',
        'PresenceList',
        'Comments',
        'TrackChanges',
        'TrackChangesData',
        'RevisionHistory',
        'Pagination',
        'WProofreader',
        'MathType'
        ]
    }).then(editor => {
        editor.setData(data);
        return editor;
    });
}
