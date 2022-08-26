import './bootstrap';
import '../css/app.css';

import Alpine from 'alpinejs';

import focus from '@alpinejs/focus'

Alpine.plugin(focus)

//import SimpleUploadAdapter from '@ckeditor/ckeditor5-upload/src/adapters/simpleuploadadapter';
window.Alpine = Alpine;


Alpine.start();


