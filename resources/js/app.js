

import Alpine from 'alpinejs';
import tinymce from 'tinymce';

import 'tinymce/icons/default';
import 'tinymce/themes/silver';
import 'tinymce/models/dom';

import 'tinymce/plugins/lists';
import 'tinymce/plugins/link';
// import 'tinymce/plugins/align';

import 'tinymce/skins/ui/oxide/skin';
import 'tinymce/skins/content/default/content';

window.tinymce = tinymce;

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.tinymce-editor')) {
        tinymce.init({
            selector: '.tinymce-editor',
            menubar: false,
            plugins: 'lists link',
            toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link',
            branding: false,
            height: 250,

            // TinyMCE menggunakan asset lokal
            base_url: '/tinymce',
            suffix: '.min',
        });
    }
});