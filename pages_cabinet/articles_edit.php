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
                            <h2 class="uui-heading-medium"><strong>Дополнить Базу Знаний:</strong></h2>
                        </div>
                    </div>
                    <div class="uui-contact01_component w-form">
                        <form id="add_article_form" name="wf-form-Contact-01-form" data-name="Contact 01 form" method="post" class="uui-contact01_form">
                            <div class="uui-form-field-wrapper">
                                <label for="header" class="uui-field-label"><strong>Заголовок</strong></label>
                                <input type="text" class="uui-form_input w-input" maxlength="256" name="header" id="header" required="" />
                            </div>
                            <div class="uui-form-field-wrapper">
                                <label for="Contact-01-message" class="uui-field-label"><strong>Текст</strong></label>
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
            console.log({
                "name": name,
                "subject": subject
            });
            $("#field").append(`
                                            <li><a>${name} | ${subject}</a></li>
                                                `);
            $('#name-chapter').val("");
            $('#subject-chapter').val("");
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
    </script>

    <script>
        <?php
        $id = $_GET['id'];
        $result = mysqli_query($link, "SELECT * FROM `articles` WHERE id = {$id}");
        $article = mysqli_fetch_assoc($result);
        $result = mysqli_query($link, "SELECT * FROM `chapters` WHERE id = {$article['chapter_id']}");
        $chapter = mysqli_fetch_assoc($result);
        $result = mysqli_query($link, "SELECT * FROM `articles_tags` WHERE article_id = {$article['id']}");
        $active_tags = array();
        while ($row = mysqli_fetch_assoc($result)) {
        array_push($active_tags, $row['tag_name']);
        }

        $tag_objects = array();
        foreach ($active_tags as $tag) {
        array_push($tag_objects, array('value' => $tag));
        }

        $tag_string = json_encode($tag_objects);
        ?>
        var myEditor;

        var input = document.querySelector('input[name=tags]');

        var tagify = new Tagify(input)

        tagify.addTags(<?php echo $tag_string; ?>);

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
                    'Rubik Pixels',
                    'Antonio'
                ],
                supportAllValues: true
            },
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20],
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
            var html = `<?= $article['body'] ?>`;
            editor.setData(html);
        });
        $.getJSON("<?= URL ?>/php/chapters.php?type=get", function(data) {
            $.each(data, function(i, item) {
                $("#field").append(`
                    <li><a>${item['name']} | ${item['subject']}</a></li>
                `);
            });
            <?php
            $name = $chapter['name'];
            $subject = $chapter['subject'];
            ?>
            var element = $('#field li a:contains("<?php echo "$name | $subject"; ?>")').filter(function() {
                return $(this).text() === '<?php echo "$name | $subject"; ?>';
            });

            element.parent().addClass('selected');
            $('#field li').click(function() {
                $('#field li').removeClass('selected');
                $(this).addClass('selected');
            });
        });

        $("#add-chapter").click(function(e) {
            $.post(`<?= URL ?>/php/chapter.php?type=set`, {
                "name": $("#chapter-name").val(),
                "subject": $("#chapter-subject").val()
            });
            $("#field").append(`<option>${$("#chapter-name").val()}</option>`);
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
            $.post(`<?= URL ?>/php/articles.php?type=save&id=<?=$id?>`, data,
                function(data, textStatus, jqXHR) {
                    console.log(data);
                    window.location.href = "./";
                },
                "text");
        });
        $("#header").val("<?= $article['header'] ?>");
    </script>
</div>