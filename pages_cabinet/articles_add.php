<?php
require_once('layouts/cabinet_header.php');
?>

<head>
    <link href="<?= URL ?>/css/text.css" rel="stylesheet" type="text/css" />
</head>
<div id="main-content" class="container allContent-section py-4">
    <script src="https://cdn.jsdelivr.net/npm/mammoth@1.4.8/mammoth.browser.min.js"></script>
    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
            max-height: 700px;
        }

        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
    <section class="uui-section_contact01">
        <div class="uui-page-padding">
            <div class="uui-container-small">
                <div class="uui-padding-vertical-xhuge">
                    <div class="uui-text-align-center">
                        <div class="uui-max-width-large align-center">
                            <h1 class="uui-heading-medium"><strong style="font-size:large;">Добавить статью:</strong></h1>
                        </div>
                    </div>
                    <div class="uui-contact01_component w-form">
                        <form id="add_article_form" name="wf-form-Contact-01-form" data-name="Contact 01 form" method="get" class="uui-contact01_form">
                            <div class="uui-form-field-wrapper">
                                <label for="header" class="uui-field-label"><strong>Заголовок</strong></label>
                                <input type="text" class="uui-form_input w-input" maxlength="256" name="header" id="header" required="" />
                            </div>
                            <div class="uui-form-field-wrapper">
                                <label for="container" class="uui-field-label"><strong>Текст</strong></label>
                                <div id="container">
                                    <div id="editor">
                                    </div>
                                </div>
                            </div>
                            <div class="uui-form-field-wrapper">
                                <input class="form-control" type="file" id="docx-file-input"><br>
                                <button id="parse-docx-button" type="button" class="btn btn-dark">Import from docx</button>
                            </div>
                            <div class="uui-form-field-wrapper">
                                <label for="tags-form" class="uui-field-label"><strong>Теги</strong></label>
                                <input id="tags" name='tags' value='' class="form-control">


                                <label for="field" class="uui-field-label"><strong>Раздел</strong></label>
                                <ul class="field" id="field" required="">
                                    <li class="title">Выбрать раздел:</li>
                                </ul><br>
                                <span id="open_chapter_form" style="width: auto;" class="button-add" role="button">➕ Добавить раздел</span><br><br>
                                <div id="chapter_form" class="close-from" action="<?= URL ?>/php/chapters.php?type=set" enctype="multipart/form-data" method="post">
                                    <p>Раздел:</p>
                                    <input style="width: 20vw;" name="name" id="name-chapter" type="text"><br><br>
                                    <p>Тематика:</p>
                                    <input style="width: 20vw;" id="subject-chapter" type="text"><br><br>
                                    <span id="add_chapter_btn" class="button-add">Добавить</span>
                                    <span id="hide_chapter_btn" class="button-add">Скрыть</span><br><br>
                                </div>
                            </div>
                            <div class="uui-form-button-wrapper"><input type="submit" value="Сохранить" class="uui-button w-button" /></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script src="https://unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js"></script>
    <script>
        $("#add_chapter_btn").click(function(e) {
            e.preventDefault();
            var name = $('#name-chapter').val();
            var subject = $('#subject-chapter').val();
            $('#name-chapter').val("");
            $('#subject-chapter').val("");

            $("#field").append(`<li><a>${name} | ${subject}</a></li>`);
            $.post("<?= URL ?>/php/chapters.php?type=set", {
                "name": name,
                "subject": subject
            });
            $('#field li').click(function() {
                $('#field li').removeClass('selected');
                $(this).addClass('selected');
            });
        });
        $("#open_chapter_form").click(function() {
            $("#chapter_form").toggleClass('close-from');
            $("#chapter_form").toggleClass('open');
        });
        $("#hide_chapter_btn").click(function() {
            $("#chapter_form").toggleClass('close-from');
            $("#hide_chapter_btn").toggleClass('open');
        });

        $.getJSON("<?= URL ?>/php/chapters.php?type=get", function(data) {
            console.log(data);
            $.each(data, function(i, item) {
                $("#field").append(`
                    <li><a>${item['name']} | ${item['subject']}</a></li>
                `);
            });
            $('#field li').click(function() {
                $('#field li').removeClass('selected');
                $(this).addClass('selected');
            });
        });
    </script>
    <script>
        var myEditor;
        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
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
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Antonio'
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
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
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
            myEditor = editor;
        });
        $('#parse-docx-button').on('click', function() {
            var input = $('#docx-file-input')[0].files[0];
            if (!input) {
                alert('Please select a file to parse!');
                return;
            }
            var reader = new FileReader();
            var html;
            reader.onload = function(event) {
                var arrayBuffer = event.target.result;
                mammoth.convertToHtml({
                        arrayBuffer: arrayBuffer
                    })
                    .then(function(result) {
                        html = result.value;
                        myEditor.setData(html);
                    })
                    .done();
            };
            reader.readAsArrayBuffer(input);
        });
        var input = document.querySelector('input[name=tags]');

        var tagify = new Tagify(input)

        $("#add_article_form").submit(function(e) {
            e.preventDefault();
            var header = $("#header").val();
            var body = myEditor.getData();
            var tags = tagify.value;
            var tagValues = tags.map(function(tag) {
                return tag.value;
            });

            var tagString = tagValues.join(';');

            var chapter = $("#field li.selected").text().split("|")[0].trim();
            var subject = $("#field li.selected").text().split("|")[1].trim();
            var data = {
                "header": header,
                'body': body,
                "chapter": chapter,
                "subject": subject,
                "tags": tagString,
                "time": <?= time(); ?>
            };
            console.log(data);
            $.post(`<?= URL ?>/php/articles.php?type=add`, data,
                function(data, textStatus, jqXHR) {
                    console.log(data);
                    window.location.href = "./";
                },
                "text");
        });
    </script>
</div>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/@yaireo/tagify"></script>
<script src="https://unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js"></script>
<script>
    // The DOM element you wish to replace with Tagify
    var input = document.querySelector('input[name=tags]');

    // initialize Tagify on the above input node reference
    new Tagify(input)
</script> -->