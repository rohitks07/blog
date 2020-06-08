require('./bootstrap');

//for icons
const feather = require('feather-icons')
feather.replace();
//for select b
window.select2 = require('select2');
//import Ck editor
window.ClassicEditor =require('@ckeditor/ckeditor5-build-classic');

//this is used for slug
window.slugify = function(text){
    return text.toString().toLowerCase()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
}
